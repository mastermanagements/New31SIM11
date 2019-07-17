@extends('user.karyawan.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
   <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Target Jangka Panjang Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-tjp') }}" class="btn btn-primary">Buat Target Jangka Panjang Perusahaan Anda</a>
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Target Target Jangka Panjang Perusahaan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-tjp') }}" method="post">
                        <div class="box-body">
							<div class="form-group">
                                <label for="exampleInputEmail1">Nama Target Perusahaan</label>
                                <input type="text" min="1" max="50" name="nm_tjp" class="form-control" id="exampleInputEmail1" placeholder="Contoh: Target 5 tahun pertama Otomatisasi Bisnis" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode</label>
                                <input type="text" maxlength="2" name="periode" class="form-control" id="exampleInputEmail1" placeholder="Periode Target Jangka Panjang Perusahaan setiap Berapa Tahun, misal : periode 5 tahun pertama, tulis: 5 " required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
							<div class="form-group">
								<label for="exampleInputEmail1">Tahun Mulai</label>
                                <select class="form-control select2" style="width: 100%;" name="thn_mulai" required>
                                   <option>Pilih Tahun Mulai</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
                            </div>
							<div class="form-group">
								<label for="exampleInputEmail1">Tahun Selesai</label>
                                <select class="form-control select2" style="width: 100%;" name="thn_selesai" required>
                                   <option>Pilih Tahun Selesai</option>
                                        @foreach(Tahun() as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach 
									</select>
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Masukan Target Jangka Panjang Perusahaan Anda</label>
                                    <textarea class="form-control" placeholder="Masukan Target Anda" name="isi_tjp" id="isi_tjp" required></textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
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
     <!-- iCheck 1.0.1 -->
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'isi_tjp',{
                height: 600
            } );
        };
    </script>
@stop