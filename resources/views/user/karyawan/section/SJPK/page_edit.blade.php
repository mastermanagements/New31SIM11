@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop



@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Strategi Jangka Pendek
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Strategi</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('update-sjpk/'.$data_sjpk->id) }}" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Periode</label>
                                    <input type="number" min="1990" max="3000" name="periode" class="form-control" value="{{ $data_sjpk->periode }}" id="exampleInputEmail1" placeholder="Contoh: 2017,2018,2019, dll" required>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pilih nama bagian dan divisi</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_divisi" required>
                                        @foreach($data_bagian as $value)
                                            <optgroup label="{{ $value->nm_bagian }}" name="id_bagian" value="{{ $value->id }}">
                                                @foreach($value->getDevisi as $divisi)
                                                    <option value="{{ $divisi->id }}" @if($divisi->id == $data_sjpk->id_divisi_p) selected @endif>{{ $divisi->nm_devisi }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <small style="color: red" id="notify"></small>
                                    <input type="hidden" name="id_sjpk" value="{{ $data_sjpk->id_sjpg }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukan Strategi Jangka Pendek Anda</label>
                                    <textarea class="form-control" placeholder="Masukan Strategi Anda" name="isi_spjd" id="isi_spjd" required>
                                        {!! $data_sjpk->isi_spjd !!}
                                    </textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
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
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });
        window.onload = function() {
            CKEDITOR.replace( 'isi_spjd',{
                height: 600
            } );
        };

        //Initialize Select2 Elements
        //        $(function () {
        //
        //            //iCheck for checkbox and radio inputs
        //            $('input[type="radio"].minimal').iCheck({
        //                checkboxClass: 'icheckbox_minimal-blue',
        //                radioClass   : 'iradio_minimal-blue'
        //            })
        //
        //        })
    </script>
@stop