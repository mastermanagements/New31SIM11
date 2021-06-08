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
    <tbody>
    @if(!empty($data))

        @foreach($data as $key => $data_sort)
            <tr style="background-color: greenyellow">
                <td colspan="2">{{ $key }}</td>
            </tr>
            @if(!empty($data_sort['data']))
                @foreach($data_sort['data'] as  $key_account=> $data_akuns)
                    @foreach($data_akuns as $data_akun)
                        <tr>
                            <td>
                                <input type="hidden" name="id_akun[]" value="{{ $key_account }}">
                                <input type="hidden" name="id_aktif_ukm[]" value="{{ $data_akun['id_aktif_ukm'] }}">
                                <input type="hidden" name="tgl_jurnal[]" value="{{ $data_akun['tgl_jurnal'] }}">
                                <input type="hidden" name="debet_kredit[]" value="{{ $data_akun['debet_kredit'] }}">
                                @if($data_akun['posisi_saldo']=='D')
                                    {{ $data_akun['nama_akun'] }}
                                @else
                                    &nbsp;&nbsp;&nbsp;&nbsp;{{ $data_akun['nama_akun'] }}
                                @endif
                            </td>
                            @if($data_akun['posisi_saldo']=='D')
                                <td><input type="hidden" name="saldo_dk[]"
                                           value="{{ $data_akun['saldo_debet'] }}"> {{ number_format($data_akun['saldo_debet'],2,',','.') }}
                                </td>
                            @else
                                <td><input type="hidden" name="saldo_dk[]"
                                           value="{{ $data_akun['saldo_kredit'] }}"> {{ number_format($data_akun['saldo_kredit'],2,',','.') }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
                <tr style="background-color: lightblue">
                    <td>Total {{ $key }}</td>
                    <td>{{ number_format($data_sort['total'],2,',','.') }}</td>
                </tr>
            @endif
        @endforeach
    @endif
    </tbody>
</table>
</body>
<script type="text/javascript">
    //window.onload = function() { window.print(); }
</script>
</html>