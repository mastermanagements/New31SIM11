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
            Tambah Pembelian
        </h1> 
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Pembelian Barang</h3>
                        <h5 class="pull-right"><a href="{{ url('Pembelian')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                           <div class="col-md-12" style="margin-top:10px">
                               <form role="form" action="{{ url('Oder') }}" method="post" >
                                   {{ csrf_field() }}
                                <div class="col-md-6">
                                   <div class="form-group">
                                       <label>No. Order</label>&nbsp;<strong style="color: red">*</strong>
                                       <input type="text" name="no_order" class="form-control" value="{{ $no_surat }}" required>
                                   </div>
                                   <div class="form-group">
                                        <label>Tanggal Pembelian</label>&nbsp;<strong style="color: red">*</strong>
                                       <div class="input-group date">
                                           <div class="input-group-addon">
                                               <i class="fa fa-calendar"></i>
                                           </div>
                                           <input type="text" name="tgl_order" class="form-control" id="datepicker" value="{{ date('d-m-Y') }}" required>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label>No. Pesanan Pembelian</label>
                                       <select class="form-control select2" name="id_po" style="width: 100%"
                                            {{-- onchange="if(confirm('Apakah anda akan mengambil data barang penawaran dari kode surat ini ... ?')){ return window.location.href='{{ url('rincian-penawaran') }}/'+$(this).val() }else{ alert('Data Barang tidak dapat diambil') }" --}}
                                            >
                                           @if(!empty($pesana_pembelian))
                                               <option value="0">Pilihan pesananan pembelian</option>
                                               @foreach($pesana_pembelian as $data)
                                                     <option value="{{ $data->id }}">{{ $data->no_po }}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Supplier</label>&nbsp;<strong style="color: red">*</strong>
                                       <select class="form-control select2" name="id_supplier"  required style="width: 100%">
                                           @if(empty($supplier))
                                               Isi dulu data supplier
                                               @else
                                                 @foreach($supplier as $data)
                                                       <option value="{{ $data->id }}">{{ $data->nama_suplier }}</option>
                                                 @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Tanggal Barang Tiba</label>&nbsp;<strong style="color: red">*</strong>
                                       <div class="input-group date">
                                           <div class="input-group-addon">
                                               <i class="fa fa-calendar"></i>
                                           </div>
                                       <input type="text" name="tgl_tiba" class="form-control" id="datepicker2" required>
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
        /*$('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="hpp"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="hpp"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })*/
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
