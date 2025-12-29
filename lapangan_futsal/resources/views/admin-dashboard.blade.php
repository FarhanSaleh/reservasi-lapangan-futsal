<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-blue-700 text-white px-6 py-4 flex justify-between">
    <h1 class="font-bold text-lg">⚙️ Admin Panel</h1>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="bg-red-500 px-4 py-1 rounded">Logout</button>
    </form>
</nav>

<!-- CONTENT -->
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LAPANGAN -->
        <a href="{{ route('admin.lapangan') }}" class="bg-white p-6 rounded shadow hover:bg-blue-50">
            <h3 class="font-semibold text-lg">🏟️ Data Lapangan</h3>
            <p class="text-sm text-gray-600">Kelola lapangan futsal</p>
        </a>

        <!-- RESERVASI -->
        <a href="{{ route('admin.reservasi') }}" class="bg-white p-6 rounded shadow hover:bg-blue-50">
            <h3 class="font-semibold text-lg">📋 Reservasi</h3>
            <p class="text-sm text-gray-600">Konfirmasi reservasi user</p>
        </a>

    </div>
</div>

</body>
</html>