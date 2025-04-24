import streamlit as st
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.preprocessing import MinMaxScaler, LabelEncoder
from pgmpy.models import DiscreteBayesianNetwork
from pgmpy.estimators import MaximumLikelihoodEstimator
from pgmpy.inference import VariableElimination

st.set_page_config(layout="wide")
st.title("Analisis dan Klasifikasi Data Student Performance")

st.header("KELOMPOK 6")

namaKelompok = pd.DataFrame({
    "Nama" : ["Yunisa Nur Safa", "Willy Azrieel", "Aditya Rizky Febryanto", "Novita Maria", "Milky Gratia Br Sitorus", "Melda Nia Yuliani", "Dectrixie Theodore Mayumi S."],
    "NIM" : ["223020503078", "223020503101", "223020503108", "223020503109", "223020503116", "223020503119", "223020503140"]
})
st.table(namaKelompok)

