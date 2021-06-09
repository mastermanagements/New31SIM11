<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Return penjualan</title>

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
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>No Faktur</td>
            <td>:</td>
            <td>{{ $data->no_sales }}</td>
        </tr>
        <tr>
            <td>Klien</td>
            <td>:</td>
            <td>@if(!empty($data->linkToKlien)){{ $data->linkToKlien->nm_klien }} @else Klien Umum @endif</td>
        </tr>
        <tr>
            <td>Tgl Transaksi</td>
            <td>:</td>
            <td>{{ date('d-m-Y', strtotime($data->tgl_sales)) }}</td>
        </tr>
        <tr>
            <td>Bentuk Return</td>
            <td>:</td>
            <td>@if(!empty($data->linkToReturnBarangJual)){{ $jenis_return[$data->linkToReturnBarangJual->jenis_return] }} @endif</td>
        </tr>
        <tr>
            <td>Ongkos Kirim</td>
            <td>:</td>
            <td>@if(!empty($data->linkToReturnBarangJual)){{ $data->linkToReturnBarangJual->ongkir_return }} @endif</td>
        </tr>
    </table>
    @if(!empty($data->linkToMannyComplainJual))
        @php($no=1)
        <table id="customers" style="width: 100%;">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Diskon</th>
                <th>Jumlah Harga</th>
                <th>Alasan Return</th>
            </tr>
            </thead>
            <tbody>
            @php($jumlah_item=0)
            @php($jumlah_uang=0)
            @foreach($data->linkToMannyComplainJual->where('status_complain','1') as $data)
                <tr>
                    <td>@php($jumlah_item++)@php($jumlah_uang+=$data->total_return){{ $no++ }}</td>
                    <td>{{ $data->linkToBarang->nm_barang }}</td>
                    <td>{{ $data->jumlah_beli }}</td>
                    <td>{{ $data->hpp }}</td>
                    <td>{{ $data->diskon_item }}</td>
                    <td>{{ $data->total_return }}</td>
                    <td>{{ $data->alasan_ditolak }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th >{{ $jumlah_item }}</th>
                <th ></th>
                <th ></th>
                <th >{{ number_format($jumlah_uang,2,',','.') }}</th>
                <th ></th>
            </tr>
            </tfoot>
        </table>
    @endif
</body>
<script>
    window.print();
</script>
</html>
