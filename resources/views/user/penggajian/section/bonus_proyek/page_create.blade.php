@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Daftar Gaji Karyawan {{ $data->nama_ky }}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
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

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form-gaji" >Tambah Data Gaji</button>
                            <p></p>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Periode </th>
                                    <th>Besar Gaji</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @if(!empty($daftar_gaji))
                                    @foreach($daftar_gaji as $data_ky)
                                        <tr>
                                            <td>{{ $data_ky['no'] }}</td>
                                            <td>{{ $data_ky['periode'] }}</td>
                                            <td>{{ number_format($data_ky['besar_gaji'],2,',','.') }}</td>
                                            <td>{{ $data_ky['ket'] }}</td>
                                            <td>
                                                <form action="{{ url('update-status-gaji/'.$data_ky['id']) }}" method="post">
                                                    <input type="hidden" name="_method" value="put">
                                                    <input type="hidden" name="status" value="1">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn @if($data_ky['status']==0) btn-danger @else btn-success @endif" onclick="return confirm('Apakah anda akan menghapus data ini ...?')">@if($data_ky['status']==0) Tidak aktif @else Sudah Aktfi @endif</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ url('hapus-daftar-gaji/'.$data_ky['id']) }}" method="post">
                                                    <input type="hidden" name="_method" value="put">
                                                    {{ csrf_field() }}
                                                    <button  type='button'class="btn btn-warning" onclick="update('{{ $data_ky['id'] }}')">Ubah Daftar Gaji</button>
                                                    <button class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')">Hapus Daftar Gaji</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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



@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        $('[name="status"]').change(function () {
            alert('asda');
            $(this).trigger("sumbit")
        });


        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

    </script>
@stop