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
        <td>{{ $data->linkToKlien->nm_klien }}</td>
    </tr>
    <tr>
        <td>Telp</td>
        <td>:</td>
        <td>{{ $data->linkToKlien->hp }}</td>
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
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->linkToBarang->nm_barang }}</td>
            <td>{{ $item->linkToBarang->linkToSatuan->satuan }}</td>
            <td>{{ $item->hpp }}</td>
            <td>{{ $item->jumlah_jual }}</td>
            <td>{{ $item->jumlah_harga }} @php($total+=$item->jumlah_harga) </td>
        </tr>
        @endforeach
    @endif
        <tr>
           <td colspan="5">Total</td>
           <td>{{ $total }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>