<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Futsal Reservasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-600 to-blue-800 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-lg shadow-2xl p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <i class="fas fa-futbol text-4xl text-blue-600 mb-4"></i>
                    <h1 class="text-3xl font-bold text-gray-800">Futsal Reservasi</h1>
                </a>
                <p class="text-gray-600 mt-2">Masuk ke akun Anda</p>
            </div>

            <!-- Alerts -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm"><i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <i class="fas fa-times-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock text-blue-600 mr-2"></i>Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember"
                        class="h-4 w-4 text-blue-600 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition transform hover:scale-105"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau</span>
                </div>
            </div>

            <!-- Links -->
            <div class="space-y-3">
                <p class="text-center text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar di sini</a>
                </p>
                <a href="/" class="block text-center text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                </a>
            </div>

            <!-- Demo Info -->
            <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-xs text-gray-600 font-semibold mb-2"><i class="fas fa-info-circle mr-2"></i>Demo Akun:</p>
                <p class="text-xs text-gray-600"><strong>Admin:</strong> admin@futsal.com</p>
                <p class="text-xs text-gray-600"><strong>Customer:</strong> customer@futsal.com</p>
                <p class="text-xs text-gray-600 mt-1"><strong>Password:</strong> password123</p>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center text-white mt-8">
            <p class="text-sm">Hubungi support jika ada kendala</p>
        </div>
    </div>
</body>
</html>
    <p>Super Admin: superadmin@example.com | 123456</p>
</div>
@endsection
