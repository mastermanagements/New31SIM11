<div class="tab-pane" id="tab_2">
    <a href="{{ url('produksi-baru/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Produksi</a>
    <p></p>
    <table id="example1" class="table table-bordered table-striped">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
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
                        <th>{{ $no++ }}</th>
                        <th>{{ $data->linkToBarang->nm_barang }}</th>
                        <th>{{ $data->linkToSupervisor->nama_ky }}</th>
                        <th>{{ $data->tgl_mulai }}</th>
                        <th>@if($data->status_produksi=='0') Baru @elseif($data->status_produksi=='1') Sedang Berlangsung @endif</th>
                        <th>
                            <form action="{{ url('produksi-baru/'.$data->id) }}" method="post">
                                {{ csrf_field() }}
                                @method('delete')
                                <a href="{{ url('produksi-baru/'.$data->id.'/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda akan menghapus data produksi ini...?')"><i class="fa fa-eraser"></i></button>
                            </form>
                        </th>
                    @endforeach
                @endif
            </tbody>
        </table>
    </table>
</div>