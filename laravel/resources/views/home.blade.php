<!DOCTYPE html>
<html>
<head>
    <title>Prediction App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .form-wrapper {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 900px;
        }
        .form-header {
            margin-bottom: 30px;
            text-align: center;
            color: #007bff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        #result {
            text-align: center;
            margin-top: 20px;
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="form-wrapper">
        <h2 class="form-header">Academic Prediction</h2>
        <form id="prediction-form" method="POST" action="/predict">
            @csrf
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="inputData1">Application Order</label>
                    <input type="number" max="1" min="0" class="form-control" id="inputData1" name="name1" placeholder="Enter input data">
                </div>
                <div class="col-md-4 form-group">
                    <label for="inputData2">Previous Grade</label>
                    <input type="number" max="1" min="0" class="form-control" id="inputData2" name="name2" placeholder="Enter input data">
                </div>
                <div class="col-md-4 form-group">
                    <label for="inputData3">Tuition Fees Up to Date</label>
                    <input type="number" class="form-control" id="inputData3" name="name3" placeholder="Enter input data">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="inputData5"> 1st Sem (Enrolled)</label>
                    <input type="text" class="form-control" id="inputData5" name="name4" placeholder="Enter input data">
                </div>
                <div class="col-md-4 form-group">
                    <label for="inputData6"> 1st Sem (Approved)</label>
                    <input type="text" class="form-control" id="inputData6" name="name5" placeholder="Enter input data">
                </div>
                <div class="col-md-4 form-group">
                    <label for="inputData7">1st Sem (Grade)</label>
                    <input type="text" class="form-control" id="inputData7" name="name6" placeholder="Enter input data">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="inputData8"> 2nd Sem (Without Evaluations)</label>
                    <input type="text" class="form-control" id="inputData8" name="name7" placeholder="Enter input data">
                </div>
                <div class="col-md-4 form-group">
                    <label for="inputData9">2nd Sem (Enrolled)</label>
                    <input type="text" class="form-control" id="inputData9" name="name8" placeholder="Enter input data">
                </div>
                <div class="col-md-4 form-group">
                    <label for="inputData10"> 2nd Sem (Approved)</label>
                    <input type="text" class="form-control" id="inputData10" name="name9" placeholder="Enter input data">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 form-group" style="margin-left: -440px;">
                    <label for="inputData11">2nd Sem (Grade)</label>
                    <input type="text" class="form-control" id="inputData11" name="name10" placeholder="Enter input data">
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 150px;">Predict</button>
            </div>
        </form>
        <div class="mt-3">
            <h4 id="result"></h4>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#prediction-form').on('submit', function(e) {
            e.preventDefault();
            
            var inputData = [];
            for (var i = 1; i <= 11; i++) {
                inputData.push($('#inputData' + i).val());
            }
            
            $.ajax({
                url: '/predict',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    input_data: JSON.stringify(inputData)
                },
                success: function(response) {
                    $('#result').text('The predicted value is: ' + response.prediction);
                },
                error: function(error) {
                    $('#result').text('Error: ' + error.responseJSON.message);
                }
            });
        });
    });
</script>
</body>
</html>
