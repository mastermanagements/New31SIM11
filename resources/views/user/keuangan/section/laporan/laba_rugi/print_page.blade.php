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
        @foreach($data['data'] as $data_laba_rugi)
            <tr align="left" style="background-color: lightgrey">
                <td colspan= "2">{{ $data_laba_rugi['akun'] }}</td>
            </tr>
            @if(!empty($data_laba_rugi['sub_akun']))
                @foreach($data_laba_rugi['sub_akun'] as $data_sub)
                    <tr align="left" style="background-color: white">
                        <td>{{ $data_sub['nm_sub_akun'] }}</td>
                        <td>{{ number_format($data_sub['total'],2,',','.') }}
                        </td>
                    </tr>
                    @if(!empty($data_sub['data_sub_akun_aktif']))
                        @foreach($data_sub['data_sub_akun_aktif'] as $data_sub_sub)
                            @if($data_sub_sub['status'] ==1)
                                <tr align="left" style="background-color: white">
                                    <td style="padding-left: 30px">{{ $data_sub_sub['nm_sub_sub_akun'] }}</td>
                                    <td>{{ number_format($data_sub_sub['total_sub_sub'],2,',','.') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
            {{--@php($total_debet+=$data_neraca['debet'])--}}
            {{--@php($total_kredit+=$data_neraca['kredit'])--}}
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td >Laba Rugi</td>
            <td align="left">{{ number_format($data['total_laba_rugi'],2,',','.') }}</td>
        </tr>
        </tfoot>

    </table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>