<table border="1" cellspacing="1" cellpadding="5" style="width: 100%;">
    <thead>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Nama Menu</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Nama Pegawai</th>
        <th>Created At</th>
    </thead>

    <tbody>
        @foreach ($laporan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_pelanggan }}</td>
            <td>{{ $item->nama_menu }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->total_harga }}</td>
            <td>{{ $item->nama_pegawai }}</td>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>

</table>