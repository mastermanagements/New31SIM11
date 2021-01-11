<!DOCTYPE html>
<html>
<head>
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
    <title>Cetak Stok Opname</title>
</head>
<body>

<table id="customers" >
    <thead>
    <tr>
        <td>No.</td>
        <td>Nama Barang</td>
        <td>Satuan Barang</td>
        <td>Stok Awal</td>
        <td>Masuk</td>
        <td>Keluar</td>
        <td>Sisa Barang</td>

    </tr>
    </thead>
    <tbody>
    @php($no=1)
    @if(!empty($data_barang))
        @foreach($data_barang as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nm_barang }}</td>
                <td>{{ $data->linkToSatuan->satuan_brg }}</td>
                <td>{{ $data->linkToStokAwal->sum('jumlah_brg')}}</td>
                <td>{{ $data->linkToItemIO->where('jenis_item','0')->sum('jumlah_brg')}}</td>
                <td>{{ $data->linkToItemIO->where('jenis_item','1')->sum('jumlah_brg')}}</td>
                <td>{{ $data->linkToStokAwal->sum('jumlah_brg') + $data->linkToItemIO->where('jenis_item','0')->sum('jumlah_brg') - $data->linkToItemIO->where('jenis_item','1')->sum('jumlah_brg')}}</td>

            </tr>
        @endforeach
    @endif
    </tbody>
</table>

</body>
</html>
