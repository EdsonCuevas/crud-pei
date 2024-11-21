<!DOCTYPE html>
<html>

<head>
    <title>Contact Message</title>
</head>

<body>
    <h1>New Contact Message</h1>
    <p><strong>First Name:</strong> {{ $data['firstName'] }}</p>
    <p><strong>Last Name:</strong> {{ $data['lastName'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>

</html>
