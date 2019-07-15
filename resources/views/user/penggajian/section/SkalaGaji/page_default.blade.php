@extends('user.penggajian.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li ><a href="#tab_1-1" data-toggle="tab">Klasifikasi Gaji</a></li>
                        <li class="active" ><a href="#tab_2-2" data-toggle="tab">Grade/Tingkatan</a></li>
                        <li ><a href="#tab_3-3" data-toggle="tab">Daftar Skala Gaji</a></li>
                        <li class="pull-left header"><i class="fa fa-th"></i> Skala Gaji</li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane " id="tab_1-1">
                            @include('user.penggajian.section.SkalaGaji.klasifikasi_gaji.page')
                        </div>
                        <div class="tab-pane active " id="tab_2-2">
                            @include('user.penggajian.section.SkalaGaji.grade_gaji.page')
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane " id="tab_3-3">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Posisi</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2">Grader</th>
                                    <th colspan="{{ $klasifikasiGaji->count('id') }}">Skala Gaji</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    @foreach($klasifikasiGaji as $klass)
                                        <th>{{ $klass->klasifikas }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @php($no=1)
                                @foreach($jabatan as $jabatan)
                                    <form action="#" method="post">
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $jabatan->nm_jabatan }}</td>
                                        <td>{{ number_format($jabatan->skorBaseItem->sum('skor_sub_cf'),2,'.',',') }}</td>
                                        <td>1</td>
                                        @foreach($klasifikasiGaji as $klass)
                                            <td><input type="number" min="0" max="{{ $klass->besar_gaji }}" class="form-control" name="besaran_gaji"></td>
                                        @endforeach
                                        <td><button class="btn btn-success">Simpan</button></td>
                                    </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $('.select2').select2()
        update_klasifikasi = function (id) {
            $.ajax({
                'url': '{{ url('edit-klasifikasi-gaji') }}/'+id,
                'dataType': 'json',
                success: function (result) {
                    console.log(result);
                    $('[name="klasifikasi"]').val(result.klasifikas);
                    $('[name="besar_gaji"]').val(result.besar_gaji);
                    $('[name="id"]').val(result.id);
                    $('#formulir').attr('action','{{ url('update-klasifikasi-gaji') }}');
                }
            })
        }
        update_grade = function (id) {
            $.ajax({
                'url': '{{ url('edit-grade-gaji') }}/'+id,
                'dataType': 'json',
                success: function (result) {
                    console.log(result);
                    $('[name="grader"]').val(result.grade);
                    $('[name="id_grader"]').val(result.id);
                    $('#formulir_grade').attr('action','{{ url('update-grader-gaji') }}');
                }
            })
        }
    </script>
@stop