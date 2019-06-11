@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Supplier
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
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Daftar Supplier</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="{{ url('tambah-supplier') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Supplier</a>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Supplier</th>
                                    <th>Kontak Person Supplier</th>
                                    <th>No.Telp Supplier</th>
                                    <th>No.Hp Supplier</th>
                                    <th>No. WhatsApp Supplier</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_supplier as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nama_suplier }}</td>
                                        <td>{{ $value->cp_suplier }}</td>
                                        <td>{{ $value->telp_suplier }}</td>
                                        <td>{{ $value->hp_suplier }}</td>
                                        <td>{{ $value->wa_suplier }}</td>
                                       <td>
                                            <form action="{{ url('hapus-supplier/'.$value->id) }}" method="post">
                                                <a href="{{ url('ubah-supplier/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus supplier ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                       @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
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