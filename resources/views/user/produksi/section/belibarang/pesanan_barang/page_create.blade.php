@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pesanan Pembelian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Pesanan Pembelian</h3>
                        <h5 class="pull-right"><a href="{{ url('Pembelian')}}">Kembali ke Halaman utama</a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                           <div class="col-md-12" style="margin-top:10px">
                               <form role="form" action="{{ url('pesanan-pembelian') }}" method="post" >
                                   {{ csrf_field() }}
                                  <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No. PO</label>&nbsp;<strong style="color: red">*</strong>
                                           <input type="text" name="no_po" class="form-control" value="{{ $no_surat }}" required>
                                       </div>
                                       <div class="form-group">
                                           <label>Tanggal. PO</label>&nbsp;<strong style="color: red">*</strong>
                                           <div class="input-group date">
                                               <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                               </div>
                                               <input type="text" name="tgl_po" class="form-control" id="datepicker" value="{{ date('d-m-Y') }}" required>
                                           </div>
                                       </div>
                                    </div>
                                       <!--<div class="form-group">
                                           <label>Penawaran Pembelian</label>
                                           <select class="form-control select2" name="id_tawar_beli" style="width: 100%" onchange="if(confirm('Apakah anda akan mengambil data barang penawaran dari kode surat ini ... ?')){ return window.location.href='{{ url('rincian-penawaran') }}/'+$(this).val() }else{ alert('Data Barang tidak dapat diambil') }">
                                               @if(!empty($penawaran_pembelian))
                                                   <option value="0">Pilihan Penawaran pembelian</option>
                                                   @foreach($penawaran_pembelian as $data)
                                                         <option value="{{ $data->id }}">{{ $data->no_tawar }}</option>
                                                   @endforeach
                                               @endif
                                           </select>
                                       </div>-->
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Supplier</label>&nbsp;<strong style="color: red">*</strong>
                                           <select class="form-control select2" name="id_supplier" style="width: 100%" required>
                                               @if(empty($supplier))
                                                   isi dulu data supplier !!
                                                   @else
                                                       @foreach($supplier as $data)
                                                             <option value="{{ $data->id }}">{{ $data->nama_suplier }} </option>
                                                       @endforeach
                                               @endif
                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <label>Tanggal Barang Dikirim</label>
                                           <div class="input-group date">
                                               <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                               </div>
                                           <input type="text" name="tgl_dikirim" class="form-control" id="datepicker2">
                                         </div>
                                       </div>
                                     </div>
                                       <div class="col-md-12">
                                           <div class="box-footer">
                                           <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                                           </div>
                                           <div class="form-group">
                                               <button class="btn btn-primary">Simpan</button>
                                           </div>
                                        </div>
                                     </div>
                                     <!-- /.box-body -->
                               </form>
                           </div>
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
        $('#datepicker2').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

    </script>

@stop
