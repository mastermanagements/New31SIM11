@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Komisi Sales
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
                        <a href="{{ url('komisi-sales/create') }}" class="btn btn-primary" style="margin-bottom: 10px;">Tambah Komisi Penjualan</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Karyawan</td>
                                <td>Sistem Komisi</td>
                                <td>Besaranya Komisi</td>
                                <td>Aksi</td>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($komisi))
                                    @php($i=1)
                                    @foreach($komisi as $data)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $data->linkToKaryawan->nama_ky }}</td>
                                            <td>
                                                @if($data->jenis_komisi == '0')
                                                    <label>komisi per harga barang</label>
                                                @else
                                                    <label>komisi per faktur</label>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->persen_komisi !=0)
                                                    {{ ($data->persen_komisi/100) }} %
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('komisi-sales/'. $data->id.'/destroy') }}" method="post">
                                                    @method('delete')
                                                    {{ csrf_field() }}
                                                    <a href="{{ url('komisi-sales/'.$data->id.'/edit') }}" class="btn btn-warning">Ubah</a>
                                                    <button type="submit" class="btn btn-danger">Ubah</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- nav-tabs-custom -->
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
