<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <h1 class="text-2xl">Dashbaord</h1>
    <form action="/logout" method="POST">
        @csrf
        @method("DELETE")
        <button type="submit" class="border">Logout</button>
    </form>
</body>

</html>