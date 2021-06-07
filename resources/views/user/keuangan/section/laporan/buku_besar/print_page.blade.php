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
<body style="margin: 10px;padding: 20px">
{!! $header !!}
<p></p>
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
    @if(!empty($data_buku_besar))
        @foreach($data_buku_besar as $key=> $data)
            <tr style="background-color: lawngreen; text-align: left; font-weight: bold">
                <td colspan="6">{{ $akun->where('id',$key)->first()->nm_akun_aktif }}</td>
            </tr>
            @foreach($data as $sub_key => $sub_data)
                <tr style="background-color: white">
                    <td>{{ $sub_data['no_transaksi'] }}</td>
                    <td>{{ $sub_data['tanggal'] }}</td>
                    <td>
                        @if($sub_data['debet']==0)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $sub_data['keterangan'] }}
                        @else
                            {{ $sub_data['keterangan'] }}
                        @endif
                    </td>
                    <td>{{ $sub_data['debet'] }}</td>
                    <td>{{ $sub_data['kredit'] }}</td>
                    <td>
                        @if($sub_data['saldo_debet']!=0)
                            {{ $sub_data['saldo_debet'] }}
                        @else
                            {{ $sub_data['saldo_kredit'] }}
                        @endif
                    </td>
                </tr>
            @endforeach
        @endforeach
    @endif
    </tbody>
</table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>