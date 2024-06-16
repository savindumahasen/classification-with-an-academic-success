from flask import Flask, render_template, request, jsonify
import pickle
import numpy as np

app = Flask(__name__)

# Load the model
with open('sample_submission_1.h5', 'rb') as model_file:
    model = pickle.load(model_file)

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
        data = request.get_json()
        if not data:
            return jsonify({'message': 'No input data provided'}), 400

        # Extract input data from JSON
        input_data = [
            data.get("inputData1"),
            data.get("inputData2"),
            data.get("inputData3"),
            data.get("inputData4"),
            data.get("inputData5"),
            data.get("inputData6"),
            data.get("inputData7"),
            data.get("inputData8"),
            data.get("inputData9")
        ]

        # Check for missing values
        if None in input_data:
            return jsonify({'message': 'Please enter numeric values for all fields.'}), 400

        # Convert input data to numpy array
        input_data = np.array([input_data], dtype=float)

        # Make prediction
        pred = model.predict(input_data)

        # Interpret prediction result
        prediction = interpret_prediction(pred[0])

        return jsonify({'prediction': prediction}), 200

    except Exception as e:
        return jsonify({'message': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
