@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>

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

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Jasa</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('Jasa') }}" method="post" enctype="multipart/form-data">

                        <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Layanan</label>
                                  <input type="text" name="nm_layanan" class="form-control" placeholder="nama layanan" required/>
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Per</label>
                                  <input type="number" name="peritem" class="form-control" placeholder="misal: per 1 kg, tulis: 1" required/>
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Satuan</label>
                                <select class="form-control select2" style="width: 100%;" name="id_satuan" required >
                                        @foreach($satuan as $value)
                                            <option value="{{ $value->id }}">{{ $value->satuan }}</option>
                                        @endforeach
                                </select>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lama Pengerjaan</label>
                                <input type="number" min="0" name="waktu_kerja" class="form-control" placeholder="Lama waktu pengerjaan layanan, misal: 3 hari, Tulis: 3" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Satuan Waktu pengerjaan</label>
                              <select class="form-control select2" style="width: 100%;" name="satuan_waktu" required>
                                      @foreach($satuan as $value)
                                          <option value="{{ $value->id }}">{{ $value->satuan }}</option>
                                      @endforeach
                              </select>
                              <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Waktu Penyelesaian</label>
                                <div class="form-group">
                                    @foreach($waktu_selesai as $key => $value)
                                        <label>
                                            <input type="radio"  name="waktu_selesai" class="minimal" value="{{ $key }}" required>
                                            {{ $value }}
                                        </label>
                                    @endforeach
                                    <p></p>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Biaya</label>
                                <input type="number" min="0" name="biaya" class="form-control" placeholder="Biaya Layanan" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea name="ket" class="form-control"></textarea>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          {{csrf_field()}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        window.onload = function() {
            CKEDITOR.replace( 'ket',{
                height: 100
            } );
        };

        $(function () {
            $('.select2').select2()
        });


    </script>

@stop
