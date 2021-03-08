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
                        <h3 class="box-title">Tambah Pembelian</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                           <div class="col-md-12" style="margin-top:10px">
                               <form role="form" action="{{ url('Oder') }}" method="post" >
                                   {{ csrf_field() }}
                                   <div class="form-group">
                                       <label>No. Order</label>
                                       <input type="text" name="no_order" class="form-control" value="{{ $no_surat }}" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Tanggal. PO</label>
                                       <input type="date" name="tgl_order" class="form-control" required>
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
                                   <div class="form-group">
                                       <label>Supplier</label>
                                       <select class="form-control select2" name="id_supplier"  required style="width: 100%">
                                           @if(!empty($supplier))
                                               <option>Pilihan supplier</option>
                                               @foreach($supplier as $data)
                                                     <option value="{{ $data->id }}">{{ $data->nama_suplier }}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Tanggal Barang tiba</label>
                                       <input type="date" name="tgl_tiba" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                       <button class="btn btn-primary">Simpan</button>
                                   </div>
                                   {{--<div class="row">--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Diskon Tambahan</label>--}}
                                               {{--<input type="number" name="diskon_tambahan" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Pajak</label>--}}
                                               {{--<input type="number" name="pajak" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}
                                   {{--<div class="row">--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Uang Muka</label>--}}
                                               {{--<input type="number" name="uang_muka" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                       {{--<div class="col-md-6">--}}
                                           {{--<div class="form-group">--}}
                                               {{--<label>Kurang Bayar</label>--}}
                                               {{--<input type="number" name="kurang_bayar" class="form-control" required>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}

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