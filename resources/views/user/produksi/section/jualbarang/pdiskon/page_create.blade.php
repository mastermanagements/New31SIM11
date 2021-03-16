@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Diskon
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Diskon</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <form role="form" action="{{ url('p-diskon') }}" method="post" enctype="multipart/form-data">
                          <div class="row">
                              {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis Diskon</label>
                                        <input type="radio" name="jenis_diskon" value="0" required> Berdasarkan Jumlah Pembelian
                                        <input type="radio" name="jenis_diskon" value="1"> Diskon Member
                                    </div>
                                    <div class="form-group">
                                        <label>Grup Klien</label>
                                        <select class="select2 form-control" name="id_group" required>
                                            <option disabled>Pilih Grup klien</option>
                                            @if(!empty($group_klien))
                                                @foreach($group_klien as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_group }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Maks Beli</label>
                                        <input type="number" class="form-control" name="jumlah_maks_beli">
                                    </div>
                                    <div class="form-group">
                                        <label>Diskon Persen</label>
                                        <input type="number" class="form-control" name="diskon_persen">
                                    </div>
                                    <div class="form-group">
                                        <label>Diskon Nominal</label>
                                        <input type="number" class="form-control" name="diskon_nominal">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
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

                $('#datepicker3').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

    </script>

@stop