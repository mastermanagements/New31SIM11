@extends('user.produksi.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Jasa
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
                      <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Layanan </a></li>
                      <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Proses Bisnis</a></li>
                      <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Syarat dan Ketentuan </a></li>
                      <li class="@if(Session::get('tab6') == 'tab6') active @else '' @endif"><a href="#tab_6" data-toggle="tab"><i class="fa fa-book"></i> Promo Jasa </a></li>

                  </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <a href="{{ url('Jasa/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Layanan </a>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(empty($data_jasa))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan layanan </h4></div>
                                @else
                                <div class="col-md-12">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Daftar Layanan</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama Layanan</th>
                                                            <th>Quantity</th>
                                                            <th>Lama Pengerjaan</th>
                                                            <th>Biaya</th>
                                                            <th>Keterangan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($no = 1)
                                                            @foreach($data_jasa as $jasa)
                                                                <tr>
                                                                    <td>{{ $no++ }}</td>
                                                                    <td>{{ $jasa->nm_layanan }}</td>
                                                                    <td>{{ $jasa->peritem }} {{ $jasa->getSatuan->satuan }}</td>
                                                                    <td>{{ $jasa->waktu_kerja }} {{ $jasa->getSatuanWaktu->satuan}}
                                                                          @if($jasa->waktu_selesai == 0)
                                                                            ( Pasti ) @elseif($jasa->waktu_selesai == 1) ( Estimasi  )
                                                                          @endif
                                                                    </td>
                                                                    <td>{{ $jasa->biaya }}</td>
                                                                    <td>{!! $jasa->ket !!}</td>
                                                                    <th>
                                                                        <form action="{{ url('Jasa/'.$jasa->id) }}" method="post">
                                                                          <!---bisa jg url ="{{ url('Jasa/'.$jasa->id.'/destroy') }}"-->
                                                                              @method('delete')
                                                                              {{ csrf_field() }}
                                                                            <a href="{{ url('Jasa/'.$jasa->id.'/edit') }}" type="button" class="btn btn-warning" title="ubah layanan">ubah</a>
                                                                            <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data layanan ini ... ?')" class="btn btn-danger" title="hapus layanan">hapus</button>
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
                          <div class="row">
                              <div class="col-md-3" style="margin: 0">
                                  <a href="{{ url('Proses-Bisnis/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Proses Bisnis </a>
                              </div>
                          </div>
                          <p></p>
                          <div class="row">
                              @if(empty($proses_bisnis))
                                  <div class="col-md-12"> <h4 align="center">Anda belum menambahkan Proses Bisnis Jasa </h4></div>
                              @else
                              <div class="col-md-12">
                                  <div class="box box-success">
                                      <div class="box-header with-border">
                                          <h3 class="box-title">Daftar Proses Bisnis Jasa</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body">
                                          <div class="row">
                                              <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                  <table id="example1" class="table table-bordered table-striped">
                                                      <thead>
                                                      <tr>
                                                          <th>No.</th>
                                                          <th>Proses Bisnis</th>
                                                          <th>Keterangan</th>
                                                          <th>Aksi</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                      @php($no = 1)
                                                          @foreach($proses_bisnis as $probis)
                                                            @if(empty($probis->proses_bisnis))
                                                              <tr>
                                                                  <td>{{ $no++ }}</td>
                                                                  <td>{{ $probis->proses_bisnis }}</td>
                                                                  <td>{!! $probis->ket !!}</td>
                                                                  <td></td>
                                                                  <th>
                                                                      <form action="{{ url('Proses-Bisnis/'.$probis->id) }}" method="post">
                                                                        <!---bisa jg url ="{{ url('Jasa/'.$jasa->id.'/destroy') }}"-->
                                                                            @method('delete')
                                                                            {{ csrf_field() }}
                                                                          <a href="{{ url('Proses-Bisnis/'.$probis->id.'/edit') }}" type="button" class="btn btn-warning" title="ubah proses bisnis">ubah</a>
                                                                          <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data proses bisnis ini ... ?')" class="btn btn-danger" title="hapus proses bisnis jasa">hapus</button>
                                                                      </form>
                                                                  </th>
                                                              </tr>
                                                             @endif
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
                        <!--./tab-pane-2-->

                        <div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
                          <div class="row">
                              <div class="col-md-3" style="margin: 0">
                                  <a href="{{ url('SK-Jasa/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Syarat Ketentuan </a>
                              </div>
                          </div>
                          <p></p>
                          <div class="row">
                              @if(empty($skjasa))
                                  <div class="col-md-12"> <h4 align="center">Anda belum menambahkan data Syarat ketentuan jasa </h4></div>
                              @else
                              <div class="col-md-12">
                                  <div class="box box-success">
                                      <div class="box-header with-border">
                                          <h3 class="box-title">Daftar Syarat & Ketentuan Layanan Jasa</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body">
                                          <div class="row">
                                              <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                  <table id="example1" class="table table-bordered table-striped">
                                                      <thead>
                                                      <tr>
                                                          <th>No.</th>
                                                          <th>Syarat dan Ketentuan </th>
                                                          <th>Aksi</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                      @php($no = 1)
                                                          @foreach($skjasa as $skj)
                                                            @if(!empty($skj->sk))
                                                              <tr>
                                                                  <td>{{ $no++ }}</td>
                                                                  <td>@if($skj->jenis_sk == 0) Nota Service  @else  Nota Tagihan  @endif</td>
                                                                  <td>{!! $skj->sk !!}</td>

                                                                  <td></td>
                                                                  <th>
                                                                      <form action="{{ url('SK-Jasa/'.$skj->id) }}" method="post">
                                                                        <!---bisa jg url ="{{ url('Jasa/'.$jasa->id.'/destroy') }}"-->
                                                                            @method('delete')
                                                                            {{ csrf_field() }}
                                                                          <a href="{{ url('SK-Jasa/'.$skj->id.'/edit') }}" type="button" class="btn btn-warning" title="ubah Syarat Ketentuan layanan jasa">ubah</a>
                                                                          <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data ini ... ?')" class="btn btn-danger" title="hapus data SK">hapus</button>
                                                                      </form>
                                                                  </th>
                                                              </tr>
                                                             @endif
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
                        <!-- ./tab-3--->

                        <div class="tab-pane @if(Session::get('tab6') == 'tab6') active @else '' @endif" id="tab_6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Promo Jasa <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default"> Buat Promo Jasa </a> </h3>
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Promo</td>
                                            <td>Mulai</td>
                                            <td>Selesai</td>
                                            <td>Syarat</td>
                                            <td>Fasilitas</td>
                                            <td>Aksi</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($promo_jasa))
                                                @php($no=1)
                                                @foreach($promo_jasa as $pro_jas)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $pro_jas->nama_promo }}</td>
                                                        <td>{{ $pro_jas->tgl_dibuat }}</td>
                                                        <td>{{ $pro_jas->tgl_berlaku }}</td>
                                                        <td>{{ $pro_jas->syarat }}</td>
                                                        <td>{{ $pro_jas->fasilitas_promo }}</td>
                                                        <td>
                                                            <form action="{{ url('delete-promo/'.$pro_jas->id) }}" method="post">
                                                                {{ csrf_field() }}
                                                                <a href="#" onclick="onPromoEdit({{ $pro_jas->id }})" class="btn btn-warning">ubah</a>
                                                                <button type="submit" class="btn btn-danger">hapus</button>
                                                                <a href="#" onclick="window.location.href='{{ url('rincian-promo/'.$pro_jas->id) }}'" class="btn btn-default">Rincian Promo</a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-4-->
                        <!--tambah promo jasa--->
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Form Promo Jasa</h4>
                                    </div>
                                    <form action="{{ url('promo-crud') }}" method="post" id="form_promo">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="">
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nama Promo</label>
                                                        <input type="text" class="form-control" name="nm_promo" id="nama_promo" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenis Promo</label>
                                                        <select name="jenis_promo" class="form-control" id="jenis_promo" required>
                                                                <option value="1">Promo Jasa</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Dibuat</label>
                                                        <input type="date" class="form-control" name="tgl_awal_promo" id="tgl_awal_promo" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Berlaku s/d</label>
                                                        <input type="date" class="form-control" name="tgl_akhir_promo" id="tgl_akhir_promo" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Syarat</label>
                                                        <textarea name="syarat" class="form-control" id="syarat"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Fasilitas Promo</label>
                                                        <textarea name="fasilitas" class="form-control" id="fasilitas"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
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
    <script>
        onPromoEdit =function(kode){
            $.ajax({
                'url':'{{ url('promo-crud') }}/'+kode+'/edit',
                'type':'get',
                success:function(result){
                    console.log(result.nama_promo);
                    $('#nama_promo').val(result.nama_promo);
                    $('[name="tgl_awal_promo"]').val(result.tgl_dibuat);
                    $('[name="tgl_akhir_promo"]').val(result.tgl_berlaku);
                    $('[name="syarat"]').text(result.syarat);
                    $('[name="fasilitas"]').val(result.fasilitas_promo);
                    $('[name="_method"]').val('put');
                    $('#form_promo').attr('action','{{ url('promo-crud') }}/'+result.id);
                    $('#modal-default').modal('show')
                }
            })
        }

    </script>
@stop
