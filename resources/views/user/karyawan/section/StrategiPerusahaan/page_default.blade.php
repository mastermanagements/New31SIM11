@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Strategi Perusahaan
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Strategi Jangka Panjang</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Strategi Eksekutif</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Strategi Manager</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Strategi Supervisor</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Strategi Staf</a></li>
                        <li class="pull-right"><a href="{{ url('Target-Perusahaan') }}">Target Perusahaan</a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- Strategi Jangka Panjang Perusahaan -->
                        <div class="tab-pane active" id="tab_1">
                            @if(!empty($sjp))
                            @foreach($sjp as $value)
                            <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Strategi Jangka Panjang Perusahaan</h3>
                                      <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                     </div>
                                      <!-- /.box-tools -->
                                </div>
                                <div class="box-body">
                                    <ul>
                                      <form action="{{ url('hapus-sjp/'. $value->id) }}" method="post">
                                          <input type="hidden" name="_method" value="put">
                                          {{ csrf_field() }}
                                          <button type="submit" onclick="return confirm('apakah anda akan menghapus data target jangka panjang perusahaan anda?.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                          <a href="#" onclick="ubahSJP({{ $value->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target jangka panjang perusahaan">
                                          <i class="fa fa-edit"></i></a>
                                      </form>
                                      <div class="col-md-12">
                                        <div class="box-footer no-padding">
                                          <ul class="nav nav-stacked">
                                            <dl>
                                                <dd>{!! $value->isi !!}</dd>
                                            </dl>
                                          </ul>
                                        </div>
                                      </div>
                                    </ul>
                                </div>
                                <!-- /.box body -->
                        </div>
                          <!-- /.box primary -->
                        @endforeach
                        @endif
                      </div>
                      <!-- /.tab-pane 1-->

                      <div class="tab-pane" id="tab_2">
                          @foreach($jabatan_p as $jabat)
                            @foreach($jabat->getTargetEks->groupBy('id_jabatan_p') as $jabatan => $values)
                              <div class="box box-primary collapsed-box">
                                  <div class="box-header with-border">
                                    <h3 class="box-title">
                                        {{ $jabat->nm_jabatan }}
                                    </h3>
                                        <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                       </div>
                                        <!-- /.box-tools -->
                                  </div>
                                  <!-- ./box-header-->
                                    @foreach($target_eks_group as $group)
                                      @if ($group->id_jabatan_p == $jabat->id)
                                      <div class="box-header">
                                          <h3 class="box-title">{{ $group->tahun  }} </h3>
                                      </div>
                                        <div class="box-body">
                                          @foreach($target_eks as $targetEks)
                                            @foreach($sekutif as $strategiEks)
                                              @if($strategiEks->id_teks == $targetEks->id)
                                                @if($targetEks->tahun == $group->tahun)
                                                  @if($targetEks->id_jabatan_p == $jabat->id)
                                                    <ul>
                                                      <li>
                                                        <b>{{ $strategiEks->nama }}</b>
                                                        <form action="{{ url('hapus-sekutif/'. $strategiEks->id) }}" method="post">
                                                          <input type="hidden" name="_method" value="put">
                                                          {{ csrf_field() }}
                                                          <button type="submit" onclick="return confirm('apakah anda akan menghapus data strategi eksekutif perusahaan anda?.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                                            <a href="#" onclick="ubahSEks({{ $strategiEks->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target strategi eksekutif perusahaan">
                                                              <i class="fa fa-edit"></i>
                                                            </a>
                                                        </form>
                                                      </li>
                                                    </ul>
                                                      <div class="col-md-12">
                                                        <div class="box-footer no-padding">
                                                          <ul class="nav nav-stacked">
                                                            <dl>
                                                              <dd>{!! $strategiEks->isi !!}</dd>
                                                            </dl>
                                                          </ul>
                                                        </div>
                                                          <!--col-box-ffoter-->
                                                      </div>
                                                        <!--./col-md-12-->
                                                  @endif
                                                @endif
                                              @endif
                                            @endforeach
                                          @endforeach
                                        </div>
                                          <!-- ./box-body-->
                                      @endif
                                    @endforeach
                              </div>
                              <!-- ./box box-primary-->
                            @endforeach
                          @endforeach
                      </div>
                      <!-- /.tab-pane 2-->

                      <div class="tab-pane" id="tab_3">
                          @foreach($jabatan_p as $jabat)
                            @foreach($jabat->getTargetMan->groupBy('id_jabatan_p') as $jabatan => $values)
                              <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">
                                      {{ $jabat->nm_jabatan }}
                                  </h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                     </div>
                                      <!-- /.box-tools -->
                                </div>
                                 <!-- /.box-header-->
                                 @foreach($target_man_group as $group)
                                   @if ($group->id_jabatan_p == $jabat->id)
                                   <div class="box-header">
                                       <h3 class="box-title">{{ $group->tahun  }} </h3>
                                   </div>
                                     <div class="box-body">
                                       @foreach($target_man as $targetMan)
                                         @foreach($sman as $strategiMan)
                                           @if($strategiMan->id_tman == $targetMan->id)
                                             @if($targetMan->tahun == $group->tahun)
                                               @if($targetMan->id_jabatan_p == $jabat->id)
                                                 <ul>
                                                   <li>
                                                     <b>{{ $strategiMan->nama }}</b>
                                                     <form action="{{ url('hapus-sman/'. $strategiMan->id) }}" method="post">
                                                       <input type="hidden" name="_method" value="put">
                                                       {{ csrf_field() }}
                                                       <button type="submit" onclick="return confirm('apakah anda akan menghapus data strategi manager perusahaan anda?.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                                         <a href="#" onclick="ubahSMan({{ $strategiMan->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target strategi manager perusahaan">
                                                           <i class="fa fa-edit"></i>
                                                         </a>
                                                     </form>
                                                   </li>
                                                 </ul>
                                                   <div class="col-md-12">
                                                     <div class="box-footer no-padding">
                                                       <ul class="nav nav-stacked">
                                                         <dl>
                                                           <dd>{!! $strategiMan->isi !!}</dd>
                                                         </dl>
                                                       </ul>
                                                     </div>
                                                       <!--col-box-ffoter-->
                                                   </div>
                                                     <!--./col-md-12-->
                                               @endif
                                             @endif
                                           @endif
                                         @endforeach
                                       @endforeach
                                     </div>
                                       <!-- ./box-body-->
                                   @endif
                                 @endforeach
                              </div>
                              <!-- ./box-primary-->
                            @endforeach
                          @endforeach
                      </div>
                      <!-- /.tab-pane 4-->
                      <div class="tab-pane" id="tab_4">
                          @foreach($jabatan_p as $jabat)
                            @foreach($jabat->getTargetSup->groupBy('id_jabatan_p') as $jabatan => $values)
                              <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">
                                      {{ $jabat->nm_jabatan }}
                                  </h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                     </div>
                                      <!-- /.box-tools -->
                                </div>
                                 <!-- /.box-header-->
                                 @foreach($target_sup_group as $group)
                                   @if ($group->id_jabatan_p == $jabat->id)
                                   <div class="box-header">
                                       <h3 class="box-title">{{ $group->tahun  }} </h3>
                                   </div>
                                     <div class="box-body">
                                       @foreach($target_sup as $targetSup)
                                         @foreach($ssup as $strategiSup)
                                           @if($strategiSup->id_tsup == $targetSup->id)
                                             @if($targetSup->tahun == $group->tahun)
                                               @if($targetSup->id_jabatan_p == $jabat->id)
                                                 <ul>
                                                   <li>
                                                     <b>{{ $strategiSup->nama }}</b>
                                                     <form action="{{ url('hapus-ssup/'. $strategiSup->id) }}" method="post">
                                                       <input type="hidden" name="_method" value="put">
                                                       {{ csrf_field() }}
                                                       <button type="submit" onclick="return confirm('apakah anda akan menghapus data strategi supervisor perusahaan anda?.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                                         <a href="#" onclick="ubahSSup({{ $strategiSup->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target strategi supervisor perusahaan">
                                                           <i class="fa fa-edit"></i>
                                                         </a>
                                                     </form>
                                                   </li>
                                                 </ul>
                                                   <div class="col-md-12">
                                                     <div class="box-footer no-padding">
                                                       <ul class="nav nav-stacked">
                                                         <dl>
                                                           <dd>{!! $strategiSup->isi !!}</dd>
                                                         </dl>
                                                       </ul>
                                                     </div>
                                                       <!--col-box-ffoter-->
                                                   </div>
                                                     <!--./col-md-12-->
                                               @endif
                                             @endif
                                           @endif
                                         @endforeach
                                       @endforeach
                                     </div>
                                       <!-- ./box-body-->
                                   @endif
                                 @endforeach
                              </div>
                              <!-- ./box-primary-->
                            @endforeach
                          @endforeach
                      </div>
                      <!-- /.tab-pane 4-->

                      <div class="tab-pane" id="tab_5">
                        @if(!empty($target_staf))
                          @foreach($target_sup as $supervisor)
                            @foreach($supervisor->getTargetStaf->groupBy('id_target_superv') as $super => $values)
                              <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">
                                      {{ $supervisor->tahun }}
                                  </h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                                     </div>
                                      <!-- /.box-tools -->
                                </div>
                                 <!-- /.box-header-->
                                 @foreach($target_staf_bln as $group_bl)
                                   @if ($group_bl->id_target_superv == $supervisor->id)
                                      <div class="box-header">
                                        <h3 class="box-title">{{ $group_bl->bulan }} </h3>
                                      </div>
                                      <!-- ./box box-default -->
                                        @foreach($target_staf_ky as $group_ky)
                                          @if ($group_ky->bulan == $group_bl->bulan)
                                            <div class="box-header">
                                              <li><h3 class="box-title">{{ $group_ky->getKaryawan->nama_ky  }} </h3></li>
                                            </div>

                                            <div class="box-body">
                                              @foreach($target_staf as $targetStaf)
                                                @foreach($sstaf as $strategiStaf)
                                                  @if($strategiStaf->id_tstaf == $targetStaf->id)
                                                    @if($targetStaf->nm_karyawan == $group_ky->nm_karyawan)
                                                      @if($targetStaf->bulan == $group_bl->bulan)
                                                        @if($targetStaf->id_target_superv == $supervisor->id)
                                                        <ul>
                                                            <li>
                                                                <b>{{ $strategiStaf->nama }}</b>
                                                                  <form action="{{ url('hapus-sstaf/'. $strategiStaf->id) }}" method="post">
                                                                    <input type="hidden" name="_method" value="put">
                                                                      {{ csrf_field() }}
                                                                      <button type="submit" onclick="return confirm('apakah anda akan menghapus data strategi supervisor perusahaan anda?.')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                                                      <a href="#" onclick="ubahSStaf({{ $strategiStaf->id }})" class="btn btn-xs btn-primary pull-right" title="ubah target strategi supervisor perusahaan">
                                                                        <i class="fa fa-edit"></i>
                                                                      </a>
                                                                    </form>
                                                            </li>
                                                        </ul>
                                                          <div class="col-md-12">
                                                              <div class="box-footer no-padding">
                                                                  <ul class="nav nav-stacked">
                                                                    <dl>
                                                                      <dd>{!! $strategiStaf->isi !!}</dd>
                                                                    </dl>
                                                                  </ul>
                                                              </div>
                                                              <!--col-box-ffoter-->
                                                         </div>
                                                         <!--./col-md-12-->
                                                  @endif
                                               @endif
                                             @endif
                                           @endif
                                         @endforeach
                                       @endforeach
                                     </div>
                                       <!-- ./box-body-->
                                       @endif
                                     @endforeach
                                   @endif
                                 @endforeach
                              </div>
                              <!-- ./box-primary-->
                            @endforeach
                          @endforeach
                        @endif
                      </div>
                      <!-- /.tab-pane 5-->
                    </div>
                    <!--- /.tab-content -->
                </div>
                <!--- /.nav-content-custom -->
            </div>
            <!--- /.col-md-12 -->
        </div>
        <!--- /.row -->
    </section>
    <!-- /.section-content -->
</div>
<!--- /.content-wrapper -->
  @include('user.karyawan.section.StrategiPerusahaan.include.modal');
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

      ubahSJP= function (id) {
             $.ajax({
                 url: '{{ url('ubah-sjp') }}/'+id,
                 dataType : 'json',
                 success:function (result) {

        //console.log(result.sjp.id_tjpg);

        $('[name="id_tjpg_ubah"]').val(result.sjp.id_tjpg);
        CKEDITOR.instances.isi_ubah.setData(result.sjp.isi);
        $('[name="id_spj_ubah"]').val(result.sjp.id);
         $('#modal-ubah-sjp').modal('show');
                 }
             })
      };

      ubahSEks= function (id) {
             $.ajax({
                 url: '{{ url('ubah-sekutif') }}/'+id,
                 dataType : 'json',
                 success:function (result) {

        //console.log(result.sjp.id_tjpg);
        $('[name="id_seks_ubah"]').val(result.sekutif.id);
        $('[name="id_teks_ubah"]').val(result.sekutif.id_teks);
        $('[name="nama_ubah"]').val(result.sekutif.nama);
        CKEDITOR.instances.isi_eks_ubah.setData(result.sekutif.isi);
         $('#modal-ubah-sekutif').modal('show');
                 }
             })
      };
      ubahSMan= function (id) {
             $.ajax({
                 url: '{{ url('ubah-sman') }}/'+id,
                 dataType : 'json',
                 success:function (result) {

        //console.log(result.sjp.id_tjpg);
        $('[name="id_sman_ubah"]').val(result.sman.id);
        $('[name="id_tman_ubah"]').val(result.sman.id_tman);
        $('[name="nama_ubah"]').val(result.sman.nama);
        CKEDITOR.instances.isi_man_ubah.setData(result.sman.isi);
         $('#modal-ubah-man').modal('show');
                 }
             })
      };
      ubahSSup= function (id) {
             $.ajax({
                 url: '{{ url('ubah-ssup') }}/'+id,
                 dataType : 'json',
                 success:function (result) {

        //console.log(result.sjp.id_tjpg);
        $('[name="id_ssup_ubah"]').val(result.ssup.id);
        $('[name="id_tsup_ubah"]').val(result.ssup.id_tsup);
        $('[name="nama_ubah"]').val(result.ssup.nama);
        CKEDITOR.instances.isi_sup_ubah.setData(result.ssup.isi);
         $('#modal-ubah-sup').modal('show');
                 }
             })
      };
      ubahSStaf= function (id) {
             $.ajax({
                 url: '{{ url('ubah-sstaf') }}/'+id,
                 dataType : 'json',
                 success:function (result) {

        //console.log(result.sjp.id_tjpg);
        $('[name="id_sstaf_ubah"]').val(result.sstaf.id);
        $('[name="id_tstaf_ubah"]').val(result.sstaf.id_tstaf);
        $('[name="nama_ubah"]').val(result.sstaf.nama);
        CKEDITOR.instances.isi_staf_ubah.setData(result.sstaf.isi);
         $('#modal-ubah-staf').modal('show');
                 }
             })
      };

})

    </script>
@stop
