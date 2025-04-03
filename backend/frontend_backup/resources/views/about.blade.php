@extends('layouts.app')

@section('title', 'About - Pay It Forward')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Pay It Forward</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .hero {
            background: linear-gradient(135deg, #0056b3, #007bff);
            color: white;
            padding: 100px 20px;
            text-align: center;
            background-image: url('about-hero.jpg');
            background-size: cover;
            background-position: center;
        }
        .hero h1 {
            font-size: 3rem;
            margin: 0;
        }
        .hero p {
            font-size: 1.2rem;
            margin: 20px 0;
        }
        .our-mission {
            padding: 50px 20px;
            text-align: center;
        }
        .our-mission h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .our-mission p {
            font-size: 1.2rem;
            margin: 20px 0;
        }
        .our-mission .values {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .our-mission .values .value {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .our-mission .values .value img {
            width: 50px;
            height: 50px;
        }
        .our-mission .values .value h3 {
            margin: 10px 0;
        }
        .our-mission .values .value p {
            margin: 0;
        }
        .meet-the-team {
            padding: 50px 20px;
            text-align: center;
        }
        .meet-the-team h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .meet-the-team .team {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .meet-the-team .team .member {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .meet-the-team .team .member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .meet-the-team .team .member h3 {
            margin: 10px 0;
        }
        .meet-the-team .team .member p {
            margin: 0;
        }
        .impact-stats {
            padding: 50px 20px;
            text-align: center;
        }
        .impact-stats h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .impact-stats .stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .impact-stats .stats .stat {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .impact-stats .stats .stat h3 {
            margin: 10px 0;
        }
        .impact-stats .stats .stat p {
            margin: 0;
        }
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .our-mission .values .value {
                width: 100%;
            }
            .meet-the-team .team .member {
                width: 100%;
            }
            .impact-stats .stats .stat {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>Together, we create a world of kindness.</h1>
        <p>Our mission is to spread kindness and make a positive impact on the world.</p>
    </div>
    <div class="our-mission">
        <h2>Our Mission</h2>
        <p>To spread kindness and make a positive impact on the world.</p>
        <div class="values">
            <div class="value">
                <img src="compassion.png" alt="Compassion">
                <h3>Compassion</h3>
                <p>We care for others and strive to make a difference.</p>
            </div>
            <div class="value">
                <img src="community.png" alt="Community">
                <h3>Community</h3>
                <p>We believe in the power of togetherness.</p>
            </div>
            <div class="value">
                <img src="transparency.png" alt="Transparency">
                <h3>Transparency</h3>
                <p>We are open and honest in our actions.</p>
            </div>
        </div>
    </div>
    <div class="meet-the-team">
        <h2>Meet the Team</h2>
        <div class="team">
            <div class="member">
                <img src="team1.png" alt="Team Member 1">
                <h3>Team Member 1</h3>
                <p>Role: Founder</p>
            </div>
            <div class="member">
                <img src="team2.png" alt="Team Member 2">
                <h3>Team Member 2</h3>
                <p>Role: Developer</p>
            </div>
            <div class="member">
                <img src="team3.png" alt="Team Member 3">
                <h3>Team Member 3</h3>
                <p>Role: Designer</p>
            </div>
        </div>
    </div>
    <div class="impact-stats">
        <h2>Impact Stats</h2>
        <div class="stats">
            <div class="stat">
                <h3>Total Donations Collected</h3>
                <p>$10,000</p>
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
