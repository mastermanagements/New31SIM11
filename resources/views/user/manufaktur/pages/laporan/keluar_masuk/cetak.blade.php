<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Barang dan Harga Jual</title>
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
@if($default_transaksi == 0)
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Transaksi</th>
            <th>Faktur pembelian</th>
            <th>Supplier</th>
            <th>Pengirim</th>
            <th>Penerima</th>
            <th>Jumlah Barang</th>
        </tr>
        @if(!empty($data))
            @foreach($data as $data_item)
                <tr>
                    <td>{{ $data_item['no'] }}</td>
                    <td>{{ $data_item['tgl_transaksi'] }}</td>
                    <td>{{ $data_item['faktur_pembelian'] }}</td>
                    <td>{{ $data_item['supplier'] }}</td>
                    <td>{{ $data_item['pengirim'] }}</td>
                    <td>{{ $data_item['penerima'] }}</td>
                    <td>{{ $data_item['jumlah'] }}</td>
                </tr>
            @endforeach
        @endif
    </table>
@elseif($default_transaksi == 1)
    <table class="table table-striped" id="customers">
        <tr>
            <th>No</th>
            <th>Transaksi</th>
            <th>Gudang Asal</th>
            <th>Gudang Tujuan</th>
            <th>Pengirim</th>
            <th>Penerima</th>
            <th>Jumlah Barang</th>
        </tr>
        @if(!empty($data))
            @foreach($data as $data_item)
                <tr>
                    <td>{{ $data_item['no'] }}</td>
                    <td>{{ $data_item['tgl_transaksi'] }}</td>
                    <td>{{ $data_item['gudang_asal'] }}</td>
                    <td>{{ $data_item['gudang_tujuan'] }}</td>
                    <td>{{ $data_item['pengirim'] }}</td>
                    <td>{{ $data_item['penerima'] }}</td>
                    <td>{{ $data_item['jumlah'] }}</td>
                </tr>
            @endforeach
        @endif
    </table>
@endif
</body>
<script>
    window.print();
</script>
</html>