<div>
    <a href="{{ url('tambah-rek-ukm') }}" class="btn btn-block btn-info"><i class="fa fa-file-text-o"></i> Tambah Rekening Perusahaan</a>
    @if(!empty(session('message_success')))
        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
    @elseif(!empty(session('message_fail')))
        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
    @endif
    <p></p>
    <div class="row">

        <div class="col-md-12">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th>Kantor Cabang</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php($i=1)
                @foreach($rek_ukm as $value)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $value->nama_bank }}</td>
                    <td>{{ $value->no_rek }}</td>
                    <td>{{ $value->atas_nama }}</td>
                    <td>{{ $value->kcp }}</td>
                    <td>

                              <a target="_blank" href="{{ url('edit-rek-ukm/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>

                              {{ csrf_field() }}
                              <input type="hidden" name="_method" value="put"/>
                                @if(empty($value->getBayarBeli->bank_asal))
                              <form action="{{ url('delete-rek-ukm/'.$value->id) }}" method="post">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus Ijin ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>

                              </form>
                              @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
