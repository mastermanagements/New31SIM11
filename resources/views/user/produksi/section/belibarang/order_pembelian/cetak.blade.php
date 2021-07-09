<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pembelian</title>
</head>
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid black;
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
                    <td style="border-color: transparent; text-align: left;">{{ $data->no_order }}</td>
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Supplier</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ $data->linkToSuppliers->nama_suplier }}</td>
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Tanggal Tiba</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">@if($data->tgl_tiba !==NULL){{ tanggalView($data->tgl_tiba) }}@endif</td>
                </tr>
            </table>
        </div>
<table style="width: 100%" id="customers">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama barang</th>
        <th>Harga Beli</th>
        <th>Kwantitas</th>
		<th>Expire Date</th>
        <th>Diskon (%)</th>
        <th>Nilai Diskon</th>
        <th>Sub Total Diskon</th>
        <th>Sub Total Order</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data->linkToDetailOrder))
        @php($no=1)
        @foreach($data->linkToDetailOrder as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->linkToBarang->nm_barang }}</td>
                <td style="text-align: right;">{{ rupiahView($item->harga_beli) }}</td>
                <td style="text-align: center;">{{ $item->jumlah_beli }}</td>
				<td style="text-align: center;">@if($data->expire_date !==NULL) {{ tanggalView($data->expire_date) }}@endif</td>
                <td style="text-align: center;">{{ $item->diskon_item }}</td>
                <td style="text-align: right;">
                    @php($diskon = 0)
                    @if($item->diskon_item!=0)
                        @php($diskon = ($item->diskon_item/100))
                    @endif
                    {{ rupiahView(($item->harga_beli)*$diskon) }}
                </td>
                <td style="text-align: right;">
                    @php($sub_diskon = 0)
                    @if($item->diskon_item!=0)
                        @php($sub_diskon = ($item->diskon_item/100))
                    @endif
                    {{ rupiahView(($item->harga_beli*$item->jumlah_beli)*$sub_diskon) }}
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
                   
						@php($total_order_bruto=0)
						 @foreach($data->linkToDetailOrder as $data_order)
						
						@php($total_order_bruto+=$data_order->jumlah_harga)
					  
						@endforeach
					  
					<td style="border-color: transparent; text-align: left;"> : </td>
					<td style="border-color: transparent; text-align: left;">{{ rupiahView($total_order_bruto) }} </td>					   			                  
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" width="100"><strong>PPN</strong></td>
                    <td style="border-color: transparent; text-align: left;" width="20">:</td>
                    <td style="border-color: transparent; text-align: left;">
					@php($ppn = 0) 
					
					@if($data->pajak !=0)
                        @php($ppn = ($total_order_bruto * $data->pajak/100))
                    @endif
					
					{{rupiahView($ppn)}}</td>
                </tr>
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Potongan Pembelian</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ rupiahView($data->diskon_tambahan) }}</td>
                </tr>
				<tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Total Akhir</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{rupiahView($total_order_bruto + $ppn - $data->diskon_tambahan )}}</td>
                </tr>
				<tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Pembayaran</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">@if($data->metode_bayar =='0') Tunai @else Kredit @endif</td>
                </tr>
				@if($data->metode_bayar == '1')
                <tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Jatuh Tempo</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">@if($data->tgl_jatuh_tempo !==NULL) {{ tanggalView($data->tgl_jatuh_tempo) }}@endif
					</td>
                </tr>				
				<tr>
                    <td style="border-color: transparent; text-align: left;" ><strong>Kurang</strong></td>
                    <td style="border-color: transparent; text-align: left;">:</td>
                    <td style="border-color: transparent; text-align: left;">{{ rupiahView($data->kurang_bayar) }}</td>
                </tr>
				@endif
				
            </table>
        </div>
		<div style="padding-top: 3%">
           <table style="width: 100%">
               <tr>
                   <td style="border-color: transparent; text-align: left; width: 50%;"></td>
                   <td style="border-color: transparent; text-align: left; width: 50%;">
                       <p align="right">
                           {{ $data->linkToUsaha->getKabupaten->nama_kabupaten }}, {{ date('d-m-Y', strtotime($data->tgl_order)) }}
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