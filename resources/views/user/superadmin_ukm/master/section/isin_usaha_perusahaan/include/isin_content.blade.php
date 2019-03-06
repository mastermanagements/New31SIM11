<div>
    <a href="{{ url('unggah-ijin') }}" class="btn btn-block btn-info"><i class="fa fa-file-text-o"></i> Unggah Isin Usaha Anda</a>
    @if(!empty(session('message_success')))
        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
    @elseif(!empty(session('message_fail')))
        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
    @endif
    <p></p>
    <div class="row">


        <div class="col-md-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Ijin</th>
                    <th>No. Ijin</th>
                    <th>Berlaku</th>
                    <th>Kualifikasi</th>
                    <th>Instansi pemberi</th>
                    <th>Klasifikasi</th>
                    <th>File UI</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php($i=1)
                @foreach($ijin as $value)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $value->nm_ijin }}</td>
                    <td>{{ $value->no_ijin }}</td>
                   <td>{{ date('d-m-Y', strtotime($value->berlaku)) }}</td>
                    <td>{{ $value->kualifikasi }}</td>
                    <td>{{ $value->instansi_pemberi }}</td>
                    <td>{{ $value->klasifikasi }}</td>
                    <td>{{ $value->file_iu }}</td>
                    <td>
                        <form action="#" method="post">
                            <a href="{{ url('unggah-ijin/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                            <p></p>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put"/>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus Ijin ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>