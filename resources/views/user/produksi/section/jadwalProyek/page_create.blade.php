@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jadwal Proyek
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Jadwal Proyek</h3>
                    </div>
                    <!-- /.box-header -->
                    @if(!empty(session('message_success')))
                        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                    @elseif(!empty(session('message_fail')))
                        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                    @endif
                    <!-- form start -->
                    <form role="form" action="{{ url('store-jadwal-proyek') }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Durasi</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa  fa-sort-numeric-asc"></i>
                                            </div>
                                            <input type="number" min="0" class="form-control pull-right" id="rangeBarang" name="durasi" placeholder="Masukan durasi pengerjaan proyek" >
                                        </div>
                                        <!-- /.input group -->
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai Dan Durasi</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" name="tglMulai_tglAkhir" id="reservation">
                                        </div>
                                        <small style="color: red">* Tidak Boleh Kosong</small>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <div class="form-group">
                                            <label for="exampleInputEmail1">Task Proyek dan Rincian</label>
                                                <select class="form-control select2" style="width: 100%;" name="id_taksAndId_rincian" required>
                                                    @if(empty($task_proyek))
                                                        <option>Ada Belum Memasukan Task Proyek dan Rincian Proyek Anda</option>
                                                    @else
                                                        @foreach($task_proyek as $taks)
                                                        <optgroup label="{{ $taks->nama_tugas }} - {{ $taks->proyek->spk->nm_spk }}">
                                                            @if(!empty($taks->rincian_tugas))
                                                                @foreach($taks->rincian_tugas as $rincian_tugas)
                                                                    <option value="{{ $taks->id }}-{{ $rincian_tugas->id }}"> {{ $rincian_tugas->rincian_tugas }}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
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

    <!-- date-range-picker -->
    <script src="{{ asset('component/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script>
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $('#reservation').daterangepicker({
           locale:{
               format: 'DD/MM/YYYY'
           }
        });

        $(function () {
            $('.select2').select2();
            //Date range picker
        });

    </script>

@stop