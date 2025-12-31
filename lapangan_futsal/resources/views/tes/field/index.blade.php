<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <h1 class="text-2xl">Lapangan</h1>
    @session('success')
    <div class="text-green-500">
        {{ session('success') }}
    </div>
    @endsession
    @session('error')
    <div class="text-red-500">
        {{ session('error') }}
    </div>
    @endsession
    <a href="/fields/create" class="border">Create</a>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="border">Name</th>
                <th class="border">Type</th>
                <th class="border">Price Per Hour</th>
                <th class="border">Status</th>
                <th class="border">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fields as $field)
            <tr>
                <td class="border p-2">{{ $field->name }}</td>
                <td class="border p-2">{{ $field->type }}</td>
                <td class="border p-2">{{ $field->price_per_hour }}</td>
                <td class="border p-2">{{ $field->status }}</td>
                <td class="border p-2">
                    <a href="/fields/{{ $field->id }}/edit" class="border">Edit</a>
                    <form action="/fields/{{ $field->id }}" method="POST" class="inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="border">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>