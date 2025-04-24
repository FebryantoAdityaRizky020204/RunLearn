import streamlit as st
import pandas as pd
import numpy as np

st.set_page_config(layout="wide")
st.title("Analisis dan Klasifikasi Data Student Performance")

# Load data
df_raw = pd.read_csv("./../Student_performance_data_.csv")

st.table(df_raw.head())
st.write("Data Shape:", df_raw.shape)
st.write("Data Columns:", df_raw.columns.tolist())
st.write("Data Types:", df_raw.dtypes)
st.write("Missing Values:", df_raw.isnull().sum().sum())