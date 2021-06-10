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

                                    <a href="{{ url('Order-Jasa/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Order Jasa </a>

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

                        <div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
                          @foreach($list_service as $service)
                          <div class="box box-success collapsed-box">
                              <div class="box-header with-border">
                                  <h3 class="box-title">
                                     <span class="username">{{ $service->getOrderJasa->getKlien->nm_klien }}, Hp:{{ $service->getOrderJasa->getKlien->hp }}</span>
                                  </h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                   </div>
                                    <!-- /.box-tools -->
                              </div>
                              @php($i=1)
                                  @foreach($detail_order_jasa as $detail_oj)
                                    @foreach($order_jasa as $orderjasa)
                                      @if($detail_oj->id_order_jasa == $service->id_order_jasa AND $detail_oj->id_order_jasa == $orderjasa->id AND $detail_oj->status_service == '1')
                                        <div class="box-body">
                                              <div class="box-header with-border">
                                                  <h5 class="box-title"><b>{{ $i++ }}. {{ $detail_oj->getJasa->nm_layanan }}</b></h5>
                                                  <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" onclick="tambahDoService({{ $detail_oj->id }})" title="Mulai pengerjaan service"><i class="fa fa-plus"></i></button>
                                                  </div>
                                                  <!-- /.box-tools -->
                                              </div>
                                                <div class="col-md-6">
                                                  <div class="box-footer no-padding">
                                                      <ul class="nav nav-stacked">
                                            						<li><b>Tgl Order</b> <span class="pull-right">@if(!empty($detail_oj->getOrderJasa->tgl_order)){{ date('d-m-Y H:i:s', strtotime($detail_oj->getOrderJasa->tgl_order))}}@endif</span></li>
                                                        @if ($service->getOrderJasa->getPerusahaan->jenis_jasa == '1')
                                                        <li><b>Barang</b> <span class="pull-right">{{ $detail_oj->getBarang->nm_barang }} </span></li>
                                                        @endif
                                                        <li><b>Penerima</b> <span class="pull-right">{{ $orderjasa->getKaryawan->nama_ky }} </span></li>
                                                      </ul>
                                                  </div>
                                              </div>
                                                <div class="col-md-6">
                                                <div class="box-footer no-padding">
                                                  <ul class="nav nav-stacked">
                                                    <li><b>Jumlah</b><span class="pull-right">{{ $detail_oj->qty }} @if(!empty($detail_oj->getBarang->linkToSatuan->satuan)){{ $detail_oj->getBarang->linkToSatuan->satuan }} @endif</span></li>
                                                    <dl>
                                                        <dt>Keterangan</dt>
                                                        <dd>{!! $detail_oj->ket !!}</dd>
                                                    </dl>
                                                  </ul>
                                                </div>
                                              </div>
                                                @foreach($pelaksanaan_jasa as $pl)
                                                  @if($pl->id_detail_oj == $detail_oj->id)
                                                  <div class="col-md-6">
                                                    <div class="box-footer no-padding">
                                                      <ul class="nav nav-stacked">
                                                        <dl>
                                                            <dt>&nbsp;&nbsp;&nbsp;<span class="badge bg-yellow">@if(!empty($pl->getProBis)) {{ $pl->getProBis->proses_bisnis }} @endif</span>
                                                              <a href="#" onclick="ubahPLAwal({{ $pl->id }})" class="pull-right" title="Isi apa yang dilakukan">&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i></a>
                                                              <a href="#" onclick="ubahPLSelesai({{ $pl->id }})" class="pull-right" title="Tuliskan Hasil disini">&nbsp;&nbsp;&nbsp;<i class="fa fa-clone"></i></a>
                                                              <a href="#" onclick="ubahPLConfirm({{ $pl->id }})" class="pull-right" title="Konfirm klien">&nbsp;&nbsp;&nbsp;<i class="fa fa-bus"></i></a>
                                                              <a href="#" onclick="ubahPLStatusAkhir({{ $pl->id }})" class="pull-right" title="Status Akhir"><i class="fa fa-laptop"></i></a>
                                                            </dt>
                                                                <ul>
                                                                    <li><span class="direct-chat-name pull-left">Mulai Proses ini</span> <span class="pull-right">@if(!empty($pl->tgl_jam_mulai)){{ date('d-m-Y H:i:s', strtotime($pl->tgl_jam_mulai)) }} @endif </span></li>
                                                                    <li><span class="direct-chat-name pull-left">Mulai dikerjakan</span> <span class="pull-right">@if(!empty($pl->tgl_jam_do)){{ date('d-m-Y H:i:s', strtotime($pl->tgl_jam_do)) }} @endif </span></li>
                                                                    <li><span class="direct-chat-name pull-left">Apa Yg dikerjakan </span> </li>
                                                                      {!! $pl->what_do !!}
                                                                    <li><span class="direct-chat-name pull-left">Selesai dikerjakan </span><span class="pull-right">@if(!empty($pl->tgl_jam_finish)){{ date('d-m-Y H:i:s', strtotime($pl->tgl_jam_finish)) }} @endif</span></li>
                                                                    <li><span class="direct-chat-name pull-left">Hasilnya </span></li>
                                                                      {!! $pl->what_result !!}
                                                                    <li><span class="direct-chat-name pull-left">Konfirm Klien </span><span class="pull-right">@if(!empty($pl->tgl_jam_konfirm)){{ date('d-m-Y H:i:s', strtotime($pl->tgl_jam_konfirm)) }} @endif</span></li>
                                                                    <li><span class="direct-chat-name pull-left">Respon Klien </span></li>
                                                                      {!! $pl->what_respon !!}
                                                                    <li><span class="direct-chat-name pull-left">Status Service</span><span class="pull-right">
                                                                        @if($status_perproses == '1') Lanjut service
                                                                          @elseif($status_perproses == '2') Cancel Service
                                                                          @elseif($status_perproses == '3') Gagal Service
                                                                          @elseif ($status_perproses == '3') Berhasil Service
                                                                        @endif
                                                                        </span>
                                                                    </li>
                                                                    <li><span class="direct-chat-name pull-left">Yang Mengerjakan</span><span class="pull-right">{{ $pl->getYgMengerjakan->nama_ky }} </span></li>
                                                                    <li><span class="direct-chat-name pull-left">Yang Mengkonfirmasi</span><span class="pull-right">@if(!empty($pl->getYgMengkonfirmasi->nama_ky)){{ $pl->getYgMengkonfirmasi->nama_ky }}@endif </span></li>
                                                                </ul>
                                                        </dl>
                                                      </ul>
                                                    </div>
                                                    </div>
                                                @endif
                                                @endforeach
                                      </div>
                                      <!-- /.box-body -->
                                      @endif
                                    @endforeach
                                  @endforeach
                                @endforeach
                              </div>
                              <!-- /.box-success-->
                          </div>
                          <!-- /.tab-pane 2-->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
          <!--col-12-->
        </div>
        <!--row-->
    </section>
    <!-- /.content -->


    <!-- /.modal -->

</div>
 @include('user.produksi.section.jasa.pelaksanaan_jasa.modal')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>

    <script>
    $(document).ready(function () {
            var ids;

      tambahDoService = function (id) {
                $('[name="id_detail_oj"]').val(id);
                $('#modal-tambah-doservice').modal('show');
            };
      ubahPLAwal = function (id) {
                  $.ajax({
                      url: '{{ url('ubah-PLAwal') }}/'+id,
                      dataType : 'json',
                      success:function (result) {
                          $('[name="id_pl"]').val(result.data_pl.id);
                           CKEDITOR.instances.what_do.setData(result.data_pl.what_do);
                          $('#modal-ubah-PLAwal').modal('show');
                      }
                  })
         };
         ubahPLSelesai = function (id) {
                     $.ajax({
                         url: '{{ url('ubah-PLSelesai') }}/'+id,
                         dataType : 'json',
                         success:function (result) {
                             $('[name="id_pl"]').val(result.data_pl.id);
                              CKEDITOR.instances.what_result.setData(result.data_pl.what_result);
                             $('#modal-ubah-PLSelesai').modal('show');
                         }
                     })
            };

            ubahPLConfirm = function (id) {
                        $.ajax({
                            url: '{{ url('ubah-PLConfirm') }}/'+id,
                            dataType : 'json',
                            success:function (result) {
                                $('[name="id_pl"]').val(result.data_pl.id);
                                 CKEDITOR.instances.what_respon.setData(result.data_pl.what_respon);
                                 //$('[name="yg_mengkonfirmasi"]').val(result.data_pl.yg_mengkonfirmasi);
                                $('#modal-ubah-PLConfirm').modal('show');
                            }
                        })
               };
               ubahPLStatusAkhir = function (id) {
                           $.ajax({
                               url: '{{ url('ubah-PLStatusAkhir') }}/'+id,
                               dataType : 'json',
                               success:function (result) {
                                   $('[name="id_pl"]').val(result.data_pl.id);
                                   $('[name="status_perproses"]').val(result.data_pl.status_perproses).trigger('change');
                                   $('#modal-ubah-PLStatusAkhir').modal('show');
                               }
                           })
                  };
    })
    </script>

@stop
