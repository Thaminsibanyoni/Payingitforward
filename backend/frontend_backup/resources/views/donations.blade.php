@extends('layouts.app')

@section('title', 'Donations - Pay It Forward')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations - Pay It Forward</title>
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
        .donation-form {
            padding: 50px 20px;
            text-align: center;
        }
        .donation-form form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 0 auto;
        }
        .donation-form form label {
            margin-bottom: 5px;
        }
        .donation-form form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .donation-form form button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .donation-form form button:hover {
            background-color: #0056b3;
        }
        .donation-stats {
            padding: 50px 20px;
            text-align: center;
        }
        .donation-stats h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .donation-stats .stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .donation-stats .stats .stat {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .donation-stats .stats .stat h3 {
            margin: 10px 0;
        }
        .donation-stats .stats .stat p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Donations</h1>
    </div>
    <div class="donation-form">
        <form action="/api/donate" method="POST">
            @csrf
            <label for="amount">Donation Amount</label>
            <input type="number" id="amount" name="amount" required>

            <label for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method" required>
                <option value="bitcoin">Bitcoin</option>
                <option value="payfast">PayFast</option>
                <option value="paypal">PayPal</option>
            </select>

            <button type="submit">Donate</button>
        </form>
    </div>
    <div class="donation-stats">
        <h2>Donation Stats</h2>
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
