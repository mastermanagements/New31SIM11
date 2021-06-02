<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Daftar Nota</title>
</head>
<body style="padding: 2%">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kode Transaksi</th>
            <th>Item Penjualan</th>
            <th>Jumlah Penjualan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($nota))
            @php($no=1)
            @foreach($nota as $item_data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($item_data->created_at)) }}</td>
                    <td>{{ $item_data->kode }}</td>
                    <td>{{ $item_data->linkToMannyDetailNota->count('id') }}</td>
                    <td>{{ number_format($item_data->linkToMannyDetailNota->sum('sub_total'),2,',','.') }}</td>
                    <td>
                        <button class="btn btn-primary" onclick="cek_barang({{ $item_data->id }})">
                            Detail
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</body>
</html>