<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-i-pelaksana"> <i class="fa fa-plus"></i> Nisbah pelaksana </button>
                @if(!empty(session('message_success')))
                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                @elseif(!empty(session('message_fail')))
                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                @endif
                <table id="example1" class="table table-bordered table-striped tbdividenPerusahaan" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pelaksana</th>
                            <th>Periode/Bulan/tahun</th>
                            <th>Besar Dividen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->pelaksana->karyawan->nama_ky}}</td>
                            <td>{{ $value->bulan_dividen->periode_invest->nm_periode }} ( {{ $value->bulan_dividen->bln_dividen }} - {{ $value->bulan_dividen->thn_dividen }} )</td>
                            <td>{{ $value->besar_dividen }}</td>
                            <td>
                                <form action="{{ url('delete-nisbah-pelaksana/'. $value->id) }}" method="post">
                                    <input type="hidden" name="_method" value="put">
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-warning" onclick="edit_dividen_pelaksana('{{ $value->id }}')">ubah</button>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ... ?')">hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>