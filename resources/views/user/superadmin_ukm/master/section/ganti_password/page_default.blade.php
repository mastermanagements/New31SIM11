@extends('user.superadmin_ukm.master.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ganti Email dan Password
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">
                            Form Ganti Password
                        </h4>
                    </div>
                    <div class="box-body">
                        @if(!empty(Session::get('message_success')))
                            <span style="color: green">{{ Session::get('message_success') }}</span>
                        @endif

                        @if(!empty(Session::get('message_fail')))
                            <span style="color: green">{{ Session::get('message_fail') }}</span>
                        @endif
                        <form method="post" action="{{ url('ganti-password-admin-post') }}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ $data_profil->email }}" name="email"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" value="{{ $data_profil->password }}" name="password"/>
                            <span style="color: orange">Password anda telah terenkripsi</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan mengganti email atau password anda...?')"> Ganti </button>
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