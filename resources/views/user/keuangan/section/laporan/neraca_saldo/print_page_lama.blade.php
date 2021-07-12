<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Cetak Laporan Neraca</title>
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
                <tr style="background-color: white">
                    <td>{{ $data['kode_akun'] }}</td>
                    <td>
                        @if(abs($data['saldo_debet']) == 0)
                            &nbsp;&nbsp;&nbsp;&nbsp; {{ $data['nama_akun'] }}
                        @else
                            {{ $data['nama_akun'] }}
                        @endif
                    </td>
                    <td>{{ number_format(abs($data['saldo_debet']),2,',','.') }}</td>
                    <td>{{ number_format(abs($data['saldo_kredit']),2,',','.') }}</td>
                </tr>
                @php($total_debet+=abs($data['saldo_debet']))
                @php($total_kredit+=abs($data['saldo_kredit']))
            @endforeach
        @endif
        <tr>
            <td colspan="2">Total</td>
            <th>{{ number_format($total_debet,2,',','.') }}</th>
            <th>{{ number_format($total_kredit,2,',','.') }}</th>
        </tr>
        </tbody>

    </table>
</body>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</html>