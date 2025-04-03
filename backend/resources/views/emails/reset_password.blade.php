<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <p>Click the link below to reset your password:</p>
    <a href="{{ url('password/reset', $token) }}">Reset Password</a>
</body>
</html>
