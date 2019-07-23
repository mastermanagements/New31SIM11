@extends('user.hrd.master_user')


@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Karyawan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pencarian</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ url('tambah-karyawan') }}" class="btn btn-box-tool" ><i class="fa fa-user-plus"></i>
                                </a>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <form action="{{ url('cari-karyawan') }}" method="post">
                                <div class="input-group input-group-sm">
                                    {{ csrf_field() }}
                                    <input type="text" name="nm_ky" class="form-control" placeholder="cari berdasarkan nama klien" required>
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                @if(!empty(session('message_success')))
                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                @elseif(!empty(session('message_fail')))
                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                @endif
                <p></p>

                @if(empty($data_karyawan))
                    <div class="col-md-4"> <h5>Data karyawan belum tersedia</h5></div>
                @else
                    @foreach($data_karyawan as $value)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-primary">
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="@if(empty($value->pas_foto)) {{ asset('image_superadmin_ukm/default.png') }}  @else {{ asset('filePFoto/'.$value->pas_foto) }} @endif" alt="User Avatar">
                                    </div>
                                    <h3 class="widget-user-username">{{ $value->nama_ky }}</h3>
                                    <h5 class="widget-user-desc">Nik {{ $value->nik }}</h5>
                                    @if(empty($value->jabatan_ky->getJabatan))
                                        <h5 class="widget-user-desc" onclick="ubahJabatan('{{ $value->id }}')">Jabatan Belum dipilih</h5>
                                    @else
                                        <h5 class="widget-user-desc" onclick="ubahJabatan('{{ $value->id }}')">{{ $value->jabatan_ky->getJabatan->nm_jabatan }}</h5>
                                    @endif
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Nama <span class="pull-right">{{ $value->nama_ky }}</span></a></li>
                                        <li><a href="#">Nik <span class="pull-right ">{{ $value->nik }}</span></a></li>
                                        <li><a href="#">Tempat Lahir<span class="pull-right ">{{ $value->tmp_lahir }}, {{ date('d-m-Y', strtotime($value->tgl_lahir)) }}</span></a></li>
                                        <li><a href="#">Alamat Sekarang<span class="pull-right ">@if(empty($value->getAlamatSek->tmp_lahir)) Alamat belum dimasukan @else {{ $value->getAlamatSek->tmp_lahir }} @endif</span></a></li>
                                        <li>
                                            <form style="padding: 10px 15px ">
                                                Aksi
                                                <a href="{{ url('hapus-karyawan/'. $value->id) }}" onclick="return confirm('Apakah anda akan menghapus karyawan ini...?')"><span class="pull-right badge bg-orange"><i class="fa fa-trash"></i></span></a>
                                                <a href="{{ url('ubah-karyawan/'. $value->id) }}"><span class="pull-right badge bg-red"><i class="fa fa-pencil"></i></span></a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @endforeach
                    {{ $data_karyawan->links() }}
                @endif
            </div>

        </section>
        <!-- /.content -->
    </div>
    @include('user.hrd.section.karyawan.modal.modal')
@stop


@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $('#datepicker1').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });


        //Initialize Select2 Elements
        $(function () {
            //iCheck for checkbox and radio inputs
            $('.select2').select2()

        })

        ubahJabatan = function (id) {
            $('[name="id_ky"]').val(id);
            $('#modal-tambah-jabatan').modal('show')
        }
    </script>
@stop