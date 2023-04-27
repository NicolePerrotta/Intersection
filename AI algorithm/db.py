"""
    This script contains functions to interact with the database.
    It is used by the API to retrieve the data it needs its operations.
"""
import io
import os
import numpy as np
import pandas as pd
import psycopg
import sqlalchemy
from dotenv import load_dotenv
from sqlalchemy import create_engine


def alchemy_engine() -> sqlalchemy.Engine:
    """ Return an object to connect to the DB using SQLAlchemy """
    load_dotenv()
    return create_engine(os.getenv("DATABASE_URL"))


def psycopg_engine() -> psycopg.Connection:
    """ Return an object to connect to the DB using psycopg3 """
    load_dotenv()
    return psycopg.connect(os.getenv("DATABASE_URL"))


def get_worker_emb(worker_id: int) -> pd.DataFrame:
    """ Retrieve the ID and the embedding of one worker in the DB """
    with alchemy_engine().connect() as conn:
        df = pd.read_sql_query("""
            SELECT worker_id, embedding FROM worker
            WHERE worker_id = %(worker_id)s
            """, conn, params={'worker_id': str(worker_id)})

    df["embedding"] = df["embedding"].apply(lambda x: np.array(x, dtype="float32"))
    return df


def get_offer_emb(offer_id: int) -> pd.DataFrame:
    """ Retrieve the ID and the embedding of one job offer in the DB """
    with alchemy_engine().connect() as conn:
        df = pd.read_sql_query("""
            SELECT offer_id, embedding FROM job_offer
            WHERE offer_id = %(offer_id)s
            """, conn, params={'offer_id': str(offer_id)})

    df["embedding"] = df["embedding"].apply(lambda x: np.array(x, dtype="float32"))
    return df


def get_all_workers_emb() -> pd.DataFrame:
    """ Retrieve the ID and the embedding of every worker in the DB """
    with alchemy_engine().connect() as conn:
        df = pd.read_sql_query("SELECT worker_id, embedding FROM worker", conn)

    df["embedding"] = df["embedding"].apply(lambda x: np.array(x, dtype="float32"))
    return df


def get_all_offers_emb() -> pd.DataFrame:
    """ Retrieve the ID and the embedding of every job offer in the DB """
    with alchemy_engine().connect() as conn:
        df = pd.read_sql_query("SELECT offer_id, embedding FROM job_offer", conn)

    df["embedding"] = df["embedding"].apply(lambda x: np.array(x, dtype="float32"))
    return df


def get_applicants_emb(offer_id: int) -> tuple[pd.DataFrame, pd.DataFrame]:
    """ Retrieve the ID and the embedding of the workers that applied to a specific job offer"""
    # Get the embedding of the job offer
    df_offer = get_offer_emb(offer_id)

    # Get the embeddings of the CV of the workers that applied
    with alchemy_engine().connect() as conn:
        df_workers = pd.read_sql_query("""
            SELECT worker.worker_id, worker.embedding 
            FROM worker JOIN applies_to
            ON applies_to.worker_id = worker.worker_id 
            AND offer_id =  %(offer_id)s
            """, conn, params={'offer_id': str(offer_id)})

    # Pre-process the embeddings
    df_workers["embedding"] = df_workers["embedding"].apply(lambda x: np.array(x, dtype="float32"))
    return df_offer, df_workers


def get_all_workers_pdf() -> pd.DataFrame:
    """ Retrieve the ID and the CV of every worker in the DB """
    with alchemy_engine().connect() as conn:
        df = pd.read_sql_query("SELECT worker_id, curriculum FROM worker", conn)

    # Convert the format so that it can be passed to the algorithm
    df['curriculum'] = df['curriculum'].apply(io.BytesIO)
    return df


def get_all_offers_pdf() -> pd.DataFrame:
    """ Retrieve the ID and the file of every job offer in the DB """
    with alchemy_engine().connect() as conn:
        df = pd.read_sql_query("SELECT offer_id, file FROM job_offer", conn)

    # Convert the format so that it can be passed to the algorithm
    df['file'] = df['file'].apply(io.BytesIO)
    return df


def set_all_workers_emb(df: pd.DataFrame) -> None:
    """ Update the embeddings of every worker stored in the DB """
    def update(series: pd.Series):
        conn.execute("""UPDATE worker
                    SET embedding = %(embedding)s
                    WHERE worker_id = %(id)s""",
                     params={"id": series['worker_id'], "embedding": series['embedding'].tolist()})

    with psycopg_engine() as conn:
        df.apply(update, axis=1)
        conn.commit()


def set_all_offers_emb(df: pd.DataFrame) -> None:
    """ Update the embeddings of every job offer stored in the DB """
    def update(series: pd.Series):
        conn.execute("""UPDATE job_offer
                    SET embedding = %(embedding)s
                    WHERE offer_id = %(id)s""",
                     params={"id": series['offer_id'], "embedding": series['embedding'].tolist()})

    with psycopg_engine() as conn:
        df.apply(update, axis=1)
        conn.commit()
