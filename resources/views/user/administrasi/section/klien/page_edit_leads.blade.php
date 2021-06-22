@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Leads
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Edit Lead</h3>
                        <h5 class="pull-right"><a href="{{ url('Klien')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-leads/'. $data_leads->id) }}" method="post">
                        <div class="box-body">
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama </label>&nbsp;<strong style="color: red">*</strong>
                                    <input type="text" name="nm_klien" class="form-control" id="exampleInputEmail1" value="{{ $data_leads->nm_klien }}" required>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat </label>
                                    <textarea class="form-control"  name="alamat" id="alamat">{{ $data_leads->alamat }}</textarea>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control"  value="{{ $data_leads->pekerjaan }}"  id="exampleInputEmail1" >

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Handphone</label>
                                    <input type="text" name="hp"  class="form-control"   value="{{ $data_leads->hp }}" id="exampleInputEmail1" >

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Whatshapp</label>
                                    <input type="text" name="wa"  class="form-control" value="{{ $data_leads->wa }}"  id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email"  class="form-control"  value="{{ $data_leads->email }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telegram</label>
                                    <input type="text" name="teleg"  class="form-control"  value="{{ $data_leads->teleg }}"  id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Instagram</label>
                                    <input type="text" name="ig"  class="form-control"  value="{{ $data_leads->ig }}"  id="exampleInputEmail1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Facebook</label>
                                    <input type="text" name="fb"  class="form-control"  value="{{ $data_leads->fb }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Twitter</label>
                                    <input type="text" name="twiter"  class="form-control" value="{{ $data_leads->twiter }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Perusahaan</label>
                                    <input type="text" name="nm_perusahaan"  class="form-control" value="{{ $data_leads->nm_perusahaan }}"  id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Perusahaan</label>
                                    <textarea class="form-control"  name="alamat_perusahaan"  id="alamat_perusahaan">{{ $data_leads->alamat_perusahaan }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telp Perusahaan</label>
                                    <input type="text" name="telp_perusahaan" class="form-control"  value="{{ $data_leads->telp_perusahaan }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control"  value="{{ $data_leads->jabatan }}" id="exampleInputEmail1">
                                </div>
                                
                          </div>

                        <div class="col-md-12">
                            <div class="box-footer">
                              <p> <b>Tanda <strong style="color: red">*</strong> harus di isi!</b></p>
                            </div>
                            <div class="box-footer">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
