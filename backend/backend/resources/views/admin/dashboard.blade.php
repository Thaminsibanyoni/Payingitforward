<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>
<div class="header">
    <h1>Admin Dashboard</h1>
</div>
<div class="content">
    <div class="card">
        <h2>Quick Overview</h2>
        <p>Total Users Registered: {{ $totalUsers }}</p>
        <p>Total Donations Received: {{ $totalDonations }}</p>
        <p>Total Rewards Redeemed: {{ $totalRewards }}</p>
        <p>Active Users: {{ $activeUsers }}</p>
        <p>Suspended Users: {{ $suspendedUsers }}</p>
        <p>Pending Withdrawal Requests: {{ $pendingWithdrawals }}</p>
    </div>
    <div class="card">
        <h2>User Management</h2>
        <p>Manage users, approve new registrations, and suspend accounts.</p>
    </div>
    <div class="card">
        <h2>Donation Management</h2>
        <p>View all donations, approve or reject transactions, and set donation goals.</p>
    </div>
    <div class="card">
        <h2>Rewards & Wallet Management</h2>
        <p>Manage reward points, create reward items, and approve redemption requests.</p>
    </div>
    <div class="card">
        <h2>Payment System & Withdrawal Requests</h2>
        <p>Monitor transactions, approve withdrawal requests, and set platform fees.</p>
    </div>
    <div class="card">
        <h2>Notifications & Communication Center</h2>
        <p>Send push notifications, manage email templates, and handle user inquiries.</p>
    </div>
    <div class="card">
        <h2>Analytics & Reporting</h2>
        <p>View user growth analytics, donation reports, and engagement statistics.</p>
    </div>
    <div class="card">
        <h2>Content Management System (CMS)</h2>
        <p>Update frontend content, manage blog posts, and edit legal documents.</p>
    </div>
    <div class="card">
        <h2>SEO & Platform Settings</h2>
        <p>Manage SEO settings, configure platform-wide features, and update branding.</p>
    </div>
    <div class="card">
        <h2>Security & Compliance</h2>
        <p>Set 2FA, implement content moderation, and ensure data encryption.</p>
    </div>
</div>
</body>
</html>
