@extends('user.superadmin_ukm.master.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Jabatan {{ $usaha->nm_usaha }}</h3>
                            <a href="{{ url('tambah-jabatan/'.$usaha->id) }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Jabatan</a>
                        </div>

                        <div class="box-body">
                            @if(!empty(session('message_success')))
                                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                            @elseif(!empty(session('message_fail')))
                                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                            @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Jabatan</th>
                                    <th>Level Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($jabatan as $jabatans)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $jabatans->nm_jabatan }}</td>
                                        <td>
                                            @if($jabatans->level_jabatan==0)
                                                Direktur/CEO/Dirut/Pimpinan
                                            @elseif($jabatans->level_jabatan==1)
                                                Bagian Administrasi
                                            @elseif($jabatans->level_jabatan==2)
                                                Bagian Produk
                                            @elseif($jabatans->level_jabatan==3)
                                                Bagian Marketing
                                            @elseif($jabatans->level_jabatan==4)
                                                Bagian Keuangan
                                            @elseif($jabatans->level_jabatan==5)
                                                Bagian HRD
                                            @elseif($jabatans->level_jabatan==6)
                                                Bagian Penggajian
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('jabatan-delete/'.$jabatans->id) }}" method="post">
                                                <a href="{{ url('ubah-jabatan/'.$usaha->id.'/'.$jabatans->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
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
                    <!-- /.box -->
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
@stop
