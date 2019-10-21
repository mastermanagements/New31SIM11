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
        @php($total_sub=0)
        @php($total_kredit=0)
        @php($total_debet=0)
        {{-- Kredit --}}
        <tr align="left" style="background-color: lightgrey">
            <td>{{ $data['kredit'][0]['akun'] }}</td>
            <td></td>
            <td>{{ number_format($data['kredit'][0]['sub_total'],2,',','.') }} @php($total_kredit = $data['kredit'][0]['sub_total'])</td>
        </tr>

        @foreach($data['kredit'][0]['sub_akun'] as $kredit)
            <tr align="left">
                <td>{{ $kredit['nm_sub_akun'] }}</td>
                <td></td>
                <td>{{ number_format($kredit['total'],2,',','.') }}</td>
            </tr>
        @endforeach
        <tr align="left" style="background-color: lightgrey">
            <td>{{ $data['laba_tahun_berjalan']['nm_sub_akun'] }} </td>
            <td>{{ number_format($data['laba_tahun_berjalan']['total'],2,',','.') }}</td>
            <td></td>
        </tr>
        {{--debit--}}
        @php($total_debet=$data['debit'][0]['sub_total'])
        @foreach($data['debit'][0]['sub_akun'] as $debit)
            <tr align="left">
                <td>{{ $debit['nm_sub_akun'] }} aa</td>
                <td></td>
                <td>{{ number_format($debit['total'],',','.') }}</td>
            </tr>
        @endforeach
        {{--Laba Bersih--}}
        <tr align="left" style="background-color: deepskyblue">
            <td>
                @if($data['laba_tahun_berjalan']['total'] < 0)
                    Pengurang Modal
                @else
                    Penambah Modal
                @endif
            </td>
            <td></td>
            <td>
                @php($total_debet = $total_debet+$data['laba_tahun_berjalan']['total'] + $total_debet)
                {{ number_format($total_debet,2,',','.') }}
            </td>
        </tr>
        <tr align="left">
            <td>
                Modal Akhir
            </td>
            <td></td>
            <td>
                @if($total_debet < 0)
                    {{ number_format($total_kredit - $total_debet,2,',','.') }}
                @else
                    {{ number_format($total_kredit + $total_debet,2,',','.') }}
                @endif
            </td>
        </tr>
        </tbody>


    </table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>