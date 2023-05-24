from pathlib import Path
import nltk
import numpy as np
import pandas as pd
import algorithm


def test_initialize():
    algorithm.initialize()
    # Test if the NLTK tokens are downloaded
    assert Path(nltk.data.find('tokenizers/punkt')).exists()
    # Test if the model is downloaded
    dir_name = 'sentence-transformers_' + algorithm.model_name
    assert (Path.home() / '.cache/torch/sentence_transformers/' / dir_name).exists()


def test_extract_from_pdf():
    # Test if the function extracts text from a PDF file
    pdf_file = Path('../docs/jobs/pdf/Data Scientist.pdf')
    assert isinstance(algorithm.extract_from_pdf(pdf_file), str)


def test_pre_process():
    text = '• This is a sentence.\nThis is another sentence.'
    expected = ['This is a sentence', 'This is another sentence']
    assert algorithm.pre_process(text) == expected
    text = 'This is an email: name.surname@gmail.com.\nThis is an URL: https://www.google.com'
    expected = ['This is an email', 'This is an URL']
    assert algorithm.pre_process(text) == expected


def test_encode():
    sentences = ['This framework generates embeddings for each input sentence',
                 'Sentences are passed as a list of string.',
                 'The quick brown fox jumps over the lazy dog.']
    embedding = algorithm.encode(sentences)
    # Test if the output is a numpy array of length 512
    assert isinstance(embedding, np.ndarray)
    assert embedding.shape == (512,)


def test_compute_relevance():
    a = np.array([3.0, 1.0, 1.0])
    b = np.array([[3.0, 2.0, 1.0], [3.0, 1.0, 1.0], [2.0, 5.0, 1.0]])
    # Test if the function returns an array of the correct shape
    relevance = algorithm.compute_relevance(a, b)
    assert isinstance(relevance, np.ndarray)
    assert relevance.shape == (3, 1)
    # Test the rankings
    assert relevance[1] > relevance[0] > relevance[2]


def test_sort_by_relevance():
    df1 = pd.DataFrame([{'id': 1, 'embedding': np.array([3.0, 1.0, 1.0])}])
    df2 = pd.DataFrame([{'id': 2, 'embedding': np.array([3.0, 2.0, 1.0])},
                        {'id': 3, 'embedding': np.array([3.0, 1.0, 1.0])},
                        {'id': 4, 'embedding': np.array([2.0, 5.0, 1.0])}])
    result = algorithm.sort_by_relevance(df1, df2)
    # Test if the dataframe is sorted correctly
    assert isinstance(result, pd.DataFrame)
    assert 'id', 'relevance' in result.columns
    assert result["id"].to_list() == [3, 2, 4]

    # Test with empty input
    df1 = pd.DataFrame([{'id': 1, 'embedding': np.array([3.0, 1.0, 1.0])}])
    df2 = pd.DataFrame(columns=['id', 'embedding'])
    result = algorithm.sort_by_relevance(df1, df2)

    assert isinstance(result, pd.DataFrame)
    assert 'id', 'relevance' in result.columns
    assert len(result) == 0
