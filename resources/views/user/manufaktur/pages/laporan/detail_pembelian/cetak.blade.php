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
@if(!empty($data))
    @foreach($data as $item)
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p style="font-weight: bold">No. Transaksi : {{ $item[0] }}</p>
                            <p style="font-weight: bold">Supplier : {{ $item[1] }}</p>
                            <p style="font-weight: bold">Jenis Pembelian : {{ $item[2] }}</p>
                        </div>
                        <div class="col-md-4">
                            <p style="font-weight: bold">Diskon : {{ $item[3] }}</p>
                            <p style="font-weight: bold">Ongkir : {{ $item[4] }}</p>
                            <p style="font-weight: bold">Pajak : {{ $item[5] }}%</p>
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
                                        <th>Harga Beli</th>
                                        <th>Jumlah Beli</th>
                                        <th>Diskon Per Item</th>
                                        <th>Sub Total</th>
                                        <th>Expired Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($item[6]))
                                        @foreach($item[6] as $item_data)
                                            <tr>
                                                <td>{{ $item_data[0] }}</td>
                                                <td>{{ $item_data[1] }}</td>
                                                <td>{{ $item_data[2] }}</td>
                                                <td>{{ $item_data[3] }}</td>
                                                <td>{{ $item_data[4] }}</td>
                                                <td>{{ $item_data[5] }}</td>
                                                <td>{{ $item_data[6] }}</td>
                                                <td>{{ $item_data[7] }}</td>
                                                <td>{{ $item_data[8] }}</td>
                                                <td>{{ $item_data[9] }}</td>
                                                <td>{{ $item_data[10] }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
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