@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengumuman
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                 
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="{{ url('tambah-pengumuman') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pengumuman</a>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Pengumuman</th>
                                    <th>Isi Pengumuman</th>
                                    <th>Pengirim</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_umumkan as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->tgl_dibuat)) }}</td>
                                        <td>
                                            {{ $value->isi_p }}
                                        </td>
                                        <td>
                                            {{ $value->getKaryawan->nama_ky }}
                                        </td>
                                       <td>
                                            <form action="{{ url('delete-pengumuman/'.$value->id) }}" method="post">
                                                <a href="{{ url('ubah-pengumuman/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus pengumuman ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                       @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>

@stop