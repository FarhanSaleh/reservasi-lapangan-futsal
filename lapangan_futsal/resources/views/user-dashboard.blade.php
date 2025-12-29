<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard | Reservasi Futsal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-green-600 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">⚽ Reservasi Futsal</h1>

        <div class="flex items-center gap-4">
            <span class="text-sm">
                Login sebagai: <b>{{ auth()->user()->name }}</b>
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 px-4 py-1 rounded hover:bg-red-600 text-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="p-6">

        <!-- WELCOME -->
        <div class="bg-white rounded shadow p-6 mb-6">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang 👋</h2>
            <p class="text-gray-600">
                Silakan lakukan reservasi lapangan futsal dengan memilih jadwal yang tersedia.
            </p>
        </div>

        <!-- MENU CARD -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- LIHAT JADWAL -->
            <div class="bg-white rounded shadow p-6">
                <h3 class="text-lg font-semibold mb-2">📅 Jadwal Lapangan</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Lihat jadwal lapangan yang tersedia hari ini.
                </p>
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Lihat Jadwal
                </button>
            </div>

            <!-- BUAT RESERVASI -->
            <div class="bg-white rounded shadow p-6">
                <h3 class="text-lg font-semibold mb-2">📝 Buat Reservasi</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Ajukan pemesanan lapangan futsal secara online.
                </p>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Reservasi Sekarang
                </button>
            </div>

            <!-- RIWAYAT -->
            <div class="bg-white rounded shadow p-6">
                <h3 class="text-lg font-semibold mb-2">📖 Riwayat Reservasi</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Lihat status dan riwayat reservasi Anda.
                </p>
                <button class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                    Lihat Riwayat
                </button>
            </div>

        </div>

        <!-- INFO -->
        <div class="mt-8 bg-yellow-100 border border-yellow-300 p-4 rounded">
            <p class="text-sm text-yellow-800">
                ⚠️ Catatan: Reservasi akan diproses oleh admin.  
                Pastikan memilih jadwal yang benar.
            </p>
        </div>

    </div>

</body>
</html>