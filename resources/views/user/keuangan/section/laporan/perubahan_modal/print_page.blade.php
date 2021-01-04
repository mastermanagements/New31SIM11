<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Cetak Laporan Buku Besar</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
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

        @media print {
            tr.vendorListHeading {
                background-color: #4CAF50 !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @media print {
            .vendorListHeading th {
                color: white !important;
            }
        }
    </style>
</head>
<body style="margin: 10px;padding: 20px">
    <table id="customers">
        <tbody>
        @php($saldo_kredit=0)
        @php($saldo_debet=0)
        @php($saldo_laba=0)
        @foreach($data as $key=>$data_)
            @if($key!='laba_rugi')
                @foreach($data_ as $daftar_akun)
                    <tr>
                        <td>{{ $daftar_akun['nama_akun'] }}</td>
                        <td>
                            @if($daftar_akun['posisi_saldo']=="D")
                                @php($saldo_debet+=abs($daftar_akun['saldo_debet']))
                            @else
                                @php($saldo_kredit+=abs($daftar_akun['saldo_kredit']))
                            @endif
                            {{ number_format($daftar_akun['saldo_debet']+$daftar_akun['saldo_kredit'],2,',','.') }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{{ $data_['nama_akun'] }}</td>
                    <td>
                        @php($saldo_laba+=($data_['saldo_debet']+$data_['saldo_kredit']))
                        {{ number_format(($data_['saldo_debet']+$data_['saldo_kredit']),2,',','.') }}
                    </td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td>Penambahan Saldo</td>
            <td>{{ number_format($saldo_laba-$saldo_debet,2,',','.') }}</td>
        </tr>
        <tr>
            <td>Modal Akhir</td>
            <td>{{ number_format(($saldo_laba-$saldo_debet)+$saldo_kredit,2,',','.') }}</td>
        </tr>
        </tbody>


    </table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>