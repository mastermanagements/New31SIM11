@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Klien/Cusotmer
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Customer</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Leads</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Group Klien</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                    <th>HP</th>
                                    <th>WA</th>
                                    <th>Email</th>
									<th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_klien as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nm_klien }}</td>
                                        <td>
                                            {{ $value->alamat }}
                                        </td>
                                        <td>
                                            {{ $value->pekerjaan }}
                                        </td>
                                        <td>
                                            {{ $value->hp }}
                                        </td>
										<td>
                                            {{ $value->wa }}
                                        </td>
										<td>
                                            {{ $value->email }}
                                        </td>
										<td>
                                            <a href="#" onclick="detailKlien('{{ $value->id }}')">
                                                <span class="badge bg-red">Detail</span>
                                            </a>
                                        </td>
                                       <td>
                                            <form action="{{ url('hapus-klien/'.$value->id) }}" method="post">
                                                <a href="{{ url('ubah-klien/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus Klien ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                       @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
						<div class="tab-pane" id="tab_2">
                            <a href="{{ url('tambah-leads') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Leads </a>
                            <p></p>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                    <th>HP</th>
                                    <th>WA</th>
                                    <th>Email</th>
									<th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
								@php($a=1)
                                @foreach($data_leads as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->nm_klien }}</td>
                                        <td>
                                            {{ $value->alamat }}
                                        </td>
                                        <td>
                                            {{ $value->pekerjaan }}
                                        </td>
                                        <td>
                                            {{ $value->hp }}
                                        </td>
										<td>
                                            {{ $value->wa }}
                                        </td>
										<td>
                                            {{ $value->email }}
                                        </td>
										<td>
                                            <a href="#" onclick="detailKlien('{{ $value->id }}')">
                                                <span class="badge bg-red">Detail</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('ubah-klien/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
											<button class="btn btn-primary" onclick="gantiLeads('{{ $value->id }}');" title="Ubah Status Customer"><i class="fa fa-file-picture-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ url('group-klien') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Nama Group</label>
                                            <input class="form-control" name="nama_group" required/>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @if(!empty($group_klien))
                                            @foreach($group_klien as $data)
                                                <div class="col-md-4">
                                                    <div class="box box-primary">
                                                        <div class="box box-body">
                                                            <form action="{{ url('group-klien/'.$data->id) }}" method="post">
                                                                {{ csrf_field() }}
                                                                @method('put')
                                                                <div class="form-group">
                                                                    <label>Nama Group</label>
                                                                    <input class="form-control" name="nama_group" value="{{ $data->nama_group }}" required/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-warning">simpan</button>
                                                                    <a href="{{ url('group-klien/'.$data->id.'/destroy') }}" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ...?')">hapus</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@include('user.administrasi.section.klien.modal.modal_detail_view')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.klien.modal.JS')

    <script>
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })

    </script>
@stop
