<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produksi</title>
    <link rel="stylesheet" href="{{ @asset('component/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

</head>
<body style="margin: 20px;">
    <h4 style="text-align: center">Detail Produksi</h4>
    <p style="font-weight: bold;">
         Tim Produksi :
    </p>
    <p style="font-weight: bold;">
        Supervisor : {{ $data->linkToSupervisor->nama_ky }}
    </p>
    <p style="font-weight: bold;">Anggota:</p>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Produksi</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data->linkToMannyTenagaProduksi))
            @php($no=1)
            @foreach($data->linkToMannyTenagaProduksi as $data_item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data_item->linkToPekerja->nama_ky }}</td>
                    <td>{{ rupiahView($data_item->jumlah_upah) }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <p style="font-weight: bold;">Gambaran Umum:</p>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>No</th>
            <th>Kode Produksi</th>
            <th>No. Batch</th>
            <th>No. Serial</th>
            <th>Tgl. Mulai</th>
            <th>Tgl. Selesai</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>#</th>
            <th>{{ $data->kode_produksi }}</th>
            <th>{{ $data->batch_number }}</th>
            <th>{{ $data->no_serial }}</th>
            <th>{{ date('d-m-Y', strtotime($data->tgl_mulai)) }} {{ date('H:i:s', strtotime($data->jam_mulai)) }}</th>
            <th>{{ date('d-m-Y', strtotime($data->tgl_selesai)) }} {{ date('H:i:s', strtotime($data->jam_selesai)) }}</th>
        </tr>
        </tbody>
    </table>

    <p style="font-weight: bold;">Quality Control & Hasil</p>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Tgl diperiksa</th>
            <th colspan="2">Barang Dalam Proses</th>
            <th colspan="2">Barang jadi</th>
        </tr>
        <tr>
            <th>Bagus</th>
            <th>Rusak</th>
            <th>Bagus</th>
            <th>Rusak</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>1</th>
            <th>{{ date('d-m-Y', strtotime($data->tgl_mulai_qc)) }} s/d {{ date('d-m-Y', strtotime($data->tgl_selesai)) }}</th>
            <th>{{ $data->jumlah_bdp_bagus }}</th>
            <th>{{ $data->jumlah_bdp_rusak }}</th>
            <th>{{ $data->jumlah_brg_jadi_bagus }}</th>
            <th>{{ $data->jumlah_brg_jadi_rusan }}</th>
        </tr>
        </tbody>
    </table>
    <p style="font-weight: bold;">History Pelaksanaan</p>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>No.</th>
            <th>Proses Produksi</th>
            <th>Tgl & Jam Mulai</th>
            <th>Tgl & Jam Selesai</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data->linkToMannyProsesPengerjaan))
            @php($i=1)
            @foreach($data->linkToMannyProsesPengerjaan as $item_produksi)
                <tr>
                    <th>{{ $i++ }}</th>
                    <th>{{ $item_produksi->linkToProsesBisnis->proses_bisnis }}</th>
                    <th>{{ date('d-m-Y', strtotime($item_produksi->tgl_mulai)) }} {{ date('H:i:s', strtotime($item_produksi->jam_mulai)) }} </th>
                    <th>{{ date('d-m-Y', strtotime($data->tgl_selesai)) }} {{ date('H:i:s', strtotime($data->jam_selesai)) }} </th>
                    <th>{{ $item_produksi->ket }}</th>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(!empty($hpp))
        <ol >
            @foreach($hpp as $key=> $item)
                @foreach($item as $sub_item)
                    <li style="font-weight: bold;">{{ $sub_item['judul'] }} : Rp. {{ rupiahView($sub_item['total']) }}
                        <ul>
                            @if(!empty($sub_item['data']))
                                @foreach($sub_item['data'] as $value)
                                    <li>{{ $value['judul'] }} : Rp.{{ rupiahView($value['total']) }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endforeach
            @endforeach
        </ol>
    @endif
</body>
</html>
<script type="text/javascript">
    window.onload = function () {
        window.print();
    }
</script>