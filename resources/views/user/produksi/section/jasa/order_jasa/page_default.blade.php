@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Order Jasa
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
                      <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Order Jasa </a></li>
                      <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Pengerjaan</a></li>

                  </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('Order-Jasa/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Order Jasa </a>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($order_jasa))
                                    <div class="col-md-12"> <h4 align="center">Order jasa masih kosong </h4></div>
                                @else
                                <div class="col-md-12">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Daftar Order Jasa</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Tanggal Order</th>
                                                            <th>Nama Klien</th>
                                                            <th>Penerima</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($no = 1)
                                                            @foreach($order_jasa as $ojasa)
                                                                <tr>
                                                                    <td>{{ $no++ }}</td>
                                                                    <td>{{ tanggalView($ojasa->tgl_order) }}</td>
                                                                    <td>{{ $ojasa->getKlien->nm_klien }}</td>
                                                                    <td>{{ $ojasa->getKaryawan->nama_ky }}</td>
                                                                    <th>
                                                                      <form action="{{ url('Order-Jasa/'.$ojasa->id) }}" method="post">
                                                                        @method('delete')
                                                                        {{ csrf_field() }}
                                                                          <a href="{{ url('Order-Jasa/'.$ojasa->id.'/edit') }}" type="button" class="btn btn-warning" title="ubah Order Jasa">ubah</a>
                                                                          <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data ini ... ?')" class="btn btn-danger" title="hapus layanan">hapus</button>
                                                                          <a href="#" onclick="window.location.href='{{ url('rincian-orderjasa/'.$ojasa->id) }}'" class="btn btn-default">Rincian Order Jasa</a>
                                                                      </form>
                                                                    </th>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                @endif
                            </div>
                            <!--./row --->
                        </div>
                        <!--./tab-pane-1-->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>




        </div>
    </section>
    <!-- /.content -->


    <!-- /.modal -->

</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>

@stop
