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
        <th>Supplier</th>
        <th>Tgl Terima</th>
        <th>Tgl Return</th>
        <th>Jenis Return</th>
        <th>Ongkir Return</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $item)
            <tr>
                <td>{{ $item['no'] }}</td>
                <td>{{ $item['supplier'] }}</td>
                <td>{{ date('d-m-Y',strtotime($item['tgl_terima'])) }}</td>
                <td>{{ date('d-m-Y',strtotime($item['tgl_return'])) }}</td>
                <td>{{ $item['jenis_return'] }}</td>
                <td>{{ $item['ongkir_return'] }}</td>
            </tr>
    @endforeach
    @endif
</table>
</body>
<script>
    window.print();
</script>
</html>