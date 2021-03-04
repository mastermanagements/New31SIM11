@extends('user.superadmin_ukm.master.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Perusahaan Anda
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
           @if(empty($data_perusahaan))
                <h3>Anda belum memasukan nama perusahaan anda ...!!</h3>
               <p>Klik <a href="{{ url('tambah-usaha') }}"><label style="color: #0b93d5; font-weight: bold">Daftarkan Usaha Anda</label></a> Anda Akan Diarahkan pada halaman perusahaan</p>
            @else
                @foreach($data_perusahaan as $perusahaans)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-number">{{ $perusahaans->nm_usaha  }}</span>
                            <span class="info-box-text">{{ $perusahaans->alamat  }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
               @endforeach
            @endif
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
