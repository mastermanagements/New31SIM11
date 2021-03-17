@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Job Description
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>
            @foreach($data_jabatan as $jabatan)
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> {{ $jabatan->nm_jabatan }}</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" onclick="tambahJobdesc({{ $jabatan->id }})" title="tambah jobdesc"><i class="fa fa-plus"></i></button>
                                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
								               </div>
                                <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                          <ul>
								              @if(!empty($jobdesc= $jabatan->getJobdesc))
									            @foreach($jobdesc as $daftar_jobdesc)

                              <form action="{{ url('hapus-jobdesc/'. $daftar_jobdesc->id) }}" method="post">
                                  <input type="hidden" name="_method" value="put">
                                  {{ csrf_field() }}
                                  <button type="submit" onclick="return confirm('apakah anda akan menghapus JobDecs ini?, Jika Anda menghapus data Jobdesc, maka data tugas, tanggung jawab dan wewenang pd jabatan yg sama akan terhapus juga.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                  <a href="#" onclick="ubahJobdesc({{ $daftar_jobdesc->id }})" class="btn btn-xs btn-primary pull-right" title="ubah jobdesc">
                                  <i class="fa fa-edit"></i></a>
                              </form>

                                <div class="col-md-6">
                                  <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                          						<li><b>Atasan</b> <span class="pull-right">{!! $daftar_jobdesc->getAtasan->nm_jabatan !!}</span></li>
                                      <li><b>Hubungan Kedalam</b> <span class="pull-right">{!! $daftar_jobdesc->hub_kedalam !!}</span></li>
                                      <li><b>Hubungan Keluar</b> <span class="pull-right">{!! $daftar_jobdesc->hub_keluar !!}</span></li>
                                      <li><b>Pelimpahan Wewenang</b> <span class="pull-right">{!! $daftar_jobdesc->limpahan_wewenang !!}</span></li>
                                    </ul>
                                  </div>
                                </div>
                              <div class="col-md-6">
                                <div class="box-footer no-padding">
                                  <ul class="nav nav-stacked">
                                    <dl>
                                        <dt>Ruang Lingkup Pekerjaan</dt>
                                        <dd>{!! $daftar_jobdesc->ruang_lingkup !!}</dd>
                                    </dl>
                                  </ul>
                                </div>
                              </div>
                            <div class="col-md-12">
                            <div class="box-footer no-padding">
                              <ul class="nav nav-stacked">
                                <dl>
                                  <dt>Tugas</dt>
                                    @foreach($tugas as $value)
                                        @if($daftar_jobdesc->id == $value->id_jobdesc)
                                        <ul>
                                          <li>{!! $value->item_tugas !!}
                                            <a href="#" onclick="ubahTugas({{ $value->id }})" class="pull-right" title="ubah tugas pekerjaan">
                                            <i class="fa fa-pencil"></i></a>
                                          </li>
                                        </ul>
                                        @endif
                                    @endforeach
                                </dl>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-6">
                          <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                              <dl>
                                  <dt>Tanggung Jawab</dt>
                                  @foreach($tanggungj as $value)
                                      @if($daftar_jobdesc->id == $value->id_jobdesc)
                                      <ul>
                                        <li>{!! $value->item_tjb !!}
                                          <a href="#" onclick="ubahTanggungjawab({{ $value->id }})" class="pull-right" title="ubah Tanggung Jawab pekerjaan">
                                          <i class="fa fa-pencil"></i></a>
                                        </li>
                                      </ul>
                                      @endif
                                  @endforeach
                              </dl>
                            </ul>
                          </div>
                        </div>
                          <div class="col-md-6">
                          <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                              <dl>
                                  <dt>Wewenang</dt>
                                  @foreach($wewenang as $value)
                                      @if($daftar_jobdesc->id == $value->id_jobdesc)
                                      <ul>
                                        <li>{!! $value->item_wewenang !!}
                                          <a href="#" onclick="ubahWewenang({{ $value->id }})" class="pull-right" title="ubah Wewenang pekerjaan">
                                            <i class="fa fa-pencil"></i></a>
                                          </li>
                                      </ul>
                                      @endif
                                  @endforeach
                              </dl>

                            </ul>
                          </div>
                        </div>
                        <div class="box-body">
                          @if($jabatan->id == $daftar_jobdesc->id_jabatan_p)
                          <div class="col-md-8">
                          <button type="button" class="btn btn-warning" onclick="tambahTugas({{ $daftar_jobdesc->id }})">Tambah Tugas</button>
                          <button type="button" class="btn btn-info" onclick="tambahTanggungjawab({{ $daftar_jobdesc->id }})">Tambah Tanggung Jawab</button>
                          <button type="button" class="btn btn-primary" onclick="tambahWewenang({{ $daftar_jobdesc->id }})">Tambah Wewenang</button>
                        </div>
                          @endif
                        </div>
                      </ul>
                        @endforeach
                        @endif

                      </div>
                      <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            @endforeach
        </div>
    </section>
    <!-- /.content -->
</div>
	 @include('user.karyawan.section.JobDecs.include.modal')
@stop

@section('plugins')
  <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
	$(function () {
            $('.select2').select2();
        });
		$(document).ready(function () {
            var ids;

			tambahJobdesc  = function (id) {
                $('[name="id_jabatan_p"]').val(id);
                $('[name="atasan"]').val(id);
                //$('[name="ruang_lingkup"]');
                $('#modal-tambah-jobdesc').modal('show');
            };

      tambahTugas = function (id) {
                $('[name="id_jobdesc"]').val(id);
                $('#modal-tambah-tugas').modal('show');
            };
      tambahTanggungjawab = function (id) {
                $('[name="id_jobdesc"]').val(id);
                $('#modal-tambah-tanggungjawab').modal('show');
            };
      tambahWewenang= function (id) {
              $('[name="id_jobdesc"]').val(id);
              $('#modal-tambah-wewenang').modal('show');
        };

			ubahJobdesc = function (id) {
                $.ajax({
                    url: '{{ url('ubah-jobdesc') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
                        $('[name="id_jobdesc"]').val(result.data_jobdesc.id);
                        $('[name="id_jabatan_p"]').val(result.data_jobdesc.id_jabatan_p);
                        $('[name="atasan_ubah"]').val(result.data_jobdesc.atasan).trigger('change');
						             CKEDITOR.instances.ruanglingkup_ubah.setData(result.data_jobdesc.ruang_lingkup);
                        $('[name="hub_kedalam_ubah"]').val(result.data_jobdesc.hub_kedalam).trigger('change');
                        $('[name="hub_keluar_ubah"]').val(result.data_jobdesc.hub_keluar).trigger('change');
                        $('[name="limpahan_wewenang_ubah"]').val(result.data_jobdesc.limpahan_wewenang).trigger('change');
                        $('#modal-ubah-jobdesc').modal('show');
                    }
                })
			 };

       ubahTugas = function (id) {
                 $.ajax({
                     url: '{{ url('ubah-tugas') }}/'+id,
                     dataType : 'json',
                     success:function (result) {
                         $('[name="id_tugas"]').val(result.data_tugas.id);
                         $('[name="id_jobdesc"]').val(result.data_tugas.id_jobdesc);
                         $('[name="item_tugas_ubah"]').val(result.data_tugas.item_tugas).trigger('change');
                         $('#modal-ubah-tugas').modal('show');
                     }
                 })
 			  };

        ubahTanggungjawab = function (id) {
                  $.ajax({
                      url: '{{ url('ubah-tanggungjawab') }}/'+id,
                      dataType : 'json',
                      success:function (result) {
                          $('[name="id_tjb"]').val(result.data_tjb.id);
                          $('[name="id_jobdesc"]').val(result.data_tjb.id_jobdesc);
                          $('[name="item_tjb_ubah"]').val(result.data_tjb.item_tjb).trigger('change');
                          $('#modal-ubah-tanggungjawab').modal('show');
                      }
                  })
  			  };

          ubahWewenang = function (id) {
                    $.ajax({
                        url: '{{ url('ubah-wewenang') }}/'+id,
                        dataType : 'json',
                        success:function (result) {
                            $('[name="id_wewenang"]').val(result.data_wewenang.id);
                            $('[name="id_jobdesc"]').val(result.data_wewenang.id_jobdesc);
                            $('[name="item_wewenang_ubah"]').val(result.data_wewenang.item_wewenang).trigger('change');
                            $('#modal-ubah-wewenang').modal('show');
                        }
                    })
    			  };



		})


  </script>
@stop
