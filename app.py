from flask import Flask, render_template, request, jsonify
import joblib
import numpy as np
import pandas as pd

app = Flask(__name__)

# Load the model
model = joblib.load('sample_submission_1.h5')

# Define the interpretation of prediction results
def interpret_prediction(prediction):
    if prediction == 1:
        return 'Graduated'
    elif prediction == 0:
        return 'Drop Out'
    elif prediction == 2:
        return 'Enrolled'
    else:
        return 'Unknown'

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/predict', methods=['POST'])
def predict():
    try:
        # Get data from request
        input_data = [float(request.form.get(f'inputData{i}')) for i in range(1, 10)]
        
        # Perform prediction
        prediction = model.predict(np.array(input_data).reshape(1, -1))[0]
        
        # Interpret prediction result
        status = interpret_prediction(prediction)

        return jsonify({'prediction': status}), 200
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
