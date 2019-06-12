@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kalender Kerja
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-aktifitas') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambahkan Aktifitas</a>
        <p></p>
        <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Aktifitas</h3>
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
                                        <th>Event</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($event as $values)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <td>{{ $values->event }} </td>
                                            <td>{{ date('d-m-Y', strtotime($values->tgl_mulai) ) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($values->tgl_akhir) ) }}</td>
                                            <td>
                                                <form method="post" action="{{ url('hapus-kalender-kerja/'.$values->id) }}">
                                                    <a href="{{ url('ubah-kalender-kerja/'.$values->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
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
