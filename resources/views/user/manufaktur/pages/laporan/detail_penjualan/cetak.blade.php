<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Detail Pembelian</title>
    <link rel="stylesheet" href="{{ @asset('component/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

</head>
<body style="margin: 20px;">
{!! $header !!}
@if(!empty($data))
    @php($sum_harga_jual = 0)
    @php($sum_sub_total = 0)
    @foreach($data as $item)
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p style="font-weight: bold">No. Transaksi : {{ $item[4] }}</p>
                            <p style="font-weight: bold">Klien : {{ $item[5] }}</p>
                            <p style="font-weight: bold">Jenis Pembelian : {{ $item[11] }}</p>
                        </div>
                        <div class="col-md-4">
                            <p style="font-weight: bold">Diskon : {{ $item[8] }}</p>
                            <p style="font-weight: bold">Ongkir : {{ $item[9] }}</p>
                            <p style="font-weight: bold">Pajak : {{ $item[16] }}%</p>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Spec</th>
                                        <th>Merk</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah Jual</th>
                                        <th>Diskon Per Item</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($item[15]))
                                        @foreach($item[15] as $item_data)
                                            <tr>
                                                <td>{{ $item_data[0] }}</td>
                                                <td>{{ $item_data[1] }}</td>
                                                <td>{{ $item_data[2] }}</td>
                                                <td>{{ $item_data[3] }}</td>
                                                <td>{{ $item_data[4] }}</td>
                                                <td>{{ $item_data[5] }}</td>
                                                <td>{{ $item_data[6] }} @php($sum_harga_jual +=$item_data[6])</td>
                                                <td>{{ $item_data[7] }}</td>
                                                <td>{{ $item_data[8] }}</td>
                                                <td>{{ $item_data[9] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6">Total</td>
                                        <td>{{ $sum_harga_jual }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $sum_sub_total }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">Total  Akhir</td>
                                        <td>{{ $item[17] }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
</body>
<script>
    window.print();
</script>
</html>