import os
import numpy as np
from skimage import io, color
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.svm import SVC
from sklearn.metrics import accuracy_score

# Function to extract features from images
def extract_features(image):
    # Convert RGBA image to RGB format (if it's RGBA)
    if image.shape[2] == 4:
        image = color.rgba2rgb(image)

    # Convert the image to grayscale
    gray_image = color.rgb2gray(image)

    # Compute the histogram of pixel intensities
    hist, _ = np.histogram(gray_image, bins=256, range=(0, 1))

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
                        image = io.imread(image_path)
                        feature_vector = extract_features(image)
                        X.append(feature_vector)
                        y.append(artist_dir)
                    except Exception as e:
                        print(f"Error processing image {image_path}: {e}")
    return np.array(X), np.array(y)

# Load dataset
data_dir = r'dataset\train'
X, y = load_dataset(data_dir)

# Split data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Feature scaling
scaler = StandardScaler()
X_train = scaler.fit_transform(X_train)
X_test = scaler.transform(X_test)

# Initialize SVM classifier
svm_classifier = SVC(kernel='linear', class_weight='balanced')

# Train SVM classifier
svm_classifier.fit(X_train, y_train)

# Predict labels for test set
y_pred = svm_classifier.predict(X_test)

# Calculate accuracy
accuracy = accuracy_score(y_test, y_pred)
print("Accuracy:", accuracy)

# Predict artist for a new image
new_image_path = r'DogSample.jpg'
new_image = io.imread(new_image_path)
new_feature_vector = extract_features(new_image)
normalized_feature_vector = scaler.transform([new_feature_vector])  # Normalize features using the same scaler used during training
predicted_artist = svm_classifier.predict(normalized_feature_vector)
print("Predicted Object:", predicted_artist)
