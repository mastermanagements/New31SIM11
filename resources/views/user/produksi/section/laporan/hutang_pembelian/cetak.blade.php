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
        <th>No transaksi</th>
        <th>Supplier</th>
        <th>Tgl Order</th>
        <th>Tgl Jatuh tempo</th>
        <th>Status Pembayaran</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $data)
            <tr>
                <td>
                    {{ $data['no'] }}
                </td>
                <td>
                    {{ $data['no_transaksi'] }}
                </td>
                <td>
                    {{ $data['supplier'] }}
                </td>
                <td>
                    {{ $data['jumlah_hutang'] }}
                </td>
                <td>
                    {{ $data['tgl_jatuh_tempo'] }}
                </td>
                <td>
                    {{ $data['status_pembayaran'] }}
                </td>
            </tr>
    @endforeach
    @endif
</table>
</body>
<script>
    window.print();
</script>
</html>