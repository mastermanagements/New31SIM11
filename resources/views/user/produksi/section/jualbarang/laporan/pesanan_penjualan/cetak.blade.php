<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Hutang Pembelian</title>
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
        <th>Tgl transaksi</th>
        <th>No Transaksi</th>
        <th>Customer</th>
        <th>Total</th>
        <th>Diskon</th>
        <th>PPN</th>
        <th>Uang Muka</th>
        <th>Kurang Bayar</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $data_item)
            <tr>
                <td>{{ $data_item['no'] }}</td>
                <td>{{ $data_item['tgl_transaksi'] }}</td>
                <td>{{ $data_item['no_transaksi'] }}</td>
                <td>{{ $data_item['customer'] }}</td>
                <td>{{ $data_item['total'] }}</td>
                <td>{{ $data_item['diskon'] }}</td>
                <td>{{ $data_item['ppn'] }}</td>
                <td>{{ $data_item['uang_muka'] }}</td>
                <td>{{ $data_item['kurang_bayar'] }}</td>
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