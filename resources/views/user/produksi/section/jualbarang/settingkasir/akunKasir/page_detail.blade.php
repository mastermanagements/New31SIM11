@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                 Setting Akun Kas Kasir
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Setting Akun Kas Kasir</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                             <div class="box-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Karyawan</label>
                                            <select class="form-control select2" style="width: 100%;" name="id_karyawan" required disabled>
                                                @if(empty($karyawan))
                                                    <option>Karyawan masih kosong</option>
                                                @else
                                                    @foreach($karyawan as $value)
                                                        <option disabled value="{{ $value->id }}" @if($data->kasir == $value->id) selected @endif>{{ $value->nama_ky }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <input type="number" min="0" class="form-control" value="{{ $data->shift }}" disabled name="shift" id="rangeBarang" placeholder="Masukan Shift Ke..." >
                                            <!-- /.input group -->
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered " style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Akun Kas</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="{{ url('setting-akun-kasir') }}" method="post">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id_shift_kasir" value="{{ $data->id }}">
                                                            <select class="form-control select2" name="id_akun_aktif" style="width: 100%">
                                                                <option disabled>Pilih akun aktif</option>
                                                                @if(!empty($akun_aktif))
                                                                    @foreach($akun_aktif as $data_akun)
                                                                        <option value="{{ $data_akun->id }}">{{ $data_akun->kode_akun_aktif }} : {{ $data_akun->nm_akun_aktif }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <button class="btn btn-primary" type="submit"> Simpan </button>
                                                        </th>
                                                    </tr>
                                                </form>
                                                @if(!empty($data->linkToSettingAkunKasir))
                                                    @php($no_kas_akun = 1)
                                                    @foreach($data->linkToSettingAkunKasir as $data_akun_kas)
                                                        <form action="{{ url('setting-akun-kasir/'.$data_akun_kas->id) }}" method="post">
                                                            <tr>
                                                                <th>{{ $no_kas_akun++ }}</th>
                                                                <th>
                                                                    @method('put')
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id_shift_kasir" value="{{ $data->id }}">
                                                                    <select class="form-control select2" name="id_akun_aktif" style="width: 100%">
                                                                        <option disabled>Pilih akun aktif</option>
                                                                        @if(!empty($akun_aktif))
                                                                            @foreach($akun_aktif as $data_akun)
                                                                                <option value="{{ $data_akun->id }}" @if($data_akun_kas->id_akun_aktif==$data_akun->id) selected @endif>{{ $data_akun->kode_akun_aktif }} : {{ $data_akun->nm_akun_aktif }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </th>
                                                                <th>
                                                                    <button class="btn btn-warning" type="submit"> ubah </button>
                                                                    <a href="{{ url('setting-akun-kasir/'.$data_akun_kas->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> hapus</a>
                                                                </th>
                                                            </tr>
                                                        </form>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>


        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });


    </script>

@stop