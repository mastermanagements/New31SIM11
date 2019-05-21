@extends('user.administrasi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Jadwal Proyek
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
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Daftar Jadwal Proyek</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <!-- THE CALENDAR -->
                            <div class="row">

                                <div class="col-md-12">
                                    <!-- Custom Tabs -->

                                            <div class="tab-pane active" id="tab_1">
                                                <div class="row">
                                                    @if(empty($proyek))
                                                        <div class="col-md-12"> <h4 align="center">Anda belum menambahkan data jadwal proyek </h4></div>
                                                    @else
                                                        @foreach($proyek as $value)
                                                            <div class="col-md-12">
                                                                <div class="box box-success box-solid">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">Tanggal Buat : {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <form action="{{ url('delete-proyek/'.$value->id) }}" method="post">
                                                                                <a href="{{ url('ubah-proyek/'.$value->id) }}" type="button" class="btn btn-box-tool" title="ubah proyek"><i class="fa fa-pencil"></i>
                                                                                </a>
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="_method" value="put">
                                                                                <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data barang ini ... ?')" class="btn btn-box-tool" title="hapus proyek"><i class="fa fa-eraser"></i>
                                                                                </button>
                                                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                        <!-- /.box-tools -->
                                                                    </div>
                                                                    <!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3 style="color: #0b93d5; margin-top: 0px"><u></u> </h3>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <h4 style="font-weight: bold">Rincian Proyek
                                                                                        </h4>
                                                                                        <p>Nama Proyek : {{ $value->spk->nm_spk }}</p>
                                                                                        <p>No. SPK : {{ $value->spk->no_spk }}</p>
                                                                                        <hr>
                                                                                        <p>Klien : {{ $value->spk->getKlien->nm_klien }}</p>
                                                                                        <p>Nama Perusahaan : {{ $value->spk->getKlien->nm_perusahaan }}</p>
                                                                                        <p>Alamat : {{ $value->spk->getKlien->alamat }}</p>
                                                                                        <p>No.Hp : {{ $value->spk->getKlien->hp }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-9" style="width:73%;height: 255px; overflow-y: scroll; ">
                                                                                        <p><h5 style="font-weight: bold">Jadwal Proyek :   </h5>
                                                                                        <table class="table table-striped example2">
                                                                                            <tbody><tr>
                                                                                                <th style="width: 10px">#</th>
                                                                                                <th>Gugus Tugas</th>
                                                                                                <th>Durasi</th>
                                                                                                <th>Mulai</th>
                                                                                                <th>Selesai</th>
                                                                                                <th style="width: 40px">Aksi</th>
                                                                                            </tr>

                                                                                            @if(!empty($value->taks_proyek))
                                                                                                @php($i=1)
                                                                                                    @foreach($value->taks_proyek as $keys=> $value2)

                                                                                                    <tr>
                                                                                                        <td>{{ $i }}</td>
                                                                                                        <td> {{ $value2->nama_tugas }} </td>
                                                                                                        <td>{{ $value2->jadwal_proyek->sum('durasi') }}</td>
                                                                                                        <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek->sortBy('tgl_mulai')->groupBy('id_task_p')->take(1)->first()[0]['tgl_mulai'])) }}</td>
                                                                                                        <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek->sortByDesc('tgl_selesai')->groupBy('id_task_p')->take(1)->first()[0]['tgl_selesai'])) }}</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    @if(!empty($value2->rincian_tugas))
                                                                                                        @php($j=1)
                                                                                                        @foreach($value2->rincian_tugas as $key => $rincian_tugas)
                                                                                                            <tr>
                                                                                                                <td>{{ $i++.'.'.$j++ }}</td>
                                                                                                                <td>{{ $rincian_tugas->rincian_tugas }} </td>
                                                                                                               @if(!empty($value2->jadwal_proyek[$key]))
                                                                                                                <td>{{ $value2->jadwal_proyek[$key]->durasi }}</td>
                                                                                                                <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek[$key]->tgl_mulai)) }}</td>
                                                                                                                <td>{{ date('d-m-Y', strtotime($value2->jadwal_proyek[$key]->tgl_selesai)) }}</td>
                                                                                                                <td>
                                                                                                                   <form action="{{ url('Daftar-progress/'.$value2->jadwal_proyek[$key]->id) }}" method="get">
                                                                                                                       {{ csrf_field() }}
                                                                                                                        <button type="submit" class="btn btn-xs btn-danger" ><i class="fa fa-file-text"></i></button>
                                                                                                                   </form>
                                                                                                                </td>
                                                                                                                @else
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                    <td><p style="color: red">Belum Dimasukan</p></td>
                                                                                                                @endif

                                                                                                            </tr>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                @endforeach
                                                                                                {{ $proyek->links() }}
                                                                                            @else
                                                                                                <tr>
                                                                                                    <td colspan="2">Tim Belum dimasukan</td>
                                                                                                </tr>
                                                                                            @endif
                                                                                            </tbody>
                                                                                        </table>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.box-body -->
                                                                </div>
                                                                <!-- /.box -->
                                                            </div>
                                                        @endforeach
                                                        {{--{{ $data_jadwal->links() }}--}}
                                                    @endif
                                                </div>
                                            </div>


                                    <!-- nav-tabs-custom -->
                                </div>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>

</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
@stop