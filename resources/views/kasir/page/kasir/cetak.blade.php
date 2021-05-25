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
                    <th>{{ $nota->kode }}</th>
            </tr>
            <tr>
                    <th>Tgl:</th>
                    <th>{{ date('d-m-Y', strtotime($nota->created_at)) }}</th>
            </tr>
        </thead>
    </table>
    <p></p>
    <table style="text-align: left">
        <thead>
            <tr>
                <th>No.</th>
                <th>Detail</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($data->linkToMannyDetailNota))
                @php($no=1)
                @foreach($data->linkToMannyDetailNota as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->linkToBarang->nm_barang }}</td>
                        <td>{{ $item-> }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>