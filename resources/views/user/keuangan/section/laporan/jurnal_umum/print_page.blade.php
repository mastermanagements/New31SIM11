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

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

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
{!! $header !!}
<p></p>
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

    @if(!empty($data_jurnal))
        @foreach($data_jurnal as $data)
            <tr>
                <td>{{ $data['no_transaksi'] }}</td>
                <td>{{ $data['tanggal'] }}</td>
                <td>{{ $data['kode_akun'] }}</td>
                <td>{{ $data['nama_akun'] }}</td>
                <td>
                    @if($data['debet'] == 0)
                        &nbsp;&nbsp;&nbsp; {{ $data['keterangan'] }}
                    @else
                        {{ $data['keterangan'] }}
                    @endif
                </td>
                <td>{{ $data['debet'] }}</td>
                <td>{{ $data['kredit'] }}</td>
            </tr>
        @endforeach
    @endif
    <tr class="vendorListHeading">
        <th colspan="5"></th>
        <th>{{ $total_debet }}</th>
        <th>{{ $total_kredit }}</th>
    </tr>

</table>
</body>
<script type="text/javascript">
    window.onload = function () {
        window.print();
    }
</script>
</html>