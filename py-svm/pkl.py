import numpy as np
import cv2
from sklearn.preprocessing import StandardScaler
from sklearn.svm import SVC
import pickle
import os

# Function to extract features from images
def extract_features(image):
    gray_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    hist, _ = np.histogram(gray_image, bins=256, range=(0, 256))
    return hist

# Function to load dataset
def load_dataset(data_dir):
    X = []
    y = []
    for artist_dir in os.listdir(data_dir):
        if os.path.isdir(os.path.join(data_dir, artist_dir)):
            for filename in os.listdir(os.path.join(data_dir, artist_dir)):
                if filename.endswith('.jpg') or filename.endswith('.png'):
                    image_path = os.path.join(data_dir, artist_dir, filename)
                    try:
                        image = cv2.imread(image_path)
                        feature_vector = extract_features(image)
                        X.append(feature_vector)
                        y.append(artist_dir)
                    except Exception as e:
                        print(f"Error processing image {image_path}: {e}")
    return np.array(X), np.array(y)

# Load dataset
train_data_dir = 'dataset/train'
test_data_dir = 'dataset/test'
X, y = load_dataset(train_data_dir)

# Feature scaling
scaler = StandardScaler()
X_scaled = scaler.fit_transform(X)

# Initialize and train SVM classifier
svm_classifier = SVC(kernel='linear', class_weight='balanced')
svm_classifier.fit(X_scaled, y)

# Save the trained model
with open('svm_model.pkl', 'wb') as f:
    pickle.dump(svm_classifier, f)

print("Model trained and saved successfully.")
