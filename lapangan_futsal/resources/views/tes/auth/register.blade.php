<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <form action="/register" method="POST">
        @csrf
        @method("POST")
        <div>
            @error('name')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="name" placeholder="Nama" class="border" value="{{ old('name') }}">
        </div>
        <div>
            @error('email')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="email" placeholder="Email" class="border" value="{{ old('email') }}">
        </div>
        <div>
            @error('password')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="password" name="password" placeholder="Password" class="border">
        </div>
        <div>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="border">
        </div>
        <div>
            <button type="submit" class="border">Register</button>
        </div>
    </form>
</body>

</html>