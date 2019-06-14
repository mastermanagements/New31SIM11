@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Periode Kerja
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-periode-kerja') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Masukan Periode Kerja</a>
        <p></p>
        <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Periode Kerja</h3>
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
                                        <th>Nama Keryawan</th>
                                        <th>Tanggal Mulai Kerja</th>
                                        <th>Tanggal Selesai Kerja</th>
                                        <th>Alasan Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($data_periode as $values)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <td>{{ $values->karyawan->nama_ky }}</td>
                                            <td>{{ date('d-m-Y', strtotime($values->mulai_kerja) ) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($values->selesai_kerja) ) }}</td>
                                            <td>{!! $values->alasan_selesai !!}</td>
                                            <td>
                                                <form method="post" action="{{ url('hapus-periode-kerja/'.$values->id) }}">
                                                    <a href="{{ url('ubah-periode-kerja/'.$values->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <input type="hidden" name="_method" value="put">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini...')"><i class="fa fa-eraser"></i></button>
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
