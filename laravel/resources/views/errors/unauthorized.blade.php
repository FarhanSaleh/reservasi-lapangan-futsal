<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - Futsal Reservasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-red-600 to-red-800 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-2xl p-8 text-center">
            <i class="fas fa-lock text-6xl text-red-600 mb-4 block"></i>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">403</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Akses Ditolak</h2>
            <p class="text-gray-600 mb-6">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
            
            <div class="space-y-3">
                <a href="/" class="block w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
                @auth
                <form action="{{ route('logout') }}" method="POST" class="inline-block w-full">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white font-bold py-2 rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
