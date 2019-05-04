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
            Penjualan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Penjualan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-penjualan') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Jual </label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Barang dibeli" name="tgl_jual" >
                                        </div>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>

                                    <div class="form-group">
                                            <label for="exampleInputEmail1">Klien</label>
                                            <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                                @if(empty($klien))
                                                    <option>Klien masih kosong</option>
                                                @else
                                                    @foreach($klien as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nm_klien }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>


                                    <div class="form-group">
                                        <label>Banyak Penjualan</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="number" min="0" class="form-control pull-right" id="rangeBarang" placeholder="Masukan banyak barang anda" >
                                        </div>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>


                                </div>
                                <div class="forms">
                                    <div id="form-vertical">
                                      {{--@include('user.produksi.section.jualbarang.form_vertical')--}}
                                    </div>
                                    <div id="form-dup">

                                    </div>
                                </div>
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