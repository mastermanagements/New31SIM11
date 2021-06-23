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
            Klien/Customer
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
                        <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Customer  </a></li>
                        <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Leads </a></li>
                        <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Group Klien(Member) </a></li>
                        <li class="@if(Session::get('tab4') == 'tab4') active @else '' @endif"><a href="#tab_4" data-toggle="tab"><i class="fa fa-book"></i> Rekening Klien</a></li>
                    </ul>
                    <div class="tab-content">
                          
                        <!-- /.tab-pane -->
						<div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
							<a href="{{ url('tambah-klien') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                                  <th>Member</th>
                                  <th>Diskon Berjenjang</th>
                                  <th>Detail</th>
                                  <th width="100">Aksi</th>
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
                                        @if(!empty($value->linkToMannyGroupKlien->nama_group))
                                         {{ $value->linkToMannyGroupKlien->nama_group }}
                                         @endif
                                     </td>
                                     <td>
                                        @if($value->status_diskon =='0')
                                          Ya
                                        @else
                                          Tidak
                                        @endif
                                    </td>
                                       <td>
                                          <a href="#" onclick="detailKlien('{{ $value->id }}')">
                                              <span class="badge bg-red">Detail</span>
                                          </a>
                                      </td>
                                     <td>
                                          <form action="{{ url('hapus-klien/'.$value->id) }}" method="post">
                                              <a href="#" class="btn btn-primary" onclick="tambahRekKlien({{ $value->id }})" title="Tambah Rekening Klien"><i class="fa fa-plus"></i></a>
                                              <a href="{{ url('ubah-klien/'.$value->id) }}" class="btn btn-warning" title="Edit Klien"><i class="fa fa-edit"></i></a>
                                              {{ csrf_field() }}
                                              <input type="hidden" name="_method" value="put"/>
											
												@if(!empty($value->linkToSO->id_klien))
													<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus Klien ini ...?')" title="Hapus Klien"><i class="fa fa-eraser"></i></button>
												@endif
											  
												
                                              
                                          </form>
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                        </div>
                        <!-- /.tab-pane -->
						<div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
                            <p></p>
                            <a href="{{ url('tambah-leads') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
								                @php($i=1)
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
                                          <form action="{{ url('convert-leads/'.$value->id) }}" method="post">
                                              <a href="{{ url('ubah-leads/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                              {{ csrf_field() }}
                                              <input type="hidden" name="_method" value="put"/>
                                              <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan mengkonversi leads menjadi customer ...?')" title="Convert"><i class="fa fa-eraser"></i></button>
                                          </form>




                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
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
                        <!--./tab-3-->
                      <div class="tab-pane @if(Session::get('tab4') == 'tab4') active @else '' @endif" id="tab_4">

                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>Nama Bank</th>
                                      <th>No Rekening</th>
                                      <th>Atas Nama</th>
                                      <th>Kantor Cabang</th>
                                      <th width="100">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php($i=1)
                                  @foreach($rek_klien as $value)
                                  <tr>
                                      <td>{{ $i++ }}</td>
                                      <td>{{ $value->nama_bank }}</td>
                                      <td>{{ $value->no_rek }}</td>
                                      <td>{{ $value->atas_nama }}</td>
                                      <td>{{ $value->kcp }}</td>
                                      <td>
                                            <a href="{{ url('RekKlien/'.$value->id.'/edit') }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>

                                            <form action="{{ url('RekKlien/'.$value->id) }}" method="post">
                                              @method('delete')
                                              {{ csrf_field() }}
                                                  @if(empty($value->getBayarJual->bank_asal))
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus supplier ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
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
@include('user.administrasi.section.klien.modal.modal_detail_view')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.klien.modal.JS')
    @include('user.administrasi.section.klien.modal.modal_rek_klien')

    <script>
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })

        $(document).ready(function () {
                var ids;
                tambahRekKlien = function (id) {
                          $('[name="id_klien"]').val(id);
                          $('#modal-tambah-rekKlien').modal('show');
                      };
          })

    </script>
@stop
