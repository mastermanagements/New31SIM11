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
	<h3 align="center"><b>LEMBAR STOK OPNAME</b></h3>
	@foreach($usaha as $ukm)
	<h3 align="center"><b>{{ $ukm->nm_usaha}}</b></h3>
	<h4 align="center">{{ $ukm->alamat}}, {{ $ukm->hp}}</h4>
	<h4 align="left">Tanggal Stok Opname : {{ now() }}</h4>
	@endforeach
<table id="customers" >
    <thead>
    <tr>
        <th>No.</th>
        <th>Nama Barang</th>
        <th>Satuan Barang</th>
        {{-- <td>Stok Awal</th> --}}
       {{-- <td>Masuk</td> --}}
       {{-- <td>Keluar</td> --}}
        <th>Stok Akhir</th>
		<th>Bukti Fisik</th>

    </tr>
    </thead>
    <tbody>
    @php($no=1)
    @if(!empty($data_barang))
        @foreach($data_barang as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nm_barang }}</td>
                <td>@if(!empty($data->linkToSatuan->satuan)){{ $data->linkToSatuan->satuan }} @endif</td>
                {{-- <td>{{ $data->linkToStokAwal->sum('jumlah_brg')}}</td> --}}
                {{-- <td>{{ $data->linkToItemIO->where('jenis_item','0')->sum('jumlah_brg')}}</td> --}}
                {{-- <td>{{ $data->linkToItemIO->where('jenis_item','1')->sum('jumlah_brg')}}</td> --}}
              {{-- <td>{{ $data->linkToStokAwal->sum('jumlah_brg') + $data->linkToItemIO->where('jenis_item','0')->sum('jumlah_brg') - $data->linkToItemIO->where('jenis_item','1')->sum('jumlah_brg')}}</td> --}}
				<td>{{ $data->stok_akhir }}</td>
				<td></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<script type="text/javascript">
    window.onload = function () {
        window.print();
    }
</script>
</body>
</html>
