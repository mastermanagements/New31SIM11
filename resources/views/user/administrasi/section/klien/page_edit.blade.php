@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Klien/Customer
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Edit Customer</h3>
                        <h5 class="pull-right"><a href="{{ url('Klien')}}"><font color="#1052EE">Kembali ke Halaman Utama</font></a></h5>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-klien/'. $data_klien->id) }}" method="post">
                        <div class="box-body">
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama </label>&nbsp;<strong style="color: red">*</strong>
                                    <input type="text" name="nm_klien" class="form-control" id="exampleInputEmail1" value="{{ $data_klien->nm_klien }}" required>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat </label>&nbsp;<strong style="color: red">*</strong>
                                    <textarea class="form-control"  name="alamat" id="alamat" required>{{ $data_klien->alamat }}</textarea>
                                    <small style="color: red">* Tidak boleh kosong</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pekerjaan</label>&nbsp;<strong style="color: red">*</strong>
                                    <input type="text" name="pekerjaan" class="form-control"  value="{{ $data_klien->pekerjaan }}"  id="exampleInputEmail1" required>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Handphone</label>&nbsp;<strong style="color: red">*</strong>
                                    <input type="text" name="hp"  class="form-control"   value="{{ $data_klien->hp }}" id="exampleInputEmail1" required>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Whatshapp</label>
                                    <input type="text" name="wa"  class="form-control" value="{{ $data_klien->wa }}"  id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email"  class="form-control"  value="{{ $data_klien->email }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telegram</label>
                                    <input type="text" name="teleg"  class="form-control"  value="{{ $data_klien->teleg }}"  id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Instagram</label>
                                    <input type="text" name="ig"  class="form-control"  value="{{ $data_klien->ig }}"  id="exampleInputEmail1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Facebook</label>
                                    <input type="text" name="fb"  class="form-control"  value="{{ $data_klien->fb }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Twitter</label>
                                    <input type="text" name="twiter"  class="form-control" value="{{ $data_klien->twiter }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Perusahaan</label>
                                    <input type="text" name="nm_perusahaan"  class="form-control" value="{{ $data_klien->nm_perusahaan }}"  id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Perusahaan</label>
                                    <textarea class="form-control"  name="alamat_perusahaan"  id="alamat_perusahaan">{{ $data_klien->alamat_perusahaan }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telp Perusahaan</label>
                                    <input type="text" name="telp_perusahaan" class="form-control"  value="{{ $data_klien->telp_perusahaan }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control"  value="{{ $data_klien->jabatan }}" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Group Klien</label>&nbsp;<strong style="color: red">*</strong>
                                    <select class="form-control select2" style="width: 100%;" name="id_group" required>
                                        @if(empty($group_klien))
                                            <option>data masih kosong</option>
                                        @else
                                            @foreach($group_klien as $value)
                                                <option value="{{ $value->id }}">{{ $value->nama_group }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Diskon Berjenjang</label>&nbsp;<strong style="color: red">*</strong>
                                  <input type="radio" class="minimal" name="status_diskon"  @if($value->status_diskon ='0') checked @endif value="0" required>&nbsp;Ya
                                  <input type="radio" name="status_diskon" @if($value->status_diskon ='1') checked @endif value="1">&nbsp;Tidak
                                </div>
							                         <input type="hidden" name="jenis_klien" class="form-control"  value="{{ $data_klien->jenis_klien }}" id="exampleInputEmail1">
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
