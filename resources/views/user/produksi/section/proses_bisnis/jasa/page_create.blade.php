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
            Proses Bisnis Jasa
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Proses Bisnis Jasa</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('Proses-Bisnis') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                              <div class="form-group">
                                        <label>Banyaknya Proses Bisnis Jasa yang akan di input</label>
                                        <input type="number" min="0" class="form-control pull-right" id="rangeProsesBisnisJasa" placeholder="Masukan jumlah proses bisnis jasa di perusahaan anda" >

                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
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

            $('#rangeProsesBisnisJasa').change(function () {
                var htmls ="";
                var i = 0;
                while(i < $(this).val()){
                    htmls+="\n" +

                        "\n" +
                        "<div class=\"col-md-6\">\n" +
                        "    <div class=\"form-group\">\n" +
                        "        <label for=\"exampleInputEmail1\">Proses Bisnis</label>\n" +
                        "        <input type=\"text\" name=\"proses_bisnis[]\" class=\"form-control\" placeholder=\"Proses Bisnis Jasa\" />\n" +
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
