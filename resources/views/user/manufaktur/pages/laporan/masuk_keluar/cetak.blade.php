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
            <th>No.</th>
            <th>Tanggal Transaksi</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Merek</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>keterangan</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @php($no=1)
            @foreach($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['tgl'] }}</td>
                    <td>{{ $item['barang'] }}</td>
                    <td>{{ $item['spek'] }}</td>
                    <td>{{ $item['merk'] }}</td>
                    <td>{{ $item['satuan'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>{{ $item['ket'] }}</td>
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