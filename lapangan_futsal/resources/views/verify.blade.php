<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>

<h2>Masukkan kode OTP dari aplikasi auth</h2>

<form action="{{ route('2fa.verify') }}" method="POST">
    @csrf
    <input type="text" name="otp" required>
    <button type="submit">Verify</button>
</form>

@if(session('error'))
<p style="color:red;">{{ session('error') }}</p>
@endif

</body>
</html>
