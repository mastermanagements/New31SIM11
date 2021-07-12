<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengecekkan Barang</title>
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
<table  id="customers">
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Tgl Diterima</th>
        <th rowspan="2">Tgl Pengecekkan</th>
        <th rowspan="2">No Order</th>
        <th colspan="2">Jumlah Barang</th>
        <th colspan="2">Kondisi Barang</th>
        <th rowspan="2">Petugas</th>
        <th rowspan="2">Tgl complain</th>
        <th colspan="3">Respon Supplier</th>
    </tr>
    <tr>
        <th>Diterima</th>
        <th>Kurang</th>
        <th>Bagus</th>
        <th>Cacat</th>
        <th>Tgl Respon</th>
        <th>Diterima</th>
        <th>Ditolak</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $item)
            <tr>
                <td>{{ $item['no'] }}</td>
                <td>{{ $item['tgl_terima'] }}</td>
                <td>{{ $item['tgl_pengecekkan'] }}</td>
                <td>{{ $item['no_order'] }}</td>
                <td>{{ $item['jum_brg_terima'] }}</td>
                <td>{{ $item['jum_brg_kurang'] }}</td>
                <td>{{ $item['kon_brg_bagus'] }}</td>
                <td>{{ $item['kon_brg_kurang'] }}</td>
                <td>{{ $item['petugas'] }}</td>
                <td>{{ $item['tgl_complain'] }}</td>
                <td>{{ $item['suplier_tgl_respon'] }}</td>
                <td>{{ $item['suplier_diterima'] }}</td>
                <td>{{ $item['suplier_di_tolak'] }}</td>
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