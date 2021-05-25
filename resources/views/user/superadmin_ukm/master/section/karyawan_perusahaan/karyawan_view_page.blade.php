@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Daftar Karyawan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Daftar Karyawan </h3>
                       <h5 class="pull-right"><a href="{{ url('pengguna-karyawan')}}">Kembali ke Halaman utama</a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->

                   <div class="box-body">
                       <a href="{{ url('daftarkan-karyawan/'. $id_usaha ) }}" class="btn btn-block btn-info"><i class="fa fa-user-plus"></i> Daftarkan Karyawan Anda</a>
                       <p></p>
                       <table id="example1" class="table table-bordered table-striped">
                           <thead>
                           <tr>
                               <th>No.</th>
                               <th>Nama</th>
                               <th>Username</th>
                               <th>Status Kerja</th>
                               <th>Aksi</th>
                           </tr>
                           </thead>
                           <tbody>
                           @php($i=1)
                           @foreach($data_karyawan as $value)
                               <tr>
                                   <td>{{ $i++ }}</td>
                                   <td>{{ $value->nama_ky }}</td>
                                   <td>{{ $value->username }}</td>
                                   <td>
                                       @if($value->status_kerja==0)
                                           Aktif
                                       @else
                                           Tidak Aktif
                                       @endif
                                   </td>

                                   <td>
                                       <form action="{{ url('karyawan-delete/'.$value->id) }}" method="post">
                                           <a href="{{ url('detail-karyawan/'.$value->id) }}" class="btn btn-primary" title="Detail"><i class="fa  fa-sticky-note-o"></i></a>
                                           <a href="{{ url('ubah-karyawan/'.$id_usaha.'/'.$value->id) }}" class="btn btn-warning" title="Ubah"><i class="fa fa-edit"></i></a>
                                           {{ csrf_field() }}
                                           <input type="hidden" name="_method" value="put"/>
                                           <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data karyawan ini ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                           <a href="{{ url('hak-akses-karyawan/'.$value->id) }}" class="btn btn-default" title="Hak Akses"><i class="fa fa-edit"></i> Hak Akses</a>
                                       </form>
                                   </td>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
                   <div class="box-footer">

                   </div>
               </div>
               <!-- /.box -->
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>


        //Initialize Select2 Elements
       $(function () {

       })
    </script>
@stop
