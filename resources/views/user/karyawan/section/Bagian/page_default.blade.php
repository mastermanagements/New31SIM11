@extends('user.karyawan.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop
@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Departemen/Bagian Perusahaan
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
                      <li class="@if(Session::get('tab1') == 'tab1') active @else '' @endif"><a href="#tab_1" data-toggle="tab"><i class="fa fa-book"></i> Departemen </a></li>
                      <li class="@if(Session::get('tab2') == 'tab2') active @else '' @endif" ><a href="#tab_2" data-toggle="tab"><i class="fa fa-book"></i> Divisi</a></li>
                      <li class="@if(Session::get('tab3') == 'tab3') active @else '' @endif"><a href="#tab_3" data-toggle="tab"><i class="fa fa-book"></i> Jabatan</a></li>
                  </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
                            <div class="row">
                                <div class="col-md-3" style="margin: 0">
                                    <button type="button" data-toggle="modal" data-target="#modal-tambah-bagian" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah</button>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-primary">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12" style=" overflow-x: auto; white-space: nowrap; margin: 10px">
                                                  <table id="example1" class="table table-bordered table-striped">
                                                      <thead>
                                                      <tr>
                                                          <th>No.</th>
                                                          <th>Departemen Perusahaan</th>
                                                          <th>Aksi</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                      @php($i=1)
                                                      </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!--./col-12 --->
                            </div>
                            <!--./row --->
                        </div>
                        <!--./tab-pane-1-->

                        <div class="tab-pane @if(Session::get('tab2') == 'tab2') active @else '' @endif" id="tab_2">
                            <div class="row">
                              @foreach($Bagian as $bagians)
                                      <div class="col-md-12">
                                          <div class="box box-primary">
                                              <div class="box-header with-border">
                                                  <h3 class="box-title"> {{ $bagians->nm_bagian }}</h3>

                                                  <div class="box-tools pull-right">
                                                      <button type="button" class="btn btn-box-tool" onclick="tambahDevisi({{ $bagians->id }})" title="tambah"><i class="fa fa-plus"></i></button>
                                                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                  </div>
                                                  <!-- /.box-tools -->
                                              </div>
                                              <!-- /.box-header -->
                                              <div class="box-body">
                                                  <ul>
                                                      @if(!empty($divisi= $bagians->getDevisi))
                                                          @foreach($divisi as $daftar_divisi)
                                                              <li>{{ $daftar_divisi->nm_devisi }}
                                                                    <a href="#" onclick="hapus({{ $daftar_divisi->id }})" class="pull-right" title="hapus" style="padding-left: 1%"><i class="fa fa-trash"></i></a>
                                                                    <a href="#" onclick="ubah({{ $daftar_divisi->id }})" class="pull-right" title="ubah"><i class="fa fa-pencil"></i>  </a> </li>
                                                          @endforeach
                                                      @endif
                                                  </ul>
                                              </div>
                                              <!-- /.box-body -->
                                          </div>
                                          <!-- /.box -->
                                      </div>
                                      <!-- /.col-12 -->
                              @endforeach
                            </div>
                            <!--./row --->
                        </div>
                        <!--./tab-pane-2-->

                        <div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="box box-primary collapsed">
                                      <div class="box-header with-border">
                                          <h3 class="box-title">Formulir Jabatan Perusahaan</h3>
                                          <div class="box-tools pull-right">
                                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                              </button>
                                          </div>
                                          <!-- /.box-tools -->
                                      </div>
                                      <!-- /.box-header -->
                                      <form action="{{ url('store-jabatan') }}" method="post" id="jabatan">
                                          <div class="box-body" style="">
                                                  <input type="hidden" name="id">

                                                  <div class="form-group">
                                                      <label>Nama Jabatan</label>
                                                      <input type="text" class="form-control" name="nm_jabatan" required>
                                                      <small style="color: red"> * Tidak Boleh Kosong </small>
                                                  </div>
                                                <div class="form-group">
                                                      <label>Level Jabatan</label>
                                                        <div class="form-group">
                                                      @foreach($level_jabatan as $key => $level)
                                                          <label>
                                                              <input type="radio"  name="level_jabatan" class="minimal" value="{{ $key }}" required>
                                                              {{ $level }} &nbsp;
                                                          </label>
                                                      @endforeach
                                                      <p></p>
                                                      <small style="color: red">* Tidak Boleh Kosong</small>
                                                  </div>
                                                  </div>

                                          </div>

                                          <div class="box-footer">
                                              {{ csrf_field() }}
                                              <button type="submit" class="btn btn-primary">Simpan</button>
                                          </div>
                                      </form>
                                      <!-- /.box-body -->
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <div class="box box-primary collapsed">
                                      <div class="box-header with-border">
                                          <h3 class="box-title">Daftar Jabatan Perusahaan</h3>
                                          <div class="box-tools pull-right">
                                             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                              </button>
                                          </div>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body" style="">
                                          <table id="example1" class="table table-bordered table-striped">
                                              <thead>
                                              <tr>
                                                  <th>No.</th>
                                                  <th>Nama Jabatan </th>
                                                  <th>Level </th>
                                                  <th>Aksi</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              @php($i=1)
                                              @foreach($jabatan as $value)
                                                  <tr>
                                                      <td>{{ $i++ }}</td>
                                                      <td>{{ $value->nm_jabatan }}</td>
                                                      <td>
                                                          @if($value->level_jabatan==0)
                                                              Direksi
                                                          @elseif ($value->level_jabatan==1)
                                                              Manager
                                                          @elseif ($value->level_jabatan==2)
                                                              Supervisor
                                                          @else
                                                              Staf
                                                          @endif
                                                      </td>
                                                      <td>
                                                          <form action="{{ url('hapus-jabatan/'.$value->id) }}" method="post">
                                                              {{ csrf_field() }}
                                                              <input type="hidden" name="_method" value="put">
                                                              <button type="button" class="btn btn-warning" id="tomboh-ubah" onclick="update('{{ $value->id }}')" >Ubah</button>
                                                              <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda akan menghapus data ini...?')">Hapus</button>
                                                          </form>
                                                      </td>
                                                  </tr>
                                              @endforeach
                                              </tbody>
                                          </table>
                                      </div>
                                      <!-- /.box-body -->
                                  </div>
                              </div>
                          </div>
                          <!---row-->
                        </div>
                      <!--tab-pane3->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!--col-md-12-->
        </div>
        <!-- row -->
    </section>
    <!-- /.section -->
</div>
    @include('user.karyawan.section.Bagian.include.modal')
    @include('user.karyawan.section.Devisi.include.modal')
@stop

@section('plugins')
<script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var ids;
            var table_bagian = $('#example1').DataTable({
                data:[],
                column:[
                    {'data' :'0'},
                    {'data' :'1'},
                    {'data' :'2'},
                ],
                rowCallback : function(row, data){

                },
                filter: false,
                pagging : true,
                searching: true,
                info : true,
                ordering : true,
                processing : true,
                retrieve: true
            });

            call_data = function () {
                $.ajax({
                    url: '{{ url('dataBagian') }}',
                    dataType : 'json',
                }).done(function (result) {
                    table_bagian.clear().draw();
                    table_bagian.rows.add(result.data).draw();
                }).fail(function(jqXHR, textStatus,errorThrown){

                })
            };

            call_data();

            $('#submitBagian').click(function () {

                if($('[name="nm_bagian"]').val()==""){
                    $('#notify').text("*Tidak Boleh Kosong")
                }else{
                    $.ajax({
                        url: "{{ url('store-bagian') }}",
                        type: "post",
                        data : {
                            'nm_bagian': $('[name="nm_bagian"]').val(),
                            '_token': '{{ csrf_token() }}',
                        },
                        success:function (result) {
                            call_data();
                            $("#modal-tambah-bagian").modal('hide')
                        }
                    })
                }
            });

            edits = function(id)
            {
                $.ajax({
                   url : "{{ url('dataBagian') }}/"+id,
                   dataType: "json",
                   success: function (result) {
                       $('[name="nm_bagian_ubah"]').val(result.bagian.nm_bagian);
                       ids = result.bagian.id;
                       $('#modal-ubah-bagian').modal('show');
                   }
                });
            };

            $('#submitUbahBagian').click(function () {
                 $.ajax({
                    url: "{{ url('update-bagian') }}",
                    type: "post",
                    data : {
                        'nm_bagian': $('[name="nm_bagian_ubah"]').val(),
                        'id' : ids,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        call_data();
                        $('#modal-ubah-bagian').modal('hide');
                        alert(result.message);
                    }
                })
            });

            deletes = function(id)
            {
                if(confirm('Apakah anda mehapus bagian ini, ini akan berdampak pada data defisi yang berhubungan dengan data ini ... ?')== true){
                    $.ajax({
                        url : "{{ url('hapus-bagian') }}/"+id,
                        type: "post",
                        data :{
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (result) {
                            call_data();
                            alert(result.message);
                        }
                    });
                }else{
                    alert('Bagian ini tidak jadi dihapus');
                }
            }

            //divisi
            tambahDevisi  = function (id) {
                $('[name="id_bagian"]').val(id);
                $('#modal-tambah-devisi').modal('show');
            };

            ubah = function (id) {
                $.ajax({
                    url: '{{ url('Divisi') }}/'+id,
                    dataType : 'json',
                    success:function (result) {

                        $('[name="nm_divisi_ubah"]').val(result.data_devisi.nm_devisi);
                        $('[name="id_bagian_ubah"]').val(result.data_devisi.id_bagian_p).trigger('selected');
                        $('[name="id_devisi"]').val(result.data_devisi.id);
                        $('#modal-ubah-divisi').modal('show');
                    }
                })
            };

            hapus = function (id) {
                if(confirm("Apakah anda akan menghapus divisi ini...?")==true){
                    $.ajax({
                        url: '{{ url('hapusDivisi') }}/'+id,
                        type : 'post',
                        data :{
                            '_method': 'put',
                            '_token' : '{{ csrf_token() }}'
                        },
                        success:function (result) {
                            alert(result.message);
                            window.location.reload()
                        }
                    })
                }else {
                    alert("Divisi tidak jadi dihapus");
                }
            }
            //jabatan
            update=function (id) {
               $.ajax({
                   url: "{{ url('edit-jabatan') }}/"+id,
                   dataType: "json",
                   success: function (result) {
                       console.log(result);
                       $('[name="nm_jabatan"]').val(result.nm_jabatan);
                       $('[name="level_jabatan"]').val(result.level_jabatan);

                       $('[name="id"]').val(result.id);
                       $('#jabatan').attr('action', '{{ url('update-jabatan') }}');
                   }
               })
            }


        })

    </script>
@stop
