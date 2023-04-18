import re
import nltk
import numpy as np
import pandas as pd
import pdfplumber

nltk.download('punkt')


def load_data() -> tuple[np.ndarray, np.ndarray, np.ndarray, np.ndarray]:
    # Pre-processing
    df = pd.read_csv('data/sts-train.csv', sep=';')
    df = df[['score', 'sentence1', 'sentence2']]
    df = df.dropna()

    # Extract the sentences as a list
    sentences1 = df['sentence1'].to_list()
    sentences2 = df['sentence2'].to_list()
    sentences = sentences1 + sentences2

    # Min-max scaling of the score, to reduce it in the range [0,1]
    df['score'] = (df['score'] - df['score'].min()) / (df['score'].max() - df['score'].min())
    true_scores = df['score'].to_numpy()

    return sentences1, sentences2, sentences, true_scores


def extract_from_pdf(path: str) -> str:
    # Open the file
    with pdfplumber.open(path) as pdf:
        # Extract text from every page
        texts = [page.extract_text(x_tolerance=1) for page in pdf.pages]
    # Join everything in a single string
    return "  \n\n".join(texts)


def pre_process(text: str) -> list[str]:
    # Tokenize and remove some symbols
    sentences = nltk.sent_tokenize(text)
    sentences = [re.sub('•', '', sentence) for sentence in sentences]
    return [re.sub('\n', ' ', sentence) for sentence in sentences]
