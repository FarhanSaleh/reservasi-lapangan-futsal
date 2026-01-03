<x-base-layout>
    <h1 class="text-2xl">Activity Log</h1>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="border">User</th>
                <th class="border">Action</th>
                <th class="border">Deskripsi</th>
                <th class="border">Ip Address</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td class="border p-2">{{ $log->user ? $log->user->name : '-' }}</td>
                <td class="border p-2">{{ $log->action }}</td>
                <td class="border p-2">{{ $log->description }}</td>
                <td class="border p-2">{{ $log->ip_address }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</x-base-layout>