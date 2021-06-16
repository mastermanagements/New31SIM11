<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pesanan Pembelian</title>
</head>
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
<body style="margin: 30px">
{!! $header !!}
<table style="width: 100%" id="customers">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama barang</th>
        <th>Harga Beli</th>
        <th>Kwantitas</th>
        <th>Diskon</th>
        <th>Nilai Diskon</th>
        <th>Sub Total Diskon</th>
        <th>Sub Total PO</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data->linkToDetailPO))
        @php($no=1)
        @foreach($data->linkToDetailPO as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->linkToBarang->nm_barang }}</td>
                <td>{{ $item->harga_beli }}</td>
                <td>{{ $item->jumlah_beli }}</td>
                <td>{{ $item->diskon_item }}</td>
                <td>
                    @php($diskon = 0)
                    @if($item->diskon_item!=0)
                        @php($diskon = ($item->diskon_item/100))
                    @endif
                    {{ ($item->harga_beli)*$diskon }}
                </td>
                <td>
                    @php($sub_diskon = 0)
                    @if($item->diskon_item!=0)
                        @php($sub_diskon = ($item->diskon_item/100))
                    @endif
                    {{ ($item->harga_beli*$item->jumlah_beli)*$sub_diskon }}
                </td>
                <td>
                    {{ $item->jumlah_harga }}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</body>
</html>