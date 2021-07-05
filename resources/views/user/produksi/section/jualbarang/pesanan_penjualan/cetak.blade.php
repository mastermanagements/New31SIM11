<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewsort"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pesanan Penjualan</title>
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
        color: black;
    }
</style>
<body style="margin: 30px">
{!! $header !!}
		<div style="padding-top: 3%">
            <table>
                <tr>
                    <td style="border-color: transparent; text-align: left;" width="100"><strong>No Transaksi</strong></td>
                    <td style="border-color: transparent; text-align: left;" width="20">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ $data->no_so }}</td>
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Klien</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ $data->linkToKlien->nm_klien }}</td>
                </tr>
				<tr>
                    <td style="border-color: transparent; text-align: left;" width="100"><strong>No Pesanan Pembelian</strong></td>
                    <td style="border-color: transparent; text-align: left;" width="20">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ $data->no_po }}</td>
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Tanggal Pesanan</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">@if($data->tgl_so !==NULL){{ tanggalView($data->tgl_so) }}@endif</td>
                </tr>
            </table>
        </div>
<table style="width: 100%" id="customers">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama barang</th>
		<th>Satuan</th> 
		<th>Jumlah</th>
        <th>Harga Satuan</th>       
        <th>Diskon (%)</th>
        <th>Nilai Diskon</th>
        <th>Sub Total Diskon</th>
        <th>Sub Total</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data->linkToDetailPSO))
        @php($no=1)
        @foreach($data->linkToDetailPSO as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->linkToBarang->nm_barang }}</td>
				<td>@if(!empty($item->linkToBarang->linkToSatuan->satuan)){{ $item->linkToBarang->linkToSatuan->satuan }} @endif</td>
				<td style="text-align: center;">{{ $item->jumlah_jual }}</td>
                <td style="text-align: right;">{{ rupiahView($item->hpp) }}</td>
                <td style="text-align: center;">{{ $item->diskon_item }}</td>
                <td style="text-align: right;">
                    @php($diskon = 0)
                    @if($item->diskon_item!=0)
                        @php($diskon = ($item->diskon_item/100))
                    @endif
                    {{ rupiahView(($item->hpp)*$diskon) }}
                </td>
                <td style="text-align: right;">
                    @php($sub_diskon = 0)
                    @if($item->diskon_item!=0)
                        @php($sub_diskon = ($item->diskon_item/100))
                    @endif
                    {{ rupiahView(($item->hpp*$item->jumlah_jual)*$sub_diskon) }}
                </td>
                <td style="text-align: right;">
                    {{ rupiahView($item->jumlah_harga) }}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
		<div style="padding-top: 1%">
            <table align="right">
				<tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Total</strong></td>
                   
						@php($total_so_bruto=0)
						 @foreach($data->linkToDetailPSO as $data_pesanan)
						
						@php($total_so_bruto+=$data_pesanan->jumlah_harga)
					  
						@endforeach
					  
					<td style="border-color: transparent; text-align: left;"> : </td>
					<td style="border-color: transparent; text-align: left;">{{ rupiahView($total_so_bruto) }} </td>					   			                  
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" width="100"><strong>PPN</strong></td>
                    <td style="border-color: transparent; text-align: left;" width="20">:</td>
                    <td style="border-color: transparent; text-align: left;">
					@php($ppn = 0) 
					
					@if($data->pajak !=0)
                        @php($ppn = ($total_so_bruto * $data->pajak/100))
                    @endif
					
					{{rupiahView($ppn)}}</td>
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Potongan Penjualan</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ rupiahView($data->diskon_tambahan) }}</td>
                </tr>
				<tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Total Akhir</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{rupiahView($total_so_bruto + $ppn - $data->diskon_tambahan )}}</td>
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Uang Muka</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{rupiahView($data->dp_so)}}</td>
                </tr>
				<tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Kurang</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ rupiahView($data->kurang_bayar) }}</td>
                </tr>
				
            </table>
        </div>
		<div style="padding-top: 3%">
           <table style="width: 100%">
               <tr>
                   <td style="border-color: transparent; text-align: left; width: 50%;"></td>
                   <td style="border-color: transparent; text-align: left; width: 50%;">
                       <p align="right">
                           {{ $data->linkToUsaha->getKabupaten->nama_kabupaten }}, {{ date('d-m-Y', strtotime($data->tgl_so)) }}
                       </p>
                   </td>
               </tr>
               <tr style="text-align:right">
				   <td style="border-color: transparent; text-align: left; width: 50%;">
				   </td>
                   <td style="border-color: transparent; text-align: right; width: 50%;">                  
                           <p>
                           <p align="center"><strong>Hormat Kami</strong></p>
                           <br>
                           <br>
                           <br>
                           <p align="center"><u><strong>{{ $data->linkToKaryawan->nama_ky }}</strong></u><br>
                           </p>
                           </p>
                     
                   </td>                  
               </tr>
           </table>
       </div>
</body>
</html>

<script type="text/javascript">
    window.onload = function () {
        window.print();
    }
</script>