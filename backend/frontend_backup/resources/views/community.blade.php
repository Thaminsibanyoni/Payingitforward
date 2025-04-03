@extends('layouts.app')

@section('title', 'Community - Pay It Forward')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community - Pay It Forward</title>
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
        .map {
            padding: 50px 20px;
            text-align: center;
        }
        .map iframe {
            width: 100%;
            height: 400px;
            border: none;
        }
        .activity-feed {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 50px 20px;
        }
        .activity-feed .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .activity-feed .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .activity-feed .card h3 {
            margin: 10px 0;
        }
        .activity-feed .card p {
            margin: 0;
        }
        .leaderboard {
            padding: 50px 20px;
            text-align: center;
        }
        .leaderboard h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .leaderboard .rank {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .leaderboard .rank img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .leaderboard .rank .info {
            text-align: left;
        }
        .leaderboard .rank .info h3 {
            margin: 0;
        }
        .leaderboard .rank .info p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Community</h1>
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509841!2d144.9537363156114!3d-37.81627974202189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf4c9e2f3449f569c!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sus!4v1633123456789!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="activity-feed">
        <div class="card">
            <img src="activity1.png" alt="Activity 1">
            <h3>Activity 1</h3>
            <p>Description of activity 1.</p>
        </div>
        <div class="card">
            <img src="activity2.png" alt="Activity 2">
            <h3>Activity 2</h3>
            <p>Description of activity 2.</p>
        </div>
        <div class="card">
            <img src="activity3.png" alt="Activity 3">
            <h3>Activity 3</h3>
            <p>Description of activity 3.</p>
        </div>
    </div>
    <div class="leaderboard">
        <h2>Leaderboard</h2>
        <div class="rank">
            <img src="user1.png" alt="User 1">
            <div class="info">
                <h3>User 1</h3>
                <p>Points: 1000</p>
            </div>
        </div>
        <div class="rank">
            <img src="user2.png" alt="User 2">
            <div class="info">
                <h3>User 2</h3>
                <p>Points: 900</p>
            </div>
        </div>
        <div class="rank">
            <img src="user3.png" alt="User 3">
            <div class="info">
                <h3>User 3</h3>
                <p>Points: 800</p>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
