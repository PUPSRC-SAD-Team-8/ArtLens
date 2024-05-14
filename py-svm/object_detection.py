import numpy as np
import cv2
from sklearn.preprocessing import StandardScaler
from sklearn.svm import SVC
import pickle

# Function to extract features from images
def extract_features(image):
    gray_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    hist, _ = np.histogram(gray_image, bins=256, range=(0, 256))
    return hist

# Function for object detection
def detect_objects(image):
    # Convert image to grayscale
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Apply Gaussian blur to reduce noise
    blurred = cv2.GaussianBlur(gray, (5, 5), 0)

    # Use adaptive thresholding to binarize the image
    thresh = cv2.adaptiveThreshold(blurred, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY_INV, 11, 2)

    # Apply morphological opening to remove small noise
    kernel = np.ones((3, 3), np.uint8)
    opening = cv2.morphologyEx(thresh, cv2.MORPH_OPEN, kernel, iterations=2)

    # Find contours of objects
    contours, _ = cv2.findContours(opening, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    # Draw bounding boxes around detected objects
    detected_objects = []
    for contour in contours:
        area = cv2.contourArea(contour)
        if 500 < area < 10000:  # Adjust min and max area thresholds as needed
            x, y, w, h = cv2.boundingRect(contour)
            detected_objects.append((x, y, w, h))
            cv2.rectangle(image, (x, y), (x + w, y + h), (0, 255, 0), 2)

    return image, detected_objects

# Function for object recognition
def recognize_objects(image, objects, classifier):
    recognized_objects = []
    for (x, y, w, h) in objects:
        # Extract object ROI and resize it
        object_roi = image[y:y + h, x:x + w]
        object_roi = cv2.resize(object_roi, (64, 64))  # Resize to fixed size for classification
        # Extract features from the object ROI
        feature_vector = extract_features(object_roi)
        # Predict object class
        predicted_class = classifier.predict([feature_vector])[0]
        recognized_objects.append((x, y, w, h, predicted_class))
    return recognized_objects

# Load trained SVM model
with open('svm_model.pkl', 'rb') as f:
    svm_classifier = pickle.load(f)

# Create a capture object to read from the camera
cap = cv2.VideoCapture(0)  # Use 0 for the default camera

# Loop to capture frames from the camera feed
while True:
    # Capture frame-by-frame
    ret, frame = cap.read()
    if not ret:
        print("Error: Unable to capture frame")
        break

    # Perform object detection
    detected_frame, detected_objects = detect_objects(frame)

    # Perform object recognition
    recognized_objects = recognize_objects(frame, detected_objects, svm_classifier)

    # Display results
    for (x, y, w, h, predicted_class) in recognized_objects:
        cv2.rectangle(detected_frame, (x, y), (x + w, y + h), (255, 0, 0), 2)
        cv2.putText(detected_frame, predicted_class, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (255, 0, 0), 2)

    cv2.namedWindow('Object Detection and Recognition', cv2.WINDOW_NORMAL)
    cv2.imshow('Object Detection and Recognition', detected_frame)

    # Break the loop if 'q' key is pressed
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release the capture object and close all windows
cap.release()
cv2.destroyAllWindows()
