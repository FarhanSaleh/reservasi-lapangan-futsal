<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
                   @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="bg-blue-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-xl w-full max-w-md p-8">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Login</h2>

        <form action="{{ route('login.process') }}" method="POST">
        @csrf

            
            <!-- Email -->
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input 
                    type="email"
                    name="email" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan email"
                    required
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 mb-1">Password</label>
                <input 
                    type="password"
                    name="password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <!-- Tombol Login -->
            <button 
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                Masuk
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-gray-600">Belum punya akun?</p>
            <a 
                href="/register"
                class="text-blue-600 font-semibold hover:underline">
                Daftar Sekarang
            </a>
        </div>
    </div>

</body>
</html>
