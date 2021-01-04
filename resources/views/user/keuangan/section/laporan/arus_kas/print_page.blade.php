<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Cetak Laporan Arus Kas</title>
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
        <thead>
        <tr>
            <th>Akun</th>
            <th>Keterangan</th>
            <th>Sub Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$data)
            @if($key !='total_laba_rugi')
                <tr>
                    <th colspan="3">{{  $akun[$key]['0'] }}</th>
                </tr>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item['kode_akun'] }} - {{  $item['nama_akun'] }}</td>
                        <td>{{  $item['keterangan'] }}</td>
                        <td>{{  number_format($item['sub_total'],2,',','.') }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
        </tbody>

    </table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>