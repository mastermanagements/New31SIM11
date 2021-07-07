@extends('user.administrasi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
	
@stop
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
                     
					  <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Daftar Supplier  </a></li>
                        <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Rekening Supplier </a></li>
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
                                    <th>Kontak Person </th>
                                    <th>Telp </th>
                                    <th>Hp </th>
                                    <th>WhatsApp</th>
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
                                                <a href="#" class="btn btn-primary" onclick="tambahRekSupplier({{ $value->id }})" title="Tambah Rekening">Tambah Rekening</i></a>
                                                <a href="{{ url('ubah-supplier/'.$value->id) }}" class="btn btn-warning" title="Edit">Ubah</a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus supplier ini ...?')" title="Hapus">Hapus</button>
                                            </form>
                                        </td>
                                        </tr>
                                       @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -1-->

                        <div class="tab-pane" id="tab_2">

                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                      <th>No.</th>
									  <th>Nama Supplier</th>
                                      <th>Nama Bank</th>
                                      <th>No Rekening</th>
                                      <th>Atas Nama</th>
                                      <th>Kantor Cabang</th>
                                      <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php($i=1)
                                  @foreach($rek_supplier as $value)
                                  <tr>
                                      <td>{{ $i++ }}</td>
									  <td>{{ $value->linkToSupplier->nama_suplier }}</td>
                                      <td>{{ $value->nama_bank }}</td>
                                      <td>{{ $value->no_rek }}</td>
                                      <td>{{ $value->atas_nama }}</td>
                                      <td>{{ $value->kcp }}</td>
                                      <td>
                                            <a href="{{ url('RekSupplier/'.$value->id.'/edit') }}" class="btn btn-warning" title="Edit">Edit</a>

                                            <form action="{{ url('RekSupplier/'.$value->id) }}" method="post">
                                              @method('delete')
                                              {{ csrf_field() }}
                                                  @if(empty($value->getBayarBeli->bank_tujuan))
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus supplier ini ...?')" title="Hapus">Hapus</button>
                                                @endif
                                            </form>

                                        </td>
                                        </tr>
                                       @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane 2-->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
@include('user.produksi.section.supplier.rek_supplier.modal')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
    $(document).ready(function () {
            var ids;
            tambahRekSupplier = function (id) {
                      $('[name="id_supplier"]').val(id);
                      $('#modal-tambah-rekSupplier').modal('show');
                  };
      })
    </script>
@stop
