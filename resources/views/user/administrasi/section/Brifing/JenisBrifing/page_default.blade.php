@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jenis Rapat
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <button type="button" data-toggle="modal" data-target="#modal-tambah-jenis-surat" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Jenis Rapat</button>
        <p></p>
        <div class="row">

            <p></p>

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Jenis Rapat</h3>
                            </div>

                            <div class="box-body">
                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bagian Perusahaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($jenis_brifing as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->jenis_rapat }}</td>
                                            <td>
                                                <form action="{{ url('delete-jenis-rapat/'. $value->id) }}" method="post">
                                                    <input type="hidden" name="_method" value="put"/>
                                                    {{ csrf_field() }}
                                                    <button type="button" name="btnUbah" value="{{ $value->id }}" class="btn btn-warning"><i class="fa fa-pencil"></i> ubah</button>
                                                    <button type="submit"  class="btn btn-danger" onclick="return confirm('apakah anda akan mengahapus data ini ...?')"><i class="fa fa-eraser"></i> hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
    </section>
    <!-- /.content -->
</div>
    @include('user.administrasi.section.Brifing.modal.modal')
@stop

@section('plugins')
    <!-- iCheck 1.0.1 -->

    <script>

        $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })

        })

        $(document).ready(function () {
            $('[name="btnUbah"]').click(function () {
                $.ajax({
                    url : "{{ url('edit-jenis-rapat') }}/"+ $(this).val(),
                    dataType: 'json',
                    success : function (result) {
                        $('[name="jenis_rapat_ubah"]').val(result.jenis_rapat);
                        $('[name="id"]').val(result.id);
                        $('#modal-ubah-jenis-surat').modal('show');
                    }
                })
            })
        })
    </script>
@stop