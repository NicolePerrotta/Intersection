"""
    This file contains the main code of the API.
    It relies on functions from other scripts in order to execute the methods.
"""

from typing import Any
from fastapi import FastAPI, UploadFile, HTTPException
import algorithm

app = FastAPI()
algorithm.initialize()


@app.get("/", response_model=str)
async def status() -> Any:
    return "Intersection - Algorithm API is ready"


@app.post("/convert", response_model=list[float], status_code=200)
async def convert_to_embedding(file: UploadFile) -> Any:
    """
    Extract the text of a PDF file and convert it to a single embedding (i.e. a vector of real numbers)
    that represents all its content. The PDF file must be passed in the request's body.
    """
    if file.content_type != 'application/pdf':
        raise HTTPException(status_code=400, detail="The file needs to be a PDF")
    raw_text: str = algorithm.extract_from_pdf(file.file)
    sentences: list[str] = algorithm.pre_process(raw_text)
    return algorithm.encode(sentences).tolist()


@app.get("/ranking")
async def ranking():
    # Input: job offer ID
    # Output: sorted list of candidates that have applied
    ...


@app.get("/recommend/jobs")
async def recommend_jobs():
    # Input: candidate ID, max number of job offers
    # Output: sorted list of job offers
    ...


@app.get("/recommend/candidates")
async def recommend_candidates():
    # Input: job offer ID, max number of candidates
    # Output: sorted list of candidates
    ...


@app.get("/recompute")
async def recompute_embeddings():
    # Input: None
    # Output: None
    # For each CV and Job Offer in the DB, recompute their embedding
    ...
