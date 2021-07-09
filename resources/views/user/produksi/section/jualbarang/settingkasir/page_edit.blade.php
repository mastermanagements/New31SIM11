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
            Ubah Setting Kas Kasir
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Setting Kas Kasir</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('setting-kasir/'.$data->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Karyawan</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_karyawan" required>
                                            @if(empty($karyawan))
                                                <option>Karyawan masih kosong</option>
                                            @else
                                                @foreach($karyawan as $value)
                                                    <option value="{{ $value->id }}" @if($data->kasir == $value->id) selected @endif>{{ $value->nama_ky }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Shift</label>
                                        <input type="number" min="0" class="form-control" value="{{ $data->shift }}" name="shift" id="rangeBarang" placeholder="Masukan Shift Ke..." >
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
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