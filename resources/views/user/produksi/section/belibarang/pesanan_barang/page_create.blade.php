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
                        <h3 class="box-title">Pesanan Pembelian</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                           <div class="col-md-12" style="margin-top:10px">
                               <form role="form" action="{{ url('pesanan-pembelian') }}" method="post" >
                                   {{ csrf_field() }}
                                   <div class="form-group">
                                       <label>No. PO</label>
                                       <input type="text" name="no_po" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Tanggal. PO</label>
                                       <input type="date" name="tgl_po" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Penawaran Pembelian</label>
                                       <select class="form-control select2" name="id_tawar_beli" style="width: 100%">
                                           @if(!empty($penawaran_pembelian))
                                               <option>Pilihan Penawaran pembelian</option>
                                               @foreach($penawaran_pembelian as $data)
                                                     <option value="{{ $data->id }}">{{ $data->no_tawar }}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Supplier</label>
                                       <select class="form-control select2" name="id_supplier" style="width: 100%">
                                           @if(!empty($supplier))
                                               <option>Pilihan supplier</option>
                                               @foreach($supplier as $data)
                                                     <option value="{{ $data->id }}">{{ $data->nama_suplier }}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Tanggal Dikirim</label>
                                       <input type="date" name="tgl_dikirim" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                       <button class="btn btn-primary">Simpan</button>
                                   </div>
                               </form>
                           </div>
                            <div class="col-md-12">

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
        $('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="hpp"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="hpp"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })
    </script>

@stop