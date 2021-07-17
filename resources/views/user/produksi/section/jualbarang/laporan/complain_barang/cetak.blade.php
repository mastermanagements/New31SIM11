<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Complain Barang</title>
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
        <th rowspan="2">No</th>
        <th rowspan="2">No Transaksi</th>
        <th rowspan="2">Tgl Penjualan</th>
        <th rowspan="2">Customer</th>
        <th colspan="2">Jumlah Barang</th>
        <th rowspan="2">Nilai Uang</th>
        <th rowspan="2">Tgl Complain</th>
        <th rowspan="2">Status Complain</th>
        <th rowspan="2">Alasan Status</th>
        <th rowspan="2">Keterangan</th>
    </tr>
    <tr>
        <th>Barang Kurang</th>
        <th>Barang Rusak</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $data_item)
            <tr>
                <td>{{ $data_item['no'] }}</td>
                <td>{{ $data_item['no_transaksi'] }}</td>
                <td>{{ $data_item['tgl_penjualan'] }}</td>
                <td>{{ $data_item['klien'] }}</td>
                <td>{{ $data_item['bbk'] }}</td>
                <td>{{ $data_item['bbr'] }}</td>
                <td>{{ $data_item['nilai_uang'] }}</td>
                <td>{{ $data_item['tgl_complain'] }}</td>
                <td>{{ $data_item['status_complain'] }}</td>
                <td>{{ $data_item['asalan_status'] }}</td>
                <td>{{ $data_item['keterangan'] }}</td>
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