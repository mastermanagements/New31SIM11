<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Cetak Laporan Laba Rugi</title>
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
</head>
<body style="margin: 10px;padding: 20px">
{!! $header !!}
<p></p>
    <table id="customers">
             <tbody>
            @php($total_laba=0)
            @foreach($akun as $key=> $data_laba_rugi)
                @php($total_sub=0)
                @if(!empty($data[$key]))
                    <tr align="left" style="background-color: lightgrey">
                        <td colspan= "2">{{ $data_laba_rugi[0] }}</td>
                    </tr>
                    @foreach($data[$key] as $data_group)
                        <tr>
                            <td>{{ $data_group['nama_akun'] }}</td>
                            <td>
                                @if($data_group['posisi_saldo']=="K")
                                    @php($total_sub+=$data_group['saldo_kredit'])
                                    @php($total_laba += $data_group['saldo_kredit'])
                                    {{ number_format($data_group['saldo_kredit'],2,',','.') }}
                                @else
                                    @php($total_laba -= $data_group['saldo_debet'])
                                    @php($total_sub+=$data_group['saldo_debet'])
                                    {{ number_format($data_group['saldo_debet'],2,',','.') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Total</td>
                        <td>{{ number_format($total_sub,2,',','.') }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td><b>Laba Rugi</b></td>
                <td align="left">{{ number_format($total_laba ,2,',','.')}}</td>
            </tr>
            </tfoot>

    </table>
</body>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</html>