"""
    This file contains the code to run each step of the AI algorithm.
"""

import re
from io import BytesIO
from pathlib import Path
from typing import Union, BinaryIO
import nltk
import numpy as np
import pandas as pd
import pdfplumber
from sentence_transformers import SentenceTransformer, util
from torch import tensor

model_name = 'distiluse-base-multilingual-cased-v1'


def initialize() -> None:
    """ Download the AI model and NLTK's tokens """
    SentenceTransformer(model_name, device='cpu')
    nltk.download('punkt')


def extract_from_pdf(file: Union[str, Path, BinaryIO, BytesIO]) -> str:
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

    def regex(sentence: str) -> str:
        sentence = re.sub(r'•\s', '', sentence)
        return re.sub('\n', ' ', sentence)

    return list(map(regex, sentences))


def encode(sentences: list[str], progress_bar: bool = False) -> np.ndarray:
    """ Compute the embedding that represents all the text of a document """
    model = SentenceTransformer(model_name, device='cpu')
    sentences_enc: np.ndarray = model.encode(sentences, show_progress_bar=progress_bar, convert_to_numpy=True)
    return np.mean(sentences_enc, axis=0)


def compute_relevance(a: np.ndarray, b: np.ndarray) -> np.ndarray:
    """ Use the embeddings to compute the relevance between two or more documents """
    return util.cos_sim(tensor(a), tensor(b)).numpy().transpose()


def sort_by_relevance(df1: pd.DataFrame, df2: pd.DataFrame) -> pd.DataFrame:
    """ Process the embeddings contained in two dataframes and return another dataframe with sorted relevance scores """
    df = pd.DataFrame(columns=["id", "relevance"])
    if df1.empty or df2.empty:
        # Return empty dataframe
        return df
    else:
        # Perform the computation
        df["id"] = df2.iloc[:, 0]
        df["relevance"] = compute_relevance(np.stack(df1["embedding"]), np.stack(df2["embedding"]))
        return df.sort_values(by='relevance', ascending=False)
