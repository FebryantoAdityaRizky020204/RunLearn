import streamlit as st
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.preprocessing import MinMaxScaler, LabelEncoder

st.set_page_config(layout="wide")
st.title("Analisis dan Klasifikasi Data Student Performance")

# Load data
df_raw = pd.read_csv("./../Student_performance_data_.csv")

st.header("1. Data Awal")
st.subheader("Preview Data")
st.dataframe(df_raw.head())

st.subheader("Statistik Deskriptif")
st.dataframe(df_raw.describe(include='all'))

st.subheader("Missing Values")
st.dataframe(df_raw.isnull().sum())

# Mapping label kategorikal
df_processed = df_raw.copy()
label_maps = {
    'Gender': {0: "Male", 1: "Female"},
    'Ethnicity': {0: "Caucasian", 1: "African American", 2: "Asian", 3: "Other"},
    'ParentalEducation': {0: "None", 1: "High School", 2: "Some College", 3: "Bachelor's", 4: "Higher"},
    'ParentalSupport': {0: "None", 1: "Low", 2: "Moderate", 3: "High", 4: "Very High"},
    'Extracurricular': {0: "No", 1: "Yes"},
    'Sports': {0: "No", 1: "Yes"},
    'Music': {0: "No", 1: "Yes"},
    'Volunteering': {0: "No", 1: "Yes"},
    'GradeClass': {0: 'A', 1: 'B', 2: 'C', 3: 'D', 4: 'F'},
    'Tutoring': {0: 'No', 1: 'Yes'}
}
for col, mapping in label_maps.items():
    df_processed[col] = df_processed[col].map(mapping)

features_to_scale = ['Age', 'StudyTimeWeekly', 'Absences', 'GPA']
df_scaled = df_processed.copy()
scaler = MinMaxScaler()
df_scaled[features_to_scale] = scaler.fit_transform(df_scaled[features_to_scale])

st.header("2. Analisis Korelasi")
df_encoded = df_scaled.copy()
for col in df_encoded.select_dtypes(include='object').columns:
    df_encoded[col] = LabelEncoder().fit_transform(df_encoded[col])

corr_matrix = df_encoded.drop(columns=['StudentID']).corr()
fig, ax = plt.subplots(figsize=(12, 8))
sns.heatmap(corr_matrix, annot=True, fmt=".2f", cmap="coolwarm", ax=ax)
st.pyplot(fig)

st.header("3. Visualisasi Distribusi Data")
selected_col = st.selectbox("Pilih kolom untuk visualisasi", df_scaled.columns)

fig2, ax2 = plt.subplots(figsize=(6, 4))
if df_scaled[selected_col].dtype == 'object':
    sns.countplot(data=df_scaled, x=selected_col, ax=ax2)
else:
    sns.histplot(df_scaled[selected_col], kde=True, color='skyblue', bins=10, ax=ax2)
st.pyplot(fig2)

st.success("Analisis korelasi dan distribusi data berhasil ditampilkan.")
