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
        <th>NO PO</th>
        <th>Uang Muka</th>
        <th>No. Transaksi</th>
        <th>Supplier</th>
        <th>Jumlah Barang</th>
        <th>Total Pembelian</th>
        <th>Diskon</th>
        <th>Ongkos Kirim</th>
        <th>Tanggal Tiba</th>
        <th>Jenis Pembelian</th>
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