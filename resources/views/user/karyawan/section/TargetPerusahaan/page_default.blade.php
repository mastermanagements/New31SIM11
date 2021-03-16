@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Target/Goal Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Target Jangka Panjang</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Target Eksekutif</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Target Manager</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Target Supervisor</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Target Staf</a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- Target Jangka Panjang Perusahaan -->
                        <div class="tab-pane active" id="tab_1">
                            <a href="{{ url('buat-tjp') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                            <p></p>
                            @if(!empty($tjp))
                            @foreach($tjp as $value)
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Target Jangka Panjang Perusahaan</h3>
                                      <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                     </div>
                                      <!-- /.box-tools -->
                                </div>
                                <div class="box-body">
                                    <ul>
                                      <form action="{{ url('hapus-tjp/'. $value->id) }}" method="post">
                                          <input type="hidden" name="_method" value="put">
                                          {{ csrf_field() }}
                                          <button type="submit" onclick="return confirm('apakah anda akan menghapus data target jangka panjang perusahaan anda?.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                          <a href="#" onclick="ubahTJP({{ $value->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target jangka panjang perusahaan">
                                          <i class="fa fa-edit"></i></a>
                                      </form>
                                      <div class="col-md-8">
                                        <div class="box-footer no-padding">
                                          <ul class="nav nav-stacked">
                                						<li><b>Jangka Waktu</b> <span class="pull-right">{!! $value->periode !!}&nbsp; Tahun</span> </li>
                                            <li><b>Tahun</b> <span class="pull-right">{!! $value->thn_mulai !!} - {!! $value->thn_selesai !!}</span></li>
                                          </ul>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="box-footer no-padding">
                                          <ul class="nav nav-stacked">
                                            <dl>
                                                <dt>Target:</dt>
                                                <dd>{!! $value->target_puncak !!}</dd>
                                            </dl>
                                          </ul>
                                        </div>
                                      </div>
                                      <div class="col-md-8">
                                        <div class="box-footer no-padding">
                                          <ul class="nav nav-stacked">
                                						<li><b>Jumlah Target</b> <span class="pull-right">{!! $value->jumlah_target !!}</span></li>
                                            <li><b>Satuan Target</b> <span class="pull-right">{!! $value->satuan_target !!} </span></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </ul>
                            </div>
                            <!-- /.box body -->
                        </div>
                          <!-- /.box success -->
                        @endforeach
                        @endif
                    </div>
                    <!-- /.tab-pane 1-->

                    <!-- Target Eksekutif -->
                    <div class="tab-pane" id="tab_2">
                        <a href="{{ url('buat-target-eks') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                        <p></p>
                        @foreach($jabatan_p as $jabat)
                          @foreach($jabat->getTargetEks->groupBy('id_jabatan_p') as $jabatan => $values)
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                  {{ $jabat->nm_jabatan }}
                                </h3>
                                  <div class="box-tools pull-right">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                 </div>
                                  <!-- /.box-tools -->
                            </div>
                            @foreach($target_eks_group as $group)
                            @if ($group->id_jabatan_p == $jabat->id)
                                <div class="box-header">
                                    <h3 class="box-title">{{ $group->tahun  }} </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Target Eksekutif</th>
                                            <th>Jumlah </th>
                                            <th>Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @php($i=1)
                                        @foreach($target_eks as $targetEks)
                                          @if($targetEks->tahun == $group->tahun)
                                            @if($targetEks->id_jabatan_p == $jabat->id)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td> {{ $targetEks->target_eksekutif }} </td>
                                            <td><span class="badge bg-yellow">{{ $targetEks->jumlah_target }} </span></td>
                                            <td><span class="badge bg-green">{{ $targetEks->satuan_target }} </span></td>
                                            <td>
                                              <form action="{{ url('hapus-target-eks/'. $targetEks->id) }}" method="post">
                                                  <input type="hidden" name="_method" value="put">
                                                  {{ csrf_field() }}
                                                  <button type="submit" onclick="return confirm('Yakin mau menghapus target Eksekutif ?, Jika anda menghapus data ini, maka target Manager, Supervisor dan Staf yg berhubungan dengan target eksekutif akan ikut terhapus.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                                  <a href="#" onclick="ubahTargetEks({{ $targetEks->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target Eksekutif">
                                                  <i class="fa fa-edit"></i></a>
                                              </form>
                                            </td>
                                        </tr>
                                           @endif
                                         @endif
                                       @endforeach
                                    </table>
                                </div>
                                  <!--- /. box-body-->
                                @endif
                              @endforeach
                        </div>
                      <!-- /.box success -->
                    @endforeach
                  @endforeach
                </div>
                <!-- /.tab-pane 2-->

                <!-- Target Manager -->
                <div class="tab-pane" id="tab_3">
                    <a href="{{ url('buat-target-man') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    <p></p>
                    @foreach($jabatan_p as $jabat)
                      @foreach($jabat->getTargetMan->groupBy('id_jabatan_p') as $jabatan => $values)
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                              {{ $jabat->nm_jabatan }}
                            </h3>
                              <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                             </div>
                              <!-- /.box-tools -->
                        </div>
                        @foreach($target_man_group as $group)
                        @if ($group->id_jabatan_p == $jabat->id)
                            <div class="box-header">
                                <h3 class="box-title">{{ $group->tahun  }} </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-condensed">
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Target Manager</th>
                                        <th>Jumlah </th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @php($i=1)
                                    @foreach($target_man as $targetMan)
                                      @if($targetMan->tahun == $group->tahun)
                                        @if($targetMan->id_jabatan_p == $jabat->id)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td> {{ $targetMan->target_manager }} </td>
                                        <td><span class="badge bg-yellow">{{ $targetMan->jumlah_target }} </span></td>
                                        <td><span class="badge bg-green">{{ $targetMan->satuan_target }} </span></td>
                                        <td>
                                          <form action="{{ url('hapus-target-man/'. $targetMan->id) }}" method="post">
                                              <input type="hidden" name="_method" value="put">
                                              {{ csrf_field() }}
                                              <button type="submit" onclick="return confirm('Yakin mau menghapus target Manager ?, Jika anda menghapus data ini, maka target Supervisor dan Staf yg berhubungan dengan target manager akan ikut terhapus.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                              <a href="#" onclick="ubahTargetMan({{ $targetMan->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target Manager">
                                              <i class="fa fa-edit"></i></a>
                                          </form>
                                        </td>
                                    </tr>
                                       @endif
                                     @endif
                                   @endforeach
                                </table>
                            </div>
                              <!--- /. box-body-->
                            @endif
                          @endforeach
                    </div>
                  <!-- /.box success -->
                @endforeach
              @endforeach
            </div>
            <!-- /.tab-pane 3-->

            <!-- Target Manager -->
            <div class="tab-pane" id="tab_4">
                <a href="{{ url('buat-target-sup') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                <p></p>
                @foreach($jabatan_p as $jabat)
                  @foreach($jabat->getTargetSup->groupBy('id_jabatan_p') as $jabatan => $values)
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                          {{ $jabat->nm_jabatan }}
                        </h3>
                          <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                         </div>
                          <!-- /.box-tools -->
                    </div>
                    @foreach($target_sup_group as $group)
                    @if ($group->id_jabatan_p == $jabat->id)
                        <div class="box-header">
                            <h3 class="box-title">{{ $group->tahun  }} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-condensed">
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Target Supervisor</th>
                                    <th>Jumlah </th>
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                                @php($i=1)
                                @foreach($target_sup as $targetSup)
                                  @if($targetSup->tahun == $group->tahun)
                                    @if($targetSup->id_jabatan_p == $jabat->id)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td> {{ $targetSup->target_supervisor }} </td>
                                    <td><span class="badge bg-yellow">{{ $targetSup->jumlah_target }} </span></td>
                                    <td><span class="badge bg-green">{{ $targetSup->satuan_target }} </span></td>
                                    <td>
                                      <form action="{{ url('hapus-target-sup/'. $targetSup->id) }}" method="post">
                                          <input type="hidden" name="_method" value="put">
                                          {{ csrf_field() }}
                                          <button type="submit" onclick="return confirm('Yakin mau menghapus target Supervisor ?, Jika anda menghapus data ini, maka target Staf yg berhubungan dengan target ager akan ikut terhapus.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                          <a href="#" onclick="ubahTargetSup({{ $targetSup->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target Supervisor">
                                          <i class="fa fa-edit"></i></a>
                                      </form>
                                    </td>
                                </tr>
                                   @endif
                                 @endif
                               @endforeach
                            </table>
                        </div>
                          <!--- /. box-body-->
                        @endif
                      @endforeach
                </div>
              <!-- /.box success -->
            @endforeach
          @endforeach
        </div>
        <!-- /.tab-pane 3-->

            </div>
              <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
    </section>
    <!-- /.content -->
</div>
	@include('user.karyawan.section.TargetPerusahaan.include.modal')
@stop

@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>

        $(function () {
            $('.select2').select2();
        });
        $(document).ready(function () {
            var ids;
         ubahTJP = function (id) {
                $.ajax({
                    url: '{{ url('ubah-tjp') }}/'+id,
                    dataType : 'json',
                    success:function (result) {
					    //console.log(result.data_target_eks.thn_mulai);
						$('[name="$id_tjp_ubah"]').val(result.tjp.id);
						$('[name="periode_ubah"]').val(result.tjp.periode);
						$('[name="thn_mulai_ubah"]').val(result.tjp.thn_mulai);
						$('[name="thn_selesai_ubah"]').val(result.tjp.thn_selesai);
						CKEDITOR.instances.target_puncak_ubah.setData(result.tjp.target_puncak);
            $('[name="jumlah_target_ubah"]').val(result.tjp.jumlah_target);
            $('[name="satuan_target_ubah"]').val(result.tjp.satuan_target);
            $('#modal-ubah-tjp').modal('show');
                    }
                })
			    };
          ubahTargetEks = function (id) {
                 $.ajax({
                     url: '{{ url('ubah-target-eks') }}/'+id,
                     dataType : 'json',
                     success:function (result) {
 					    //console.log(result.data_target_eks.thn_mulai);
 						$('[name="id_teks_ubah"]').val(result.target_eks.id);
 						$('[name="tahun_ubah"]').val(result.target_eks.tahun);
 						$('[name="id_bagian_p_ubah"]').val(result.target_eks.id_bagian_p).trigger('change');
 						$('[name="id_jabatan_p_ubah"]').val(result.target_eks.id_jabatan_p).trigger('change');
             $('[name="target_eksekutif_ubah"]').val(result.target_eks.target_eksekutif);
             $('[name="jumlah_target_ubah"]').val(result.target_eks.jumlah_target);
             $('[name="satuan_target_ubah"]').val(result.target_eks.satuan_target);
             $('#modal-ubah-target_eks').modal('show');
                     }
                 })
 			    };

          ubahTargetMan = function (id) {
                 $.ajax({
                     url: '{{ url('ubah-target-man') }}/'+id,
                     dataType : 'json',
                     success:function (result) {
 					    //console.log(result.data_target_eks.thn_mulai);
 						$('[name="id_tman_ubah"]').val(result.target_man.id);
            $('[name="id_target_eks_ubah"]').val(result.target_man.id_target_eks).trigger('change');
 						$('[name="tahun_ubah"]').val(result.target_man.tahun);
 						$('[name="id_bagian_p_ubah"]').val(result.target_man.id_bagian_p).trigger('change');
 						$('[name="id_jabatan_p_ubah"]').val(result.target_man.id_jabatan_p).trigger('change');
             $('[name="target_manager_ubah"]').val(result.target_man.target_manager);
             $('[name="jumlah_target_ubah"]').val(result.target_man.jumlah_target);
             $('[name="satuan_target_ubah"]').val(result.target_man.satuan_target);
             $('#modal-ubah-target_man').modal('show');
                     }
                 })
 			    };

          ubahTargetSup = function (id) {
                 $.ajax({
                     url: '{{ url('ubah-target-sup') }}/'+id,
                     dataType : 'json',
                     success:function (result) {
 					    //console.log(result.data_target_eks.thn_mulai);
 						$('[name="id_tsup_ubah"]').val(result.target_sup.id);
            $('[name="id_target_man_ubah"]').val(result.target_sup.id_target_man).trigger('change');
 						$('[name="tahun_ubah"]').val(result.target_sup.tahun);
 						$('[name="id_divisi_p_ubah"]').val(result.target_sup.id_divisi_p).trigger('change');
 						$('[name="id_jabatan_p_ubah"]').val(result.target_sup.id_jabatan_p).trigger('change');
             $('[name="target_supervisor_ubah"]').val(result.target_sup.target_manager);
             $('[name="jumlah_target_ubah"]').val(result.target_sup.jumlah_target);
             $('[name="satuan_target_ubah"]').val(result.target_sup.satuan_target);
             $('#modal-ubah-target_sup').modal('show');
                     }
                 })
 			    };


    })

    </script>
@stop
