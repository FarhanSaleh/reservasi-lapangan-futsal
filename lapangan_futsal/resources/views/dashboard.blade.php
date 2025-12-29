<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <p class="mb-2">
            <strong>Nama:</strong> {{ $user->name }}
        </p>

        <p class="mb-2">
            <strong>Email:</strong> {{ $user->email }}
        </p>

        <p class="mb-6">
            <strong>Role:</strong>
            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded">
                {{ $user->role }}
            </span>
        </p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>

</body>
</html>
