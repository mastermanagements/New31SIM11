<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembelian</title>
    <link rel="stylesheet" href="{{ @asset('component/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body style="margin: 20px;">
{!! $header !!}
<table id="customers">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama barang</th>
        <th>Spesifikasi</th>
        <th>Merek</th>
        <th>Satuan</th>
        <th>Stok Sistem</th>
        <th>Stok Fisik</th>
        <th>Selisih</th>
        <th>Petugas</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $item)
            <tr>
                <td>{{ $item['no'] }}</td>
                <td>{{ $item['tgl'] }}</td>
                <td>{{ $item['nm_barang'] }}</td>
                <td>{{ $item['spek'] }}</td>
                <td>{{ $item['merk'] }}</td>
                <td>{{ $item['satuan'] }}</td>
                <td>{{ $item['stok_sistem'] }}</td>
                <td>{{ $item['stok_fisik'] }}</td>
                <td>{{ $item['selisih'] }}</td>
                <td>{{ $item['petugas'] }}</td>
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