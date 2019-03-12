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
           Halaman Daftar Investor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Tabel Investor</h3>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->

                   <div class="box-body">
                       <a href="{{ url('daftarkan-investor/'. $id_usaha ) }}" class="btn btn-block btn-info"><i class="fa fa-user-plus"></i> Daftarkan Investor Anda</a>
                       <p></p>
                       <table id="example1" class="table table-bordered table-striped">
                           <thead>
                           <tr>
                               <th>No.</th>
                               <th>No. KTP</th>
                               <th>Nama</th>
                               <th>Jumlah Saham</th>
                               <th>Aksi</th>
                           </tr>
                           </thead>
                           <tbody>
                           @php($i=1)
                           @foreach($data_investor as $value)
                               <tr>
                                   <td>{{ $i++ }}</td>
                                   <td>{{ $value->no_ktp }}</td>
                                   <td>{{ $value->nm_investor }}</td>
                                   <td>
                                      {{ $value->jum_saham }}
                                   </td>
                                   <td>
                                       <form action="{{ url('delete-investor/'.$value->id) }}" method="post">
                                           <a href="{{ url('detail-investor/'.$id_usaha.'/'.$value->id) }}" class="btn btn-primary" title="Detail"><i class="fa  fa-sticky-note-o"></i></a>
                                           <a href="{{ url('ubah-investor/'.$id_usaha.'/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                           {{ csrf_field() }}
                                           <input type="hidden" name="_method" value="put"/>
                                           <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data investor ini ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
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