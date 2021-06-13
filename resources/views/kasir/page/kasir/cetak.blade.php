<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Nota</title>
</head>
<body>
    <table style="text-align: left">
        <thead>
            <tr>
                    <th>Kode:</th>
                    <th>{{ $nota->no_sales }}</th>
            </tr>
            <tr>
                    <th>Tgl:</th>
                    <th>{{ date('d-m-Y', strtotime($nota->tgl_sales)) }}</th>
            </tr>
        </thead>
    </table>
    <p></p>
    <table style="text-align: left; width: 450px">
        <thead>
            <tr>
                <th>No.</th>
                <th>Detail</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
        @php($total_harga =0)
        @php($total_item =0)
            @if(!empty($nota->linkToDetailSales))
                @php($no=1)
                @foreach($nota->linkToDetailSales as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->linkToBarang->nm_barang }} <br> {{ number_format($item->jumlah_jual,0,',','.') }} x {{ number_format($item->hpp,0,',','.') }}</td>
                        <td>{{ number_format($item->jumlah_harga,0,',','.') }}  @php($total_harga+=$item->jumlah_harga) @php($total_item++)</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
                <tr>
                    <th></th>
                    <th>Total Item {{ $total_item }}</th>
                    <th>Total Harga : {{ number_format($total_harga,0,',','.') }}</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Bayar : {{ number_format($nota->bayar,0,',','.') }}</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Kembalian : {{ number_format($total_harga-$nota->bayar,0,',','.') }}</th>
                </tr>
        </tfoot>
    </table>
</body>
<script>
    window.print();
</script>
</html>