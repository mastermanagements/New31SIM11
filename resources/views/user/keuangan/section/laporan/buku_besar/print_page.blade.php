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
        <thead style="padding-top: 15px">
            <tr class="vendorListHeading">
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $akun)
            <tr>
                <td >{{ $akun[0] }} </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @php($total_debet  = 0)
            @php($total_kredit = 0)
            @foreach($akun[1] as $keterangan)
                <tr class="body-table-buku-besar">
                    <td>{{ $keterangan['no_transaksi'] }}</td>
                    <td>{{ date('d-m-Y', strtotime($keterangan['tanggal'])) }}</td>
                    <td>{{ $keterangan['nama_keterangan'] }}</td>
                    <td>{{ number_format($keterangan['debet'],2,',','.') }}</td>
                    <td>{{ number_format($keterangan['kredit'],2,',','.') }}</td>
                    <td>{{ number_format($keterangan['saldo'],2,',','.') }}</td>
                    @php($total_debet  += $keterangan['debet'])
                    @php($total_kredit  += $keterangan['kredit'])
                </tr>
            @endforeach
            <tr style="background-color: #4CAF50" class="vendorListHeading">
                <td >Total</td>
                <td ></td>
                <td ></td>
                <td >{{ number_format($total_debet,2,',','.') }}</td>
                <td >{{ number_format($total_kredit,2,',','.') }}</td>
                <td ></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>