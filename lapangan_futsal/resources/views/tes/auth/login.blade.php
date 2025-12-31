<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <p class="text-red-500 font-bold">
        @session('error')
        {{ session('error') }}
        @endsession
    </p>
    <form action="/login" method="POST">
        @csrf
        @method("POST")
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
            <button type="submit" class="border">Login</button>
        </div>
    </form>
</body>

</html>