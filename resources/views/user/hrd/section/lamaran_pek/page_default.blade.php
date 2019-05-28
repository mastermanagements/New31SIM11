@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekruitmen
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-lamaran') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Masukan Rekrutmen</a>
        <p></p>
        <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Rekrutmen</h3>
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
                                        <th>Lowongan kerja</th>
                                        <th>Nama Pelamar</th>
                                        <th>Posisi</th>
                                        <th>Jenis Lamaran</th>
                                        <th>Berkas Lamaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($data_rekrutmen as $values)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <th>{{ $values->loker->nm_loker }}</th>
                                            <th>{{ $values->nm_pel }}</th>
                                            <th>{{ $values->posisi }}</th>
                                            <th>
                                                @foreach($jenis_lamaran as $key=> $value)
                                                    @if($values->jenis_lamaran == $key)
                                                        {{ $value }}
                                                    @endif
                                                @endforeach
                                            </th>
                                            <th><a href="{{ asset('fileCVLamaran/'.$values->berkas_lamaran) }}">unduh berkas</a> </th>
                                            <th>
                                                <form method="post" action="{{ url('hapus-lamaran/'.$values->id) }}">
                                                    <a href="{{ url('ubah-lamaran/'.$values->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <input type="hidden" name="_method" value="put">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini...')"><i class="fa fa-eraser"></i></button>
                                                </form>
                                            </th>
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
