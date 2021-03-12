@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Komisi Sales
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <!-- Custom Tabs -->
                        <form action="{{ url('komisi-sales') }}" method="post">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <label for="">Karyawan</label>
                                <select class="select2 form-control" name="id_ky" required>
                                    <option disabled>Data Karyawan</option>
                                    @if(!empty($karyawan))
                                        @foreach($karyawan as $data)
                                            <option value="{{ $data->id }}"> {{ $data->nama_ky }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Komisi</label>
                                <input type="radio" name="jenis_komisi" value="0" required> Komisi per harga barang
                                <input type="radio" name="jenis_komisi" value="1"> Komisi per Faktur
                            </div>
                            <div class="form-group">
                                <label for="">Besar Komisi</label>
                                <input type="number" name="besar_komisi" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
@stop