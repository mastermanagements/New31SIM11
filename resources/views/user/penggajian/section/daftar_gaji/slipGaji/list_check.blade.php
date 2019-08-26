@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Daftar Slip Gaji
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 2%">
                    <button type="button" class="btn btn-default bg-maroon" data-toggle="modal" data-target="#modal-slip">tambah Slip</button>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Karyawan</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Periode </th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                    @foreach($slip_gaji as $data_slip)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ date('d-m-Y', strtotime($data_slip->periode)) }}</td>
                                            <td>
                                                <form action="{{ url('delete-slip-gaji/'.$data_slip->id) }}" method="post">
                                                    <input type="hidden" name="_method" value="put">
                                                    {{ csrf_field() }}
                                                    <a href="{{ url('item-gaji/'. $data_slip->id) }}" class="btn btn-success">Isi Slip ini </a>
                                                    <button type="button" onclick="update('{{ $data_slip->id }}')" class="btn btn-warning">Ubah Slip</button>
                                                    <button type="submit" onclick="return confirm('Apakah anda akan menghapus slip ini..?')" class="btn btn-danger">Hapus Slip</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


            </div>

        </section>
        <!-- /.content -->
    </div>
    @include('user.penggajian.section.daftar_gaji.slipGaji.modal')

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-slip-gaji') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="periode"]').val(result.periode);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-slip-gaji') }}');
                  $('#modal-slip').modal('show');
              }
          })
       }
    </script>
@stop