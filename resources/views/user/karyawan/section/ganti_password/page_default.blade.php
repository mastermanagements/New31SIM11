@extends('user.karyawan.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Ganti nama karyawan atau password anda
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-4">
                  <div class="box">
                      <div class="box-body">
                          @if(!empty(Session::get('message_success')))
                            <span style="color: green">{{ Session::get('message_success') }}</span>
                          @endif
                          @if(!empty(Session::get('message_fail')))
                            <span style="color: green">{{ Session::get('message_fail') }}</span>
                          @endif
                          <form action="{{ url('ganti-password-karyawan-post') }}" method="post">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Nama Pengguna</label>
                                  <input type="type" name="username" class="form-control" value="{{ $data->username }}">
                              </div>
                              <div class="form-group">
                                  <label>Nama</label>
                                  <input type="type" name="nama_ky" class="form-control" value="{{ $data->nama_ky }}">
                              </div>
                              <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" name="password" class="form-control"  value="{{ $data->password }}">
                                  <span style="color: orange">Password anda telah dienkripsi</span>
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-primary"
                                          onclick="return confirm('Apakah anda akan mengganti pengguna dari akun ini...?')">
                                      Ganti
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop