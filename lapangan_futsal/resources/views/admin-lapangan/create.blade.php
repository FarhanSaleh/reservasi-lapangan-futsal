<h1>Tambah Lapangan</h1>

<form method="POST" action="{{ route('admin.lapangan.store') }}">
    @csrf

    <label>Nama Lapangan</label><br>
    <input type="text" name="nama_lapangan"><br><br>

    <label>Harga per Jam</label><br>
    <input type="number" name="harga_per_jam"><br><br>

    <button type="submit">Simpan</button>
</form>
