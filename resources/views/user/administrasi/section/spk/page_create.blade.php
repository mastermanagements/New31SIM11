@extends('user.administrasi.master_user')

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
            SPK (Surat Perintah Kerja/Kontrak)
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir SPK</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-spk') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Spk</label>
                                <input name="no_spk" class="form-control" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label>Tanggal SPK</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal SPK" name="tgl_spk" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Klien</label>
                                <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                    @if(empty($klien))
                                        <option>Klien Masih Kosong</option>
                                    @else
                                        @foreach($klien as $value)
                                            <option value="{{ $value->id }}">{{ $value->nm_klien }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama SPK</label>
                                <input name="nm_spk" class="form-control" required/>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Mulai</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Mulai Kontrak" name="tgl_mulai" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker2" placeholder="Tanggal Akhir Kontrak" name="tgl_akhir" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <textarea name="alamat" class="form-control" required></textarea>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Provinsi</label>
                                <select class="form-control select2" style="width: 100%;" name="id_prov" required>
                                    @if(empty($provinsi))
                                        <option>Provinsi Masih Kosong</option>
                                    @else
                                        @foreach($provinsi as $value)
                                            <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kabupaten</label>
                                <select class="form-control select2" style="width: 100%;" name="id_kab" required>

                                </select>
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $('#datepicker1').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $('#datepicker2').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $(function () {
            $('.select2').select2()
        });

        $('[name="id_prov"]').change(function () {
            $.ajax({
                url:"{{ url('GlobalKabupaten') }}/" + $(this).val(),
                dataType: "json",
                success: function (result) {
                    var option="<option>Pilih Kabupaten</option>";
                    $.each(result, function (id, val) {
                        option+="<option value="+val.id+">"+val.nama_kabupaten+"</option>";
                    });
                    $('[name="id_kab"]').html(option);
                }
            })
        })
    </script>
@stop