@extends('user.superadmin_ukm.master.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Halaman Membuat Misi Usaha
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-primary">
                   <div class="box-header with-border">
                       <h3 class="box-title">Formulir Misi</h3>
                       <h5 class="pull-right"><a href="{{ url('pengaturan-perusahaan')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                   <form role="form" method="post" action="{{ url('store-misi') }}" enctype="multipart/form-data">
                       <div class="box-body">
                           @if(!empty(session('message_success')))
                               <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                           @elseif(!empty(session('message_fail')))
                               <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                           @endif

                           <div class="form-group">
                               <label for="exampleInputEmail1">Usaha Anda</label>
                               <div class="form-group">
                                   @forelse($usaha as $usaha)
                                   <label>
                                       <input type="radio"  name="id_perusahaan" class="minimal" value="{{ $usaha->id}}" required>
                                       {{ $usaha->nm_usaha }}
                                       @if($usaha->jenis_kantor !== NULL)
                                         @if($usaha->jenis_kantor =='0')
                                               (Pusat)&nbsp;
                                         @else ($usaha->jenis_kantor =='1')
                                               (Cabang)&nbsp;
                                         @endif

                                       @endif
                                   </label>
                                   @empty
                                    <label style="color: red">Isi dulu data perusahaan Anda! <a href="{{ url('tambah-usaha') }}">Klik di sini</a></label>
                                   @endforelse
                                   <p></p>
                               <small style="color: red">* Tidak Boleh Kosong</small>
                           </div>

                               <div class="form-group">
                                   <label for="exampleInputEmail1">Masukan Misi Anda</label>
                                   <textarea class="form-control" placeholder="Masukan Misi usaha anda" name="misi" id="misi" required>

                                   </textarea>
                                   <small style="color: red">* Tidak boleh kosong</small>
                               </div>

                       </div>

                       <div class="box-footer">
                           {{csrf_field()}}
                           <button type="submit" class="btn btn-primary">Simpan</button>
                       </div>
                       </div>
                   </form>
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
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'misi',{
                height: 200
            } );
        };

        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();

           //iCheck for checkbox and radio inputs
           $('input[type="radio"].minimal').iCheck({
               checkboxClass: 'icheckbox_minimal-blue',
               radioClass   : 'iradio_minimal-blue'
           })

       })
    </script>
@stop
