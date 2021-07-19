<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produksi</title>
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
        <th rowspan="2" style="text-align: center">No</th>
        <th colspan="2" style="text-align: center">Tanggal</th>
        <th rowspan="2" style="text-align: center">Lama Produksi</th>
        <th rowspan="2" style="text-align: center">Nama Barang</th>
        <th colspan="2" style="text-align: center">Barang Jadi</th>
        <th colspan="2" style="text-align: center">Barang Dalam Proses</th>
        <th colspan="3" style="text-align: center">Biaya Produksi</th>
        <th rowspan="2" style="text-align: center">Hpp Per Barang</th>
        <th rowspan="2" style="text-align: center">Hpp Total</th>
        <th rowspan="2" style="text-align: center">Supervisor</th>
    </tr>
    <tr>
        <th style="text-align: center">Mulai</th>
        <th style="text-align: center">Selesai</th>
        <th style="text-align: center">Bagus</th>
        <th style="text-align: center">Rusak</th>
        <th style="text-align: center">Bagus</th>
        <th style="text-align: center">Rusak</th>
        <th style="text-align: center">Bahan Mentah</th>
        <th style="text-align: center">Tenaga Kerja</th>
        <th style="text-align: center">Overhead</th>
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