<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="{{ @asset('component/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

</head>
<body style="margin: 20px;">
<table class="table table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>No Pesanan Penjualan</th>
        <th>Uang Muka</th>
        <th>No. Transaksi</th>
        <th>Klien</th>
        <th>Jumlah Barang</th>
        <th>Total Penjualan</th>
        <th>Diskon</th>
        <th>Ongkos Kirim</th>
        <th>Tanggal Kirim</th>
        <th>Jenis penjualan</th>
        <th>Jumlah Bayar</th>
        <th>Kurang Bayar</th>
        <th>Jatuh Tempo</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $item)
            <tr>
                <td>{{ $item[0] }}</td>
                <td>{{ $item[1] }}</td>
                <td>{{ $item[2] }}</td>
                <td>{{ $item[3] }}</td>
                <td>{{ $item[4] }}</td>
                <td>{{ $item[5] }}</td>
                <td>{{ $item[6] }}</td>
                <td>{{ $item[7] }}</td>
                <td>{{ $item[8] }}</td>
                <td>{{ $item[9] }}</td>
                <td>{{ $item[10]}}</td>
                <td>{{ $item[11] }}</td>
                <td>{{ $item[12] }}</td>
                <td>{{ $item[13] }}</td>
                <td>{{ $item[14] }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</body>
<script>
    window.print();
</script>
</html>