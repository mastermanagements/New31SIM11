@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pembayaran Pesanan Pembelian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Pembayaran</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                            <form action="{{ url($url) }}" method="POST" >
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="id_po" @if(!empty($id_po)) value="{{ $id_po }}" @endif>
                                            <input type="hidden" name="id_order">
                                            <input type="hidden" name="id_return">
                                            <label>Jenis Pembayaran</label>
                                            <input type="hidden" name="jenis_bayar" value="{{ $jenis_pembayaran }}">
                                            <input type="text" class="form-control"  value="{{ $label_jenis_pembayaran }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>No Transaksi</label>
                                            <input type="text" class="form-control" value="{{ $data->no_po }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <input type="text" class="form-control" value="{{ $data->linkToSupplier->nama_suplier }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Transaksi</label>
                                            <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($data->tgl_po)) }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Bayar </label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker" name="tgl_bayar" >
                                            </div>
                                            <!-- /.input group -->
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Bank Asal</label>
                                          <select class="form-control select2" style="width: 100%;" name="bank_asal" required>
                                              @if(empty($rek_asal))
                                                  <option>Data Rekening perusahaan masih kosong</option>
                                              @else
                                                  @foreach($rek_asal as $value)
                                                      <option value="{{ $value->id }}">{{$value->nama_bank}}, No. Rek: {{$value->no_rek}}, A.N. {{ $value->atas_nama }}</option>
                                                  @endforeach
                                              @endif
                                          </select>
                                          <small style="color: red">* Tidak Boleh Kosong</small>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Bank Tujuan</label>
                                          <select class="form-control select2" style="width: 100%;" name="bank_tujuan" required>
                                              @if(empty($rek_tujuan))
                                                  <option>Data Rekening Supplier masih kosong</option>
                                              @else
                                                  @foreach($rek_tujuan as $value)
                                                      <option value="{{ $value->id }}">{{$value->nama_bank}}, No. Rek: {{$value->no_rek}}, A.N. {{ $value->atas_nama }}</option>
                                                  @endforeach
                                              @endif
                                          </select>
                                          <small style="color: red">* Tidak Boleh Kosong</small>
                                      </div>
                                      <div class="form-group">
                                          <label>Metode Bayar</label>
                                          <select class="form-control" name="metode_bayar" required>
                                              <option disabled>Pililah Metode Pembayaran</option>
                                              @foreach($metode_bayar as $key=> $datas)
                                                  <option value="{{ $key }}">{{ $datas }}</option>
                                              @endforeach
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Jumlah Bayar</label>
                                          <input type="text" name="jumlah_bayar" value="{{  rupiahView($data->dp_po) }}" class="form-control" readonly required/>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">simpan</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
          });
    </script>

@stop
