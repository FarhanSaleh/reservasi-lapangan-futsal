<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Superadmin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- TOP NAVBAR -->
<nav class="bg-blue-500 text-white px-6 py-4 flex justify-between items-center">
    <h1 class="text-lg font-bold">👑 Superadmin Dashboard</h1>

    <div class="flex items-center gap-4">
        <span class="text-sm">
            {{ auth()->user()->name }} (Superadmin)
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 px-4 py-1 rounded hover:bg-red-600 text-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<!-- MAIN LAYOUT -->
<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white min-h-screen p-4 shadow">
        <ul class="space-y-3 text-sm">

            <li class="font-semibold text-purple-700">📊 Dashboard</li>

            <li class="hover:text-purple-600 cursor-pointer">
                👤 Manajemen User
            </li>

            <li class="hover:text-purple-600 cursor-pointer">
                🔐 Hak & Akses (RBAC)
            </li>

            <li class="hover:text-purple-600 cursor-pointer">
                ⚽ Data Lapangan
            </li>

            <li class="hover:text-purple-600 cursor-pointer">
                📅 Jadwal
            </li>

            <li class="hover:text-purple-600 cursor-pointer">
                📑 Reservasi
            </li>

            <li class="hover:text-purple-600 cursor-pointer">
                🧾 Log Aktivitas
            </li>

        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-6 space-y-8">

        <!-- WELCOME -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang 👋</h2>
            <p class="text-gray-600">
                Anda login sebagai <b>Superadmin</b>.  
                Anda memiliki akses penuh terhadap sistem.
            </p>
        </div>

        <!-- STAT BOX -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white p-4 rounded shadow text-center">
                <p class="text-gray-500 text-sm">Total User</p>
                <p class="text-2xl font-bold">12</p>
            </div>

            <div class="bg-white p-4 rounded shadow text-center">
                <p class="text-gray-500 text-sm">Admin</p>
                <p class="text-2xl font-bold">3</p>
            </div>

            <div class="bg-white p-4 rounded shadow text-center">
                <p class="text-gray-500 text-sm">Reservasi</p>
                <p class="text-2xl font-bold">27</p>
            </div>

            <div class="bg-white p-4 rounded shadow text-center">
                <p class="text-gray-500 text-sm">Lapangan</p>
                <p class="text-2xl font-bold">5</p>
            </div>

        </div>

        <!-- LOG ACTIVITY -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-4">🧾 Log Aktivitas Sistem</h3>

            <table class="w-full text-sm border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">User</th>
                        <th class="p-2 border">Aksi</th>
                        <th class="p-2 border">IP Address</th>
                        <th class="p-2 border">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="p-2 border">Admin</td>
                        <td class="p-2 border">Login</td>
                        <td class="p-2 border">127.0.0.1</td>
                        <td class="p-2 border">2025-12-16 20:30</td>
                    </tr>
                    <tr class="border-t">
                        <td class="p-2 border">User</td>
                        <td class="p-2 border">Buat Reservasi</td>
                        <td class="p-2 border">127.0.0.1</td>
                        <td class="p-2 border">2025-12-16 21:10</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- MANAGEMEN USER -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-4">👤 Manajemen User</h3>

            <table class="w-full text-sm border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Role</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="p-2 border">Admin</td>
                        <td class="p-2 border">admin@email.com</td>
                        <td class="p-2 border">
                            <select class="border rounded p-1">
                                <option>user</option>
                                <option selected>admin</option>
                                <option>superadmin</option>
                            </select>
                        </td>
                        <td class="p-2 border">
                            <button class="bg-blue-600 text-white px-2 py-1 rounded">
                                Update
                            </button>
                            <button class="bg-red-600 text-white px-2 py-1 rounded ml-2">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- RBAC INFO -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">🔐 Hak & Akses (RBAC)</h3>
            <ul class="text-sm text-gray-700 list-disc ml-5 space-y-1">
                <li>User: melihat lapangan & reservasi</li>
                <li>Admin: kelola lapangan & konfirmasi reservasi</li>
                <li>Superadmin: akses penuh & monitoring sistem</li>
            </ul>
        </div>

    </main>

</div>

</body>
</html>
