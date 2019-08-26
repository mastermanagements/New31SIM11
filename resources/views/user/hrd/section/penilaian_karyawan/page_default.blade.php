@extends('user.hrd.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Penilaian Karyawan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="box-body">
                <div class="row">
                    <a href="{{ url('Performance-Appraisal') }}">
                        <div class="col-md-5 bg-primary btn " >
                            <div class="row">
                                <div class="6">
                                    <img src="https://image.flaticon.com/icons/png/512/114/114903.png" style="height:200px">
                                </div>
                                <div class="6">
                                    <p style="font-size: xx-large">Performance Appraisal</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="col-sm-1"></div>
                    <a href="#">
                        <div class="col-md-5 bg-primary btn ">
                            <div class="row">
                                <div class="6">
                                    <img src="https://image.flaticon.com/icons/png/512/114/114903.png" style="height:200px">
                                </div>
                                <div class="6">
                                    <p style="font-size: xx-large">Kompetensi</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    @include('user.hrd.section.loker.include.modal')
@stop

@section('plugins')
    <script>
        setID = function(id){
            $('[name="idLoker"]').val(id);
        }
    </script>
@stop