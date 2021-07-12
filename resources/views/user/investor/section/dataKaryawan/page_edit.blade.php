@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Investor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-7">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Investor</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-investors/'.$data->id) }}" method="post">
                        <input type="hidden" name="_method" value="put">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIK</label>
                                <input type="text" name="nik" class="form-control" id="exampleInputEmail1" value="{{ $data->nik }}" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Investor</label>
                                <input type="text" name="nm_investor" class="form-control" value="{{ $data->nm_investor }}" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password" class="form-control" value="{{ $data->password }}"  id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                <input type="text" name="tmp_lahir" class="form-control" value="{{ $data->tmp_lahir }}" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="{{ date('d-m-Y', strtotime($data->tgl_lahir)) }}" id="datepicker"  name="tgl_lahir" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Kelamin</label>
                                <div class="form-group">
                                    @foreach($jenkel as $value)
                                        <label>
                                            <input type="radio"  name="jenis_kel" class="minimal" @if($data->jenis_kel == $value) checked @endif value="{{ $value }}" required>
                                            {{ $value." " }}
                                        </label>
                                     @endforeach
                                    <p></p>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Agama</label>
                                <div class="form-group">
                                    @foreach($agama as $value)
                                        <label>
                                            <input type="radio"  name="agama" class="minimal" @if($data->agama == $value) checked @endif value="{{ $value }}" required>
                                            {{ $value." " }}
                                        </label>
                                     @endforeach
                                    <p></p>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status Perkawinan</label>
                                <div class="form-group">
                                    @foreach($status_perkawinan as $value)
                                        <label>
                                            <input type="radio"  name="status_perkawinan" @if($data->status_perkawinan == $value) checked @endif class="minimal" value="{{ $value }}" required>
                                            {{ $value." " }}
                                        </label>
                                     @endforeach
                                    <p></p>
                                    <small style="color: red">* Tidak Boleh Kosong</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" value="{{ $data->pekerjaan }}" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Bank</label>
                                <input type="text" name="nm_bank" class="form-control" value="{{ $data->nm_bank }}"  id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Rekening Bank</label>
                                <input type="text" name="no_rek" class="form-control" value="{{ $data->no_rek }}" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                                <input type="text" name="pend_akhir" class="form-control" value="{{ $data->pend_akhir }}" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Cabang Bank.</label>
                                <input type="text" name="kantor_cabang" class="form-control" value="{{ $data->kantor_cabang }}" id="exampleInputEmail1" >
                            </div><div class="form-group">
                                <label for="exampleInputEmail1">No.Rekening Bank Cabang</label>
                                <input type="text" name="no_rek_bank" class="form-control" value="{{ $data->no_rek_bank }}" id="exampleInputEmail1" >
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
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });

        $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })

        })

        update=function (id) {
            $.ajax({
                url: "{{ url('edit-alokasi-gaji') }}/"+id,
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    $('[name="thn"]').val(result.thn);
                    $('[name="persen"]').val(result.persen);
                    $('[name="jumlah"]').val(result.jumlah);
                    $('[name="id"]').val(result.id);
                    $('#formulir').attr('action', '{{ url('update-alokasi-gaji') }}');
                }
            })
        }
    </script>
@stop
