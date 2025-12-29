<h1>Data Lapangan</h1>

<a href="{{ route('admin.lapangan.create') }}">Tambah Lapangan</a>

<ul>
@foreach($lapangan as $l)
    <li>
        {{ $l->nama_lapangan }} - Rp{{ $l->harga_per_jam }} / jam ({{ $l->status }})
    </li>
@endforeach
</ul>
