<div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
    <a href="{{ url('produksi-baru/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Produksi</a>
    <a href="{{ url('item-biaya-overhead/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Item Biaya Overhead</a>
    <p></p>
    <table id="example1" class="table table-bordered table-striped">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang Jadi</th>
                    <th>Nama Dalam Proses</th>
                    <th>Supervisor</th>
                    <th>Tanggal Mulai</th>
                    <th>Status Produksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data_produksi))
                    @php($no=1)
                    @foreach($data_produksi as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->linkToBarang->nm_barang }}, &nbsp;{{ $data->linkToBarang->linkToSatuan->satuan }}, &nbsp;{{ $data->linkToBarang->spec_barang }}</td>
                        @if(!empty($data->linkToBarangDalamProses->nm_barang ))
                        <td>{{ $data->linkToBarangDalamProses->nm_barang }}</td>
                        @else
                        <td>Tidak ada</td>
                        @endif
                        <td>{{ $data->linkToSupervisor->nama_ky }}</td>
                        <td>{{ $data->tgl_mulai }}</td>
                        <td>@if($data->status_produksi=='0') Baru @elseif($data->status_produksi=='1') Sedang Berlangsung @endif</th>
                        <td>
                            <form action="{{ url('produksi-baru/'.$data->id) }}" method="post">
                                {{ csrf_field() }}
                                @method('delete')
                                <a href="{{ url('bahan-baku/'.$data->id) }}" class="btn btn-primary" title="Tambah Bahan Baku" ><i class="fa fa-archive"></i></a>
                                <a href="{{ url('tenaga-produksi/'.$data->id) }}" class="btn btn-primary" title="Tambah Pekerja"><i class="fa fa-user-plus"></i></a>
                                <a href="{{ url('biaya-overhead/'.$data->id) }}" class="btn btn-primary" title="Tambah Biaya Overhead"><i class="fa fa-dollar"></i></a>
                                <a href="{{ url('proses-produksi/'.$data->id.'/begin-produksi') }}" class="btn btn-primary" title="Mulai Proses Produksi"><i class="fa fa-refresh"></i></a>
                                <a href="{{ url('produksi-baru/'.$data->id.'/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data produksi ini...?')"><i class="fa fa-eraser"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </table>
</div>
