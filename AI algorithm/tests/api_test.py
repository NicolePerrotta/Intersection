from fastapi.testclient import TestClient
from httpx import Response
import db
from api import app
import numpy as np


def assert_response(response: Response, status_code: int, ids_len: int, relevance_len: int) -> None:
    assert response.status_code == status_code
    ids = response.json()['ids']
    relevance = response.json()['relevance']
    assert isinstance(ids, list)
    assert isinstance(ids[0], int)
    assert isinstance(relevance, list)
    assert isinstance(relevance[0], float)
    assert len(ids) == ids_len
    assert len(relevance) == relevance_len


def test_status():
    with TestClient(app) as client:
        response = client.get("/")
        assert response.status_code == 200
        assert response.json()['status'] == "Intersection - Algorithm API is ready"


def test_str_to_embedding():
    with TestClient(app) as client:
        # Test with a valid input
        with open("../docs/jobs/txt/Backend Developer.txt", "r") as txt_file:
            content = txt_file.read()
        response = client.post("/convert/string", json={"text": content})
        assert response.status_code == 200
        embeddings = response.json()['embedding']
        assert isinstance(embeddings, list)
        assert isinstance(embeddings[0], float)
        assert len(embeddings) == 512

        # Test with an empty input
        response = client.post("/convert/string")
        assert response.status_code == 422
        assert response.json()['detail'][0]['type'] == 'value_error.missing'

        # Test with an invalid input
        response = client.post("/convert/string", json={"not text": "This is a test"})
        assert response.status_code == 422
        assert response.json()['detail'][0]['type'] == 'value_error.missing'


def test_pdf_to_embedding():
    with TestClient(app) as client:
        # Test with a valid input
        pdf_file = open("../docs/cvs/Database Administrator.pdf", "rb")
        response = client.post("/convert/pdf", files={"file": pdf_file})
        assert response.status_code == 200
        embeddings = response.json()['embedding']
        assert isinstance(embeddings, list)
        assert isinstance(embeddings[0], float)
        assert len(embeddings) == 512

        # Test with an empty input
        response = client.post("/convert/pdf")
        assert response.status_code == 422
        assert response.json()['detail'][0]['type'] == 'value_error.missing'

        # Test with an invalid input
        non_pdf_file = open("../algorithm.py", "rb")
        response = client.post("/convert/pdf", files={"file": non_pdf_file})
        assert response.status_code == 400
        assert response.json()['detail'] == 'The file needs to be a PDF'


def test_ranking():
    client = TestClient(app)
    # Test with a valid job offer ID
    response = client.get("/ranking/2")
    assert_response(response, 200, 3, 3)
    assert response.json()['ids'] == [9, 10, 2]

    # Test with a valid job offer ID nobody applied to
    response = client.get("/ranking/5")
    assert response.status_code == 200
    ids = response.json()['ids']
    relevance = response.json()['relevance']
    assert isinstance(ids, list)
    assert isinstance(relevance, list)
    assert len(ids) == 0
    assert len(relevance) == 0

    # Test with an invalid job offer ID
    response = client.get("/ranking/9999")
    assert response.status_code == 404
    assert response.json()['detail'] == 'The requested job offer does not exist'


def test_recommend_jobs():
    client = TestClient(app)
    # Test with a valid worker offer ID
    response = client.get("/recommend/jobs/2")
    assert_response(response, 200, 11, 11)

    # Test with an empty request
    response = client.get("/recommend/jobs/")
    assert response.status_code == 404
    assert response.json()['detail'] == 'Not Found'

    # Test with an invalid worker ID
    response = client.get("/recommend/jobs/9999")
    assert response.status_code == 404
    assert response.json()['detail'] == 'The requested worker does not exist'


def test_recommend_workers():
    client = TestClient(app)
    # Test with a valid job offer ID
    response = client.get("/recommend/workers/2")
    assert_response(response, 200, 12, 12)

    # Test with an empty request
    response = client.get("/recommend/workers/")
    assert response.status_code == 404
    assert response.json()['detail'] == 'Not Found'

    # Test with an invalid job offer ID
    response = client.get("/recommend/workers/9999")
    assert response.status_code == 404
    assert response.json()['detail'] == 'The requested job offer does not exist'


def test_recompute_embeddings():
    with TestClient(app) as client:
        init_worker_df = db.get_all_workers_emb().sort_values('worker_id')
        init_offer_df = db.get_all_offers_emb().sort_values('offer_id')
        response = client.get("/recompute")
        assert response.status_code == 200
        final_worker_df = db.get_all_workers_emb().sort_values('worker_id')
        final_offer_df = db.get_all_offers_emb().sort_values('offer_id')
        assert final_worker_df['worker_id'].to_list() == init_worker_df['worker_id'].to_list()
        assert final_offer_df['offer_id'].to_list() == init_offer_df['offer_id'].to_list()
        assert np.isclose(final_worker_df['embedding'].tolist(), init_worker_df['embedding'].tolist()).all()
        assert np.isclose(final_offer_df['embedding'].tolist(), init_offer_df['embedding'].tolist()).all()
