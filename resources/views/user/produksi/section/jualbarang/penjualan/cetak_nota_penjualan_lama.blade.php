<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body style="margin:20px">
{!! $header !!}

<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>@if(!empty($data->linkToKlien->nm_klien)){{ $data->linkToKlien->nm_klien }} @endif</td>
    </tr>
    <tr>
        <td>Telp</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>{{ date('d-m-Y', strtotime($data->tgl_sales)) }}</td>
    </tr>
</table>
<p></p>
<table class="table table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @php($no=1)
        @php($total=0)
        @foreach($data->linkToDetailSales as $item)
<<<<<<< HEAD
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->linkToBarang->nm_barang }}</td>
            <td>@if(!empty($item->linkToBarang->linkToSatuan->satuan)){{ $item->linkToBarang->linkToSatuan->satuan }} @endif</td>
            <td>{{ $item->hpp }}</td>
            <td>{{ $item->jumlah_jual }}</td>
            <td>{{ $item->jumlah_harga }} @php($total+=$item->jumlah_harga) </td>
        </tr>
=======
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->linkToBarang->nm_barang }}</td>
                <td>@if(!empty($item->linkToBarang->linkToSatuan->satuan)){{ $item->linkToBarang->linkToSatuan->satuan }} @endif</td>
                <td>{{ number_format($item->hpp,2,',','.') }}</td>
                <td>{{ $item->jumlah_jual }}</td>
                <td>{{ number_format($item->jumlah_harga,2,',','.') }} @php($total+=$item->jumlah_harga) </td>
            </tr>
>>>>>>> 93bfa9523bc73a8b8ddbeaeb7f78e481d9bdb5f9
        @endforeach
    @endif
    <tr>
        <td colspan="5">Total</td>
        <td>{{ number_format($total,2,',','.') }}</td>
    </tr>
    <tr>
        <th colspan="5">PPN</th>
        <td>{{ $data->pajak }}</td>
    </tr>
    <tr>
        <th colspan="5">Diskon Tambahan</th>
        <td>{{ number_format($data->diskon_tambahan,2,',','.') }}</td>
    </tr>
    <tr>
        <th colspan="5">Ongkir</th>
        <td>{{ number_format($data->ongkir,2,',','.') }}</td>
    </tr>
    <tr>
        <th colspan="5">Total Akhir</th>
        <td>{{ number_format($data->total,2,',','.') }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
<script type="text/javascript">
    window.onload = function () {
        window.print();
    }
</script>