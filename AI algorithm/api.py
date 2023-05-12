"""
    This file contains the main code of the API.
    It relies on functions from other scripts in order to execute the methods.
"""
import io
from contextlib import asynccontextmanager
from enum import Enum
from typing import Any, Union
import numpy as np
from fastapi import FastAPI, UploadFile, HTTPException
import algorithm
import db
from pydantic import BaseModel


class Status(str, Enum):
    INIT = "Intersection - Algorithm API is initializing..."
    READY = "Intersection - Algorithm API is ready"
    BUSY = "Intersection - Algorithm API is busy updating the database..."
    SHUTDOWN = "Intersection - Algorithm API is shutting down..."


class JobOffer(BaseModel):
    """ Needed to pass a body to str_to_embedding() """
    text: str


@asynccontextmanager
async def lifespan(app_: FastAPI):
    # Execute at init
    app_.state.status = Status.INIT
    algorithm.initialize()
    app_.state.status = Status.READY
    yield
    # Execute at shutdown
    app_.state.status = Status.SHUTDOWN


app = FastAPI(lifespan=lifespan)


@app.get("/", response_model=dict[str, str])
async def status() -> Any:
    """ Get the current status of the API, to check that it is ready to receive requests. """
    return {"status": app.state.status}


@app.post("/convert/string", response_model=dict[str, list[Any]])
async def str_to_embedding(job_offer: JobOffer) -> Any:
    """
    Convert a string of text into a single embedding (i.e. a vector of real numbers)
    that represents all its content. The string must be passed in the request's body.
    """
    sentences: list[str] = algorithm.pre_process(job_offer.text)
    return {"embedding": algorithm.encode(sentences).tolist()}


@app.post("/convert/pdf", response_model=dict[str, list[Any]])
async def pdf_to_embedding(file: UploadFile) -> Any:
    """
    Extract the text of a PDF file and convert it to a single embedding (i.e. a vector of real numbers)
    that represents all its content. The PDF file must be passed in the request's body.
    """
    if file.content_type != 'application/pdf':
        raise HTTPException(status_code=400, detail="The file needs to be a PDF")
    raw_text: str = algorithm.extract_from_pdf(file.file)
    sentences: list[str] = algorithm.pre_process(raw_text)
    return {"embedding": algorithm.encode(sentences).tolist()}


@app.get("/ranking/{job_offer_id}", response_model=dict[str, list[Any]])
def ranking(job_offer_id: int, max_number: Union[int, None] = None) -> Any:
    """
    Given the ID of a job offer in the database, compute the relevance of each worker that applied to the offer.
    Return a dictionary with the ID and the relevance score of the workers, sorted in descending order.
    """
    job, workers = db.get_applicants_emb(job_offer_id)
    if job.empty:
        raise HTTPException(status_code=404, detail="The requested job offer does not exist")
    df = algorithm.sort_by_relevance(job, workers).head(max_number)
    return {"ids": df['id'].to_list(), "relevance": df['relevance'].to_list()}


@app.get("/recommend/jobs/{worker_id}", response_model=dict[str, list[Any]])
def recommend_jobs(worker_id: int, max_number: Union[int, None] = None) -> Any:
    """
    Given the ID of a worker in the database, find job offers to recommend based on their profile.
    Return a dictionary with the ID and the relevance score of the job offers, sorted in descending order.
    """
    worker = db.get_worker_emb(worker_id)
    if worker.empty:
        raise HTTPException(status_code=404, detail="The requested worker does not exist")
    jobs = db.get_all_offers_emb()
    df = algorithm.sort_by_relevance(worker, jobs).head(max_number)
    return {"ids": df['id'].to_list(), "relevance": df['relevance'].to_list()}


@app.get("/recommend/workers/{job_offer_id}", response_model=dict[str, list[Any]])
def recommend_worker(job_offer_id: int, max_number: Union[int, None] = None) -> Any:
    """
    Given the ID of a job offer in the database, find suitable workers to recommend based on their profile.
    Return a dictionary with the ID and the relevance score of the workers, sorted in descending order.
    """
    job = db.get_offer_emb(job_offer_id)
    if job.empty:
        raise HTTPException(status_code=404, detail="The requested job offer does not exist")
    workers = db.get_all_workers_emb()
    df = algorithm.sort_by_relevance(job, workers).head(max_number)
    return {"ids": df['id'].to_list(), "relevance": df['relevance'].to_list()}


@app.get("/recompute", response_model=None)
def recompute_embeddings() -> Any:
    """
    Recompute the embeddings for every worker and for every job offer.
    This operation is meant to be used only when the model changes or when data is corrupted.
    """
    app.state.status = Status.BUSY

    # Helper functions to perform all the steps of the algorithm
    def worker_pipeline(file: io.BytesIO) -> np.ndarray:
        return algorithm.encode(algorithm.pre_process(algorithm.extract_from_pdf(file)))

    def offer_pipeline(description: str) -> np.ndarray:
        return algorithm.encode(algorithm.pre_process(description))

    # Recompute workers embeddings
    workers_df = db.get_all_workers_pdf()
    workers_df['embedding'] = workers_df['curriculum'].apply(worker_pipeline)
    db.set_all_workers_emb(workers_df)

    # Recompute job offers embeddings
    offers_df = db.get_all_offers_description()
    offers_df['embedding'] = offers_df['description'].apply(offer_pipeline)
    db.set_all_offers_emb(offers_df)

    app.state.status = Status.READY
