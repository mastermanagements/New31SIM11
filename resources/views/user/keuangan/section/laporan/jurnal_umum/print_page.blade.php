<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Cetak Laporan Jurnal Umum</title>
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
<body>
    <table id="customers">

             <tr class="vendorListHeading">
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Kode Akun</th>
                <th>Nama Akun</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
            @php($total_debet=0)
            @php($total_kredit=0)
            @foreach($data as $value)
                <tr>
                    <td>{{ $value['no_transaksi'] }}</td>
                    <td>{{ $value['tanggal'] }}</td>
                    <td>{{ $value['kode_akun'] }}</td>
                    <td>{{ $value['nm_akun'] }}</td>
                    <td>{{ $value['nama_keterangan'] }}</td>
                    <td>{{ number_format($value['debet'],2,',','.') }}</td>
                    <td>{{ number_format($value['kredit'],2,',','.') }}</td>
                </tr>
            @php($total_debet+=$value['debet'])
            @php($total_kredit+=$value['kredit'])

        @endforeach
            <tr class="vendorListHeading">
                <th colspan="5"></th>
                <th>{{ number_format($total_debet,2,',','.') }}</th>
                <th>{{ number_format($total_kredit,2,',','.') }}</th>
            </tr>

    </table>
</body>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</html>