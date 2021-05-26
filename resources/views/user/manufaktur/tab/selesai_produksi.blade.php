<div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">
    <table id="example1" class="table table-responsive">
        <thead>
        <tr>
            <th >No</th>
            <th >Kode Produksi</th>
            <th >Barang</th>
            <th>Jadi</th>
            <th>Dalam Proses</th>
            <th>Rusak</th>
            <th >Supervisor</th>
            <th >Tgl selesai</th>
            <th >Lama Produksi</th>
            <th >Hpp</th>
            <th >Aksi</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($selesai_produksi))
            @php($no=1)
            @foreach($selesai_produksi as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->kode_produksi }}</td>
                    <td>{{ $data->linkToBarang->nm_barang }}</td>
                    <td>{{ $data->jumlah_brg_jadi_bagus }}</td>
                    <td>{{ $data->brg_dalam_proses }}</td>
                    <td>{{ $data->jumlah_brg_jadi_rusan  }}</td>
                    <td>{{$data->linkToSupervisor->nama_ky  }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->tgl_selesai)) }}</td>
                    <td>{{ date('H:i:s', strtotime($data->lama_produksi)) }}</td>
                    <td>{{ $data->linkToBarang->hpp }}</td>
                    <td><a href="{{ url('detail-barang-selesai-produksi/'.$data->id) }}" class="btn btn-primary">Detail</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
