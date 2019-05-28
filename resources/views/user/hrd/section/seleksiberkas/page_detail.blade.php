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
                                <h3 class="box-title">Daftar Pelamar</h3>
                            </div>

                            <div class="box-body">
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Peserta pelamar</th>
                                            <th>Hasil</th>
                                        </tr>
                                        @php($i=1 )
                                        @if(empty($data_pelamar))
                                            <tr>
                                                <td colspan="2">Data Pelamar Masih Kosong</td>
                                            </tr>
                                        @else
                                            @foreach($data_pelamar as $data)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td><a href="{{ url('Seleksi-pesarta/'.$data->id) }}">{{ $data->nm_pel }}</a></td>
                                                    <td>
                                                        @if(!empty($data->seleksi_berkas))
                                                            @if($data->seleksi_berkas->hasil=="1")
                                                                <span class=" badge bg-green">Lulus</span>
                                                            @else
                                                                <span class=" badge bg-red">Tidak Lulus</span>
                                                            @endif
                                                        @else
                                                            <span class=" badge bg-orange">Belum Dinilai</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>

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
