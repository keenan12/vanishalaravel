<!DOCTYPE html>
<html>
<head>
    <title>Pesan Baru dari Vanisha Bakery</title>
</head>
<body>
    <p>Anda menerima pesan baru dari kontak formulir di website:</p>
    
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ $data['message'] }}</p>
    
    <hr>
    <p>Pesan ini dikirim otomatis oleh sistem Vanisha Bakery.</p>
</body>
</html>