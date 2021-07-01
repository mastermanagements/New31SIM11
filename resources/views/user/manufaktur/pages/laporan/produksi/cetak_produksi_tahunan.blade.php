<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produksi Tahunana</title>
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
            <td rowspan="2">No</td>
            <td rowspan="2">Bulan</td>
            <td rowspan="2">Tgl produksi</td>
            <td rowspan="2">Nama Barang</td>
            <td colspan="2">Barang Jadi</td>
            <td colspan="2">Barang Dalam Proses</td>
            <td rowspan="2">Supervisor</td>
        </tr>
        <tr>
            <th>Bagus</th>
            <th>Rusak</th>
            <th>Bagus</th>
            <th>Rusak</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @php($no=1)
            @foreach($bulan as $keys=> $item_bulan)
                @if(!empty($data[$keys]))
                    <tr>
                        <td rowspan="{{ count($data[$keys])+1 }}">{{ $no++ }} </td>
                        <td rowspan="{{ count($data[$keys])+1 }}">{{ $item_bulan }} </td>
                    </tr>
                    @foreach($data[$keys] as $item_data)
                        <tr>
                            <td>{{ $item_data['tgl_produksi'] }}</td>
                            <td>{{ $item_data['barang'] }}</td>
                            <td>{{ $item_data['bjb'] }}</td>
                            <td>{{ $item_data['bjr'] }}</td>
                            <td>{{ $item_data['bdp_b'] }}</td>
                            <td>{{ $item_data['bdp_r'] }}</td>
                            <td>{{ $item_data['supervisor'] }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        @endif
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>
</html>