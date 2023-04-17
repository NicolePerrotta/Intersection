"""
    This file contains the code to run each step of the AI algorithm.
"""

import re
from pathlib import Path
from typing import Union, BinaryIO
import nltk
import numpy as np
import pdfplumber
from sentence_transformers import SentenceTransformer, util
from torch import Tensor


def initialize() -> None:
    """ Download the AI model and NLTK's tokens """
    SentenceTransformer('distiluse-base-multilingual-cased-v1', device='cpu')
    nltk.download('punkt')


def extract_from_pdf(file: Union[str, Path, BinaryIO]) -> str:
    """ Given a PDF or its path, extract all the text into a string """
    # Open the file
    with pdfplumber.open(file) as pdf:
        # Extract text from every page
        texts: list[str] = [page.extract_text() for page in pdf.pages]
    # Join everything in a single string
    return "  \n\n".join(texts)


def pre_process(text: str) -> list[str]:
    """ Pre-process the text so that it can be given as input to the model """
    sentences: list[str] = nltk.sent_tokenize(text)
    sentences = [re.sub('•', '', sentence) for sentence in sentences]
    return [re.sub('\n', ' ', sentence) for sentence in sentences]


def encode(sentences: list[str], progress_bar: bool = False) -> np.ndarray:
    """ Compute the embedding that represents all the text of a document """
    model: SentenceTransformer = SentenceTransformer('distiluse-base-multilingual-cased-v1', device='cpu')
    sentences_enc: np.ndarray = model.encode(sentences, show_progress_bar=progress_bar, convert_to_numpy=True)
    return np.mean(np.array(sentences_enc), axis=0)


def compute_relevance(a: Tensor, b: Tensor) -> np.ndarray:
    """ Use the embeddings to compute the relevance between two or more documents """
    return util.cos_sim(Tensor(a), Tensor(b)).numpy()
