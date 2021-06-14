@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Proses Bisnis Manufaktur
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Proses Bisnis Manufaktur</h3>
                        <h5 class="pull-right"><a href="{{ url('manufaktur')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('proses-bisnis') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-group">
                                        <label>Banyaknya Proses Bisnis pada SOP yang akan di input</label>
                                        <input type="number" min="0" class="form-control pull-right" id="rangeProsesBisnisManufaktur" placeholder="Masukan jumlah proses bisnis manufaktur pada SOP terpilih" >

                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                            </div>
                          <br><br>
                          </div>
                            <div class="forms">
                                <div id="form-vertical">
                                </div>

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
    $(function () {

            $('#rangeProsesBisnisManufaktur').change(function () {
                var htmls ="";
                var i = 0;
                while(i < $(this).val()){
                    htmls+="\n" +
                        "\n" +
                        "\<br>\n" +
                        "\<br>\n" +
                        "\<br>\n" +
                        "<div class=\"box-header with-border\">\n" +
                            "<h3 class=\"box-title\">Isi Proses Bisnis Berikut:</h3>\n" +
                        "</div>\n" +
                        "\n" +

                        "\n" +
                        "<div class=\"col-md-6\">\n" +
                        "    <div class=\"form-group\">\n" +
                        "        <label for=\"exampleInputEmail1\">Proses Bisnis</label>\n" +
                        "        <input type=\"text\" name=\"proses_bisnis[]\" class=\"form-control\" placeholder=\"Proses Bisnis Manufaktur\" />\n" +

                        "        <input type=\"hidden\" name=\"id_sop_pro[]\" class=\"form-control\" value=\"{{ $sop_produksi->id }}\" />\n" +
                        "        <small style=\"color: red\">* Tidak Boleh kosong</small>\n" +
                        "    </div>\n" +
                        "</div>\n" +
                        "\n" +

                        "\n" +
                        "<div class=\"col-md-6\">\n" +
                        "    <div class=\"form-group\">\n" +
                        "        <label for=\"exampleInputEmail1\">Keterangan</label>\n" +
                        "        <textarea name=\"ket[]\" class=\"form-control\" placeholder=\"Keterangan\" />\n" +
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
