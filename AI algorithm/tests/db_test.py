import io

import db
import numpy as np
import pandas as pd


def test_connection():
    # Test the connection with the database
    # The test will fail if a connection cannot be established
    conn = db.alchemy_engine().connect()
    conn.close()
    conn = db.psycopg_engine().connect()
    conn.close()


def test_get_worker_emb():
    # Test the function with a valid worker ID
    worker_id = 1
    result_df = db.get_worker_emb(worker_id)
    assert isinstance(result_df, pd.DataFrame)
    assert len(result_df) == 1
    assert result_df.columns.tolist() == ['worker_id', 'embedding']
    # Test that the correct worker ID was returned
    assert result_df['worker_id'][0] == worker_id
    # Test that the embedding is a numpy array of the correct datatype
    assert isinstance(result_df['embedding'][0], np.ndarray)
    assert result_df['embedding'][0].dtype == np.float32

    # Test the function with an invalid worker ID
    worker_id = 9999
    result_df = db.get_worker_emb(worker_id)
    assert isinstance(result_df, pd.DataFrame)
    assert result_df.columns.tolist() == ['worker_id', 'embedding']
    assert len(result_df) == 0


def test_get_offer_emb():
    # Test the function with a valid offer ID
    offer_id = 1
    result_df = db.get_offer_emb(offer_id)
    assert isinstance(result_df, pd.DataFrame)
    assert len(result_df) == 1
    assert result_df.columns.tolist() == ['offer_id', 'embedding']
    # Test that the correct offer ID was returned
    assert result_df['offer_id'][0] == offer_id
    # Test that the embedding is a numpy array of the correct datatype
    assert isinstance(result_df['embedding'][0], np.ndarray)
    assert result_df['embedding'][0].dtype == np.float32

    # Test the function with an invalid offer ID
    offer_id = 9999
    result_df = db.get_offer_emb(offer_id)
    assert isinstance(result_df, pd.DataFrame)
    assert result_df.columns.tolist() == ['offer_id', 'embedding']
    assert len(result_df) == 0


def test_get_all_workers_emb():
    result_df = db.get_all_workers_emb()
    assert isinstance(result_df, pd.DataFrame)
    assert len(result_df) == 12
    assert result_df.columns.tolist() == ['worker_id', 'embedding']
    # Test that the embedding is a numpy array of the correct datatype
    assert isinstance(result_df['embedding'][0], np.ndarray)
    assert result_df['embedding'][0].dtype == np.float32


def test_get_all_offers_emb():
    result_df = db.get_all_offers_emb()
    assert isinstance(result_df, pd.DataFrame)
    assert len(result_df) == 11
    assert result_df.columns.tolist() == ['offer_id', 'embedding']
    # Test that the embedding is a numpy array of the correct datatype
    assert isinstance(result_df['embedding'][0], np.ndarray)
    assert result_df['embedding'][0].dtype == np.float32


def test_get_applicants_emb():
    # # Test the function with a valid offer ID with candidates applied
    offer_id = 2
    df_offer, df_workers = db.get_applicants_emb(offer_id)
    assert isinstance(df_offer, pd.DataFrame)
    assert isinstance(df_workers, pd.DataFrame)
    assert len(df_offer) == 1
    assert len(df_workers) == 3
    assert df_offer.columns.tolist() == ['offer_id', 'embedding']
    assert df_workers.columns.tolist() == ['worker_id', 'embedding']
    assert df_offer['offer_id'][0] == offer_id
    assert df_workers["worker_id"].tolist() == [2, 9, 10]
    # Test that the embedding is a numpy array of the correct datatype
    assert isinstance(df_offer['embedding'][0], np.ndarray)
    assert isinstance(df_workers['embedding'][0], np.ndarray)
    assert df_offer['embedding'][0].dtype == np.float32
    assert df_workers['embedding'][0].dtype == np.float32

    # Test the function with a valid offer ID with no candidates applied
    offer_id = 5
    df_offer, df_workers = db.get_applicants_emb(offer_id)
    assert isinstance(df_offer, pd.DataFrame)
    assert isinstance(df_workers, pd.DataFrame)
    assert len(df_offer) == 1
    assert len(df_workers) == 0
    assert df_offer.columns.tolist() == ['offer_id', 'embedding']
    assert df_workers.columns.tolist() == ['worker_id', 'embedding']
    assert df_offer['offer_id'][0] == offer_id
    # Test that the embedding is a numpy array of the correct datatype
    assert isinstance(df_offer['embedding'][0], np.ndarray)
    assert df_offer['embedding'][0].dtype == np.float32

    # Test the function with an invalid offer ID
    offer_id = 9999
    df_offer, df_workers = db.get_applicants_emb(offer_id)
    assert isinstance(df_offer, pd.DataFrame)
    assert isinstance(df_workers, pd.DataFrame)
    assert len(df_offer) == 0
    assert len(df_workers) == 0
    assert df_offer.columns.tolist() == ['offer_id', 'embedding']
    assert df_workers.columns.tolist() == ['worker_id', 'embedding']


def test_get_all_workers_pdf():
    result_df = db.get_all_workers_pdf()
    assert isinstance(result_df, pd.DataFrame)
    # Test columns, size and datatype of the dataframe
    assert result_df.columns.tolist() == ['worker_id', 'curriculum']
    assert len(result_df) == 12
    assert isinstance(result_df['curriculum'][0], io.BytesIO)


def test_get_all_offers_pdf():
    result_df = db.get_all_offers_pdf()
    assert isinstance(result_df, pd.DataFrame)
    # Test columns, size and datatype of the dataframe
    assert result_df.columns.tolist() == ['offer_id', 'file']
    assert len(result_df) == 11
    assert isinstance(result_df['file'][0], io.BytesIO)


def test_update_all_workers_emb():
    # Test that values are being inserted correctly
    initial_df = db.get_all_workers_emb()
    db.set_all_workers_emb(initial_df)
    final_df = db.get_all_workers_emb()
    assert initial_df.equals(final_df)


def test_update_all_offers_emb():
    # Test that values are being inserted correctly
    initial_df = db.get_all_offers_emb()
    db.set_all_offers_emb(initial_df)
    final_df = db.get_all_offers_emb()
    assert initial_df.equals(final_df)
