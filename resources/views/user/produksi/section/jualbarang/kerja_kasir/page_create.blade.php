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
            Masuk Kerja Kasir
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Masuk kerja kasir</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('kerja-kasir') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal</label>
                                        <input type="text" name="tgl_mulai" value="{{ $current_date }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jam</label>
                                        <input type="text" name="jam_mulai" value="{{ $current_time }}" class="form-control " readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Karyawan</label>
                                        <input type="hidden" name="id_shift_kasir" value="{{ $data_shift->id }}" class="form-control" readonly>
                                        <input type="hidden" name="penerima" value="{{ $data_shift->kasir }}" class="form-control" readonly>
                                        <input type="text" value="{{ $data_shift->linkToKaryawan->nama_ky }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Shift</label>
                                        <input type="number" min="0" class="form-control" value="{{ $data_shift->shift }}" readonly>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Akun Kas Yang Dipegang</label>
                                    </div>
                                    @if(!empty($data_shift->linkToSettingAkunKasir))
                                        @foreach($data_shift->linkToSettingAkunKasir as $data_akun)
                                            <div class="form-group">
                                                <label>{{ $data_akun->linkToAkunAktif->nm_akun_aktif }}</label>
                                                <input type="text" class="form-control" readonly>
                                                <!-- /.input group -->
                                                <small style="color: red">* Tidak Boleh Kosong</small>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

        $(function () {


            $('#rangeBarang').change(function () {
                var htmls ="";
                var i = 0;
                while(i < $(this).val()){
                    htmls+="\n" +
                        "\n" +
                        "<div class=\"col-md-6\">\n" +
                        "    <div class=\"form-group\">\n" +
                        "        <label for=\"exampleInputEmail1\">Barang</label>\n" +
                        "        <select class=\"form-control select2\" style=\"width: 100%;\" name=\"id_barang[]\" required>\n" +
                        "            @if(empty($barangs))\n" +
                        "                <option>Barang masih kosong</option>\n" +
                        "            @else\n" +
                        "                @foreach($barangs as $value)\n" +
                        "                    <option value=\"{{ $value->id }}\">{{ $value->nm_barang }}</option>\n" +
                        "                @endforeach\n" +
                        "            @endif\n" +
                        "        </select>\n" +
                        "        <small style=\"color: red\">* Tidak Boleh Kosong</small>\n" +
                        "    </div>\n" +
                        "</div>\n" +
                        "\n" +

                        "\n" +
                        "<div class=\"col-md-6\">\n" +
                        "    <div class=\"form-group\">\n" +
                        "        <label for=\"exampleInputEmail1\">Jumlah Barang</label>\n" +
                        "        <input type=\"number\" min=\"0\" name=\"jumlah_barang[]\" class=\"form-control\" placeholder=\"Jumlah Barang\" />\n" +
                        "        <small style=\"color: red\">* Tidak Boleh kosong</small>\n" +
                        "    </div>\n" +
                        "</div>";
                    i++;
                }
                $('#form-vertical').html(htmls);
                $('.select2').select2()
            })
        });

    </script>

@stop