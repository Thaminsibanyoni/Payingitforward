<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer - Pay It Forward</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .footer {
            background-color: #0056b3;
            color: white;
            padding: 50px 20px;
            text-align: center;
        }
        .footer .links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .footer .links a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
        }
        .footer .newsletter {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .footer .newsletter input {
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 10px;
        }
        .footer .newsletter button {
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
        }
        .footer .newsletter button:hover {
            background-color: #e0a800;
        }
        @media (max-width: 768px) {
            .footer .links a {
                font-size: 1rem;
            }
            .footer .newsletter input {
                width: 100%;
            }
            .footer .newsletter button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="footer">
        <div class="links">
            <a href="/about">About</a>
            <a href="/community">Community</a>
            <a href="/donations">Donations</a>
            <a href="/contact">Contact</a>
        </div>
        <div class="newsletter">
            <input type="email" placeholder="Enter your email">
            <button>Subscribe</button>
        </div>
    </div>
</body>
</html>
