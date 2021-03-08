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
            Rincian Bayar
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rincian Bayar</h3>
                    </div>
                    <div class="box-body">
                       <div class="row">
                           <div class="col-md-12">
                               <table>
                                   <tr>
                                       <th>No Transaksi</th>
                                       <th>:</th>
                                       <th>{{ $data->no_order }}</th>
                                   </tr>
                                   <tr>
                                       <th>Suplier</th>
                                       <th>:</th>
                                       <th>{{ $data->linkToSuppliers->nama_suplier }}</th>
                                   </tr>
                                   <tr>
                                       <th>Tgl Transaksi</th>
                                       <th>:</th>
                                       <th>{{ date('d-m-Y', strtotime($data->tgl_order)) }}</th>
                                   </tr>
                                   <tr>
                                       <th>Tota Belanja</th>
                                       <th>:</th>
                                       <th>{{ number_format($data->linkToMannyBayar->sum('jumlah_bayar'),2,',','.') }}</th>
                                   </tr>
                               </table>
                           </div>
                           <div class="col-md-12">
                                <table class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Tgl bayar</td>
                                            <td>Bank & Rek Asal</td>
                                            <td>Bank & Rek Tujuan</td>
                                            <td>Jumlah Bayar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($data->linkToMannyBayar))
                                            @php($i=1)
                                            @php($total = 0)
                                            @foreach($data->linkToMannyBayar as $n_data)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $n_data->tgl_bayar }}</td>
                                                <td>{{ $n_data->bank_asal }}, {{ $n_data->rek_asal }}</td>
                                                <td>{{ $n_data->bank_tujuan }}, {{ $n_data->no_rek_tujuan }}</td>
                                                <td>{{ number_format($n_data->jumlah_bayar,2,',','.') }} @php($total+=$n_data->jumlah_bayar)</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td colspan="3">Total</td>
                                                <td>{{ number_format($total,2,',','.') }}</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                           </div>
                       </div>
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
        $('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="hpp"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="hpp"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })
    </script>

@stop