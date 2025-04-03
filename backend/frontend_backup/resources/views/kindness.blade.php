@extends('layouts.app')

@section('title', 'Kindness - Pay It Forward')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kindness - Pay It Forward</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .header {
            background: linear-gradient(135deg, #0056b3, #007bff);
            color: white;
            padding: 50px 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 2.5rem;
            margin: 0;
        }
        .kindness-form {
            padding: 50px 20px;
            text-align: center;
        }
        .kindness-form form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 0 auto;
        }
        .kindness-form form label {
            margin-bottom: 5px;
        }
        .kindness-form form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .kindness-form form textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
        }
        .kindness-form form button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .kindness-form form button:hover {
            background-color: #0056b3;
        }
        .kindness-stats {
            padding: 50px 20px;
            text-align: center;
        }
        .kindness-stats h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .kindness-stats .stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .kindness-stats .stats .stat {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .kindness-stats .stats .stat h3 {
            margin: 10px 0;
        }
        .kindness-stats .stats .stat p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Kindness</h1>
    </div>
    <div class="kindness-form">
        <form action="/api/kindness" method="POST">
            @csrf
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required></textarea>

            <button type="submit">Submit Kindness</button>
        </form>
    </div>
    <div class="kindness-stats">
        <h2>Kindness Stats</h2>
        <div class="stats">
            <div class="stat">
                <h3>Total Kindness Acts</h3>
                <p>1000</p>
            </div>
            <div class="stat">
                <h3>Volunteers Registered</h3>
                <p>200</p>
            </div>
            <div class="stat">
                <h3>Stories of Kindness Shared</h3>
                <p>500</p>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
