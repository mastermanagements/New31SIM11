@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengaturan Cuti
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-8">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Pengaturan Cuti</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-pengaturan-cuti/'. $pengaturan_cuti->id) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Nama Cuti</label>
                                <input type="text" id="alasan" class="form-control" name="nm_cuti" value="{{ $pengaturan_cuti->nm_cuti }}">
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pengurangan Cuti</label>
                                @foreach($pengurangan_cuti as $key=>$value)
                                    <p>
                                        <input type="radio" name="pengurang_cuti" class="minimal" value="{{ $key }}" @if($key==$pengaturan_cuti->pengurang_cuti) checked @endif required> {{ $value }}
                                    </p>
                                @endforeach
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Akumulasi Cuti</label>
                                @foreach($akumulasi_cuti as $key=>$value)
                                    <p>
                                        <input type="radio" name="akumulasi_cuti" class="minimal" value="{{ $key }}"  @if($key==$pengaturan_cuti->akumulasi_cuti) checked @endif required> {{ $value }}
                                    </p>
                                @endforeach
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                       </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
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
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>


        //Initialize Select2 Elements
        $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            });

            $('.select2').select2()

        })
    </script>
@stop