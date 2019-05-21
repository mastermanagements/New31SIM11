@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Seleksi Berkas
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Lowongan pekerjaan</h3>
                            </div>

                            <div class="box-body">
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Lowongan Pekerjaan </th>
                                            <th>Banyak Pelamar</th>
                                        </tr>
                                        @php($i=1)
                                        @foreach($data_loker as $data)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td><a href="{{ url('daftar-pelamar/'.$data->id) }}">{{ $data->nm_loker }}</a></td>
                                            <td><span class="badge bg-red">{{ $data->lamaran_pek->count('id') }}</span></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data_loker->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@stop
