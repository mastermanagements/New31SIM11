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
        <thead>
        <tr>
            <th>Keterangan</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php($total=0)
        @foreach($data as $key=>$first_floor)
            <tr style="background-color: lightgrey">
                <td align="left">{{ $key }}</td>
                <td></td>
            </tr>
            @foreach($first_floor as $key2 => $second_floor)
                @php($total_floor=0)
                @if(!empty($second_floor['data']))
                    <tr style="background-color: #b0d4f1">
                        <td align="left">{{ str_replace('_',' ', $key2) }}</td>
                        <td></td>
                    </tr>
                    @foreach($second_floor['data'] as $content)
                        <tr>
                            <td align="left">{{ $content[0] }}</td>
                            <td>{{ number_format($content[2],2,',','.') }}</td>
                            @php($total_floor+=$content[2])
                        </tr>
                    @endforeach
                    <tr style="background-color: deepskyblue">
                        <td align="left">Total {{ strtolower($key) }}</td>
                        <td>{{ number_format($total_floor,2,',','.') }}</td>
                        @php($total+=$total_floor)
                    </tr>
                @endif
            @endforeach
        @endforeach
        <tr style="background-color: lightgreen">
            <td align="left">Kas Pada Awal Periode 1 januari 2019</td>
            <td>{{ number_format($total,2,',','.') }}</td>
        </tr>
        <tr style="background-color: orange">
            <td align="left">Kenaikan Kas Bersih</td>
            <td>{{ number_format($total,2,',','.') }}</td>
        </tr>
        </tbody>

    </table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>