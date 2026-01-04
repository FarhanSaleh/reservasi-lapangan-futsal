<x-base-layout>
    <h1 class="text-2xl">Dashbaord</h1>
    <div class="stats shadow">
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pengelola'))
        <div class="stat bg-base-100">
            <div class="stat-title">Total Pengguna</div>
            <div class="stat-value">{{ $totalUsers }}</div>
        </div>
        @endif
        <div class="stat bg-base-100">
            <div class="stat-title">Total Lapangan</div>
            <div class="stat-value">{{ $totalLapangan }}</div>
        </div>
        <div class="stat bg-base-100">
            <div class="stat-title">Total Jadwal</div>
            <div class="stat-value">{{ $totalJadwal }}</div>
        </div>
        <div class="stat bg-base-100">
            <div class="stat-title">Total Reservasi</div>
            <div class="stat-value">{{ $totalReservasi }}</div>
        </div>
    </div>
    <h2 class="text-xl">Reservasi Terbaru</h2>
    <div class="overflow-x-auto bg-base-100 border border-base-300 rounded">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Tanggal Reservasi</th>
                    <th>Status</th>
                    <th>Customer</th>
                    <th>Lapangan</th>
                    <th>Jadwal Hari</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td
                        class="{{ $reservation->status == 'pending' ? 'text-yellow-600' : ($reservation->status == 'canceled' ? 'text-red-500' : 'text-green-500') }}">
                        {{ $reservation->status }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->schedule->field->name }}</td>
                    <td>{{ $reservation->schedule->day }}</td>
                    <td>{{ $reservation->schedule->start_time }}</td>
                    <td>{{ $reservation->schedule->end_time }}</td>
                    <td>
                        @if (auth()->user()->hasRole('user'))
                        @if ($reservation->status == 'pending')
                        <form action="/reservations/{{ $reservation->id }}" method="POST" class="inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-error"
                                onclick="return confirm('Apa anda yakin?')">Batal</button>
                        </form>
                        @endif
                        @endif
                        <a href="/reservations/{{ $reservation->id }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-base-layout>