<!DOCTYPE html>
<html>
<head>
<title>sepwebdev contact mail</title>
</head>
<body>
<h1>sepwebdev contact mail</h1>
<p><strong>Name:</strong> {{ $details['name'] }}</p>
<p><strong>Email:</strong> {{ $details['email'] }}</p>
<p><strong>Message:</strong></p> 
{!! nl2br(e($details['body'])) !!}
</body>
</html>