<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="h-screen flex items-center justify-center">
        <form action="/login" method="POST">
            <div class="card w-auto sm:w-96 bg-base-100 shadow-sm">
                <div class="card-body">
                    <h1 class="text-2xl font-bold">Login</h1>
                    <p class="text-red-500 font-bold">
                        @session('error')
                        {{ session('error') }}
                        @endsession
                    </p>
                    @csrf
                    @method("POST")
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Email</legend>
                        <input type="text" class="input w-full" placeholder="Email" name="email"
                            value="{{ old('email') }}" />
                        @error('email')
                        <p class="label text-red-500">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Password</legend>
                        <input type="password" class="input w-full" placeholder="Password" name="password"
                            value="{{ old('password') }}" />
                        @error('password')
                        <p class="label text-red-500">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <p class="text-xs self-center">Belum punya akun? <a class="text-primary font-bold" href="/register">Daftar</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>