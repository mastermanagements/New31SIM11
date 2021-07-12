@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kompetitor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Tambah Data Kompetitor</h3>
                        <h5 class="pull-right"><a href="{{ url('Kompetitor')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('store-kompetitor') }}" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="col-md-4">
                          <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kompetitor</label>&nbsp;<strong style="color: red">*</strong>
                                <input type="text" name="nm_kompetitor" class="form-control" placeholder="Nama Kompetitor" required/>
                          </div>
							            <div class="form-group">
                                <label for="exampleInputEmail1">Badan Hukum</label>&nbsp;<strong style="color: red">*</strong>
                                <input type="text" name="badan_hukum" class="form-control" placeholder="Badan Hukum" required/>
                            </div>
							            <div class="form-group">
                                <label for="exampleInputEmail1">Bidang Usaha</label>&nbsp;<strong style="color: red">*</strong>
                                <input type="text" name="bidang_usaha" class="form-control" placeholder="Bidang Usaha" required/>
                          </div>
							            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>&nbsp;<strong style="color: red">*</strong>
								                 <textarea name="alamat" class="form-control" id="alamat_k" required></textarea>
                          </div>

							                <div class="form-group">
                                <label for="exampleInputFile">Provinsi</label>&nbsp;<strong style="color: red">*</strong>
                                   <select class="form-control select2" style="width: 100%;" name="id_provinsi" required>
                                        <option>Pilih Provinsi</option>
                                         @foreach($provinsi as $value)
                                           <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                                         @endforeach
                                    </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Kabupaten</label>&nbsp;<strong style="color: red">*</strong>
                                    <select class="form-control select2" style="width: 100%;" name="id_kabupaten" required>
                                        <option>Pilih Kabupaten</option>
                                    </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kontak Person</label>
                                <input type="text" name="cp" class="form-control" placeholder="Nomor Kontak Person" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Telepon</label>
                                <input type="text" name="telp" class="form-control" placeholder="No. Telepon Supplier" />
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Handphone </label>
                                <input type="text" name="hp" class="form-control" placeholder="No. Handphone Supplier" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. WA</label>
                                <input type="text" name="wa" class="form-control" placeholder="No. Whatsapp" />
                            </div>
							               <div class="form-group">
                                <label for="exampleInputEmail1">No. Telegram</label>
                                <input type="text" name="teleg" class="form-control" placeholder="No. Telegram" />
                            </div>
							              <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Email" />
                            </div>
                         </div>
                         <div class="col-md-4">
							              <div class="form-group">
                                <label for="exampleInputEmail1">Web</label>
                                <input type="text" name="web" class="form-control" placeholder="Web" />
                            </div>
							              <div class="form-group">
                                <label for="exampleInputEmail1">Akun FB</label>
                                <input type="text" name="akunfb" class="form-control" placeholder="FB" />
                            </div>
							              <div class="form-group">
                                <label for="exampleInputEmail1">Fans Page</label>
                                <input type="text" name="fanpages" class="form-control" placeholder="Fans Page" />
                            </div>
							              <div class="form-group">
                                <label for="exampleInputEmail1">Twitter</label>
                                <input type="text" name="twitter" class="form-control" placeholder="Twitter" />
                            </div>
							              <div class="form-group">
                                <label for="exampleInputEmail1">IG</label>
                                <input type="text" name="ig" class="form-control" placeholder="Instagram" />
                            </div>
                          </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                        </div>
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
 <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>

        //Initialize Select2 Elements
       $(function () {
           $('.select2').select2();


           $('[name="id_provinsi"]').change(function () {
               $.ajax({
                   url:"{{ url('getKabupatenK') }}/" + $(this).val(),
                   dataType: "json",
                   success: function (result) {
                       var option="<option>Pilih Kabupaten</option>";
                       $.each(result, function (id, val) {
                           option+="<option value="+val.id+">"+val.nama_kabupaten+"</option>";
                       });
                       $('[name="id_kabupaten"]').html(option);
                   }
               })
           })

       })
    </script>
@stop
