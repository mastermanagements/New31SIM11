<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
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
        <th>Tanggal Transaksi</th>
        <th>No. Transaksi</th>
        <th>Supplier</th>
        <th>Total belanja</th>
        <th>Diskon</th>
        <th>PPN</th>
        <th>Uang muka</th>
        <th>Kurang Bayar</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $item)
            <tr>
                <td>{{ $item['no'] }}</td>
                <td>{{ $item['tgl_transaksi'] }}</td>
                <td>{{ $item['no_transaksi'] }}</td>
                <td>{{ $item['supplier'] }}</td>
                <td>{{ $item['total_belajan'] }}</td>
                <td>{{ $item['diskon_tambahan'] }}</td>
                <td>{{ $item['ppn'] }}</td>
                <td>{{ $item['uang_muka'] }}</td>
                <td>{{ $item['kurang_bayar'] }}</td>
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