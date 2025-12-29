<!DOCTYPE html>
<html>
<head>
    <title>Setup 2FA</title>
</head>
<body>

<h2>Scan QR Code di aplikasi Authenticator</h2>

<p>Secret Key:</p>
<h3>{{ $secret }}</h3>

<img src="{{ $qrCodeUrl }}" alt="QR Code">

<form action="{{ route('2fa.verify') }}" method="POST">
    @csrf
    <label>Masukkan OTP:</label>
    <input type="text" name="otp" required>
    <button type="submit">Verifikasi</button>
</form>

</body>
</html>
