@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Absensi
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-absensi') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Masukan Absensi</a>
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
                                        <th>Karyawan</th>
                                        <th>Periode</th>
                                        <th>Hari Normal</th>
                                        <th>Hadir</th>
                                        <th>Terlambat Masuk</th>
                                        <th>Terlambat Absen masuk</th>
                                        <th>Terlambat Absen Pulang</th>
                                        <th>Jumlah Izin</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($data as $values)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $values->karyawan->nama_ky }}</td>
                                            <td>{{ date('M', strtotime($values->periode)) }}</td>
                                            <td>{{ $values->normal_hari }}</td>
                                            <td>{{ $values->hadir }}</td>
                                            <td>{{ $values->terlambat_masuk }}</td>
                                            <td>{{ $values->tidak_absen_m }}</td>
                                            <td>{{ $values->tidak_absen_p }}</td>
                                            <td>{{ $values->jum_izin }}</td>
                                            <td>
                                                <form method="post" action="{{ url('delete-absensi/'.$values->id) }}">
                                                    <a href="{{ url('ubah-absensi/'.$values->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
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
