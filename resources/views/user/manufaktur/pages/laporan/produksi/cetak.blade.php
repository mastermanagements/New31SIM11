<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produksi</title>
    <link rel="stylesheet" href="{{ @asset('component/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

</head>
<body style="margin: 20px;">
    <table class="table table-responsive table-striped">
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th colspan="2">Tanggal</th>
        <th rowspan="2">Lama Produksi</th>
        <th rowspan="2">Nama Barang</th>
        <th colspan="2">Barang Jadi</th>
        <th colspan="2">Barang Dalam Proses</th>
        <th colspan="3">Biaya Produksi</th>
        <th rowspan="2">Hpp Per Barang</th>
        <th rowspan="2">Hpp Total</th>
        <th rowspan="2">Supervisor</th>
    </tr>
    <tr>
        <th>Mulai</th>
        <th>Selesai</th>
        <th>Bagus</th>
        <th>Rusak</th>
        <th>Bagus</th>
        <th>Rusak</th>
        <th>Bahan Mentah</th>
        <th>Tenaga Kerja</th>
        <th>Overhead</th>
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
                <td>{{ $item[9][0] }}</td>
                <td>{{ $item[10][0] }}</td>
                <td>{{ $item[11][0] }}</td>
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