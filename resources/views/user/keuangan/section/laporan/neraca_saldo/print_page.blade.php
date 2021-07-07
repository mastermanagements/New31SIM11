<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Neraca Saldo</title>
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
    {!!  $header !!}
    <p></p>
    <table id="customers">
        <thead>
        <tr>
            <th>Kode Akun</th>
            <th>Keterangan</th>
            <th>Debet</th>
            <th>Kredit</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @php($total_debet=0)
            @php($total_kredit=0)
            @foreach($data as $data)
                <tr>
                    <td>{{ $data['kode_akun'] }}</td>
                    <td>
                        @if(abs($data['saldo_debet']) == 0)
                            {{ $data['nama_akun'] }}
                        @else
                            {{ $data['nama_akun'] }}
                        @endif
                    </td>
                    <td style="text-align:right;">{{ number_format(abs($data['saldo_debet']),0,',','.') }}</td>
                    <td style="text-align:right;">{{ number_format(abs($data['saldo_kredit']),0,',','.') }}</td>
                </tr>
                @php($total_debet+=abs($data['saldo_debet']))
                @php($total_kredit+=abs($data['saldo_kredit']))
            @endforeach
        @endif
        <tr>
            <td colspan="2"><b>Total</b></td>
            <th style="text-align:right;">{{ number_format($total_debet,0,',','.') }}</th>
            <th style="text-align:right;">{{ number_format($total_kredit,0,',','.') }}</th>
        </tr>
        </tbody>

    </table>
</body>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</html>