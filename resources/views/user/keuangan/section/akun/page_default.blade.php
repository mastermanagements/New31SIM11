@extends('user.keuangan.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop
@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Akun
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->

            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-text-width"></i>
                    <h3 class="box-title">{{ $title }}</h3>
                    <a href="{{ url('Akun') }}" class="btn btn-xs btn-primary pull-right" style="margin-left: 5px">Ke Halaman Awal</a>
                    <a href="{{ url('daftar-akun') }}" class="btn btn-xs btn-success pull-right">Lihat daftar Akun Anda</a>
					 @if(!empty(session('message_success')))
							<p style="color: green; text-align: center">*{{ session('message_success')}}</p>
						@elseif(!empty(session('message_fail')))
							<p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
					 @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($menu=="peng_akun")
                        <form action="{{ url('store_master_akun_to_ukm') }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="form-control"><font color="#FF3D33">Klik Untuk memindahkan daftar akun dibawah ini ke akun UKM Anda</font></button>
                        @foreach($master_akun as $masterAkn)
                    <ul>
                        <p>{{ $masterAkn->kode_m_akun }}:{{ $masterAkn->nm_m_akun }}
                            <label class="pull-right">
                                <input type="checkbox" name="id_akun_master[]" class="minimal-green" @if(!empty($masterAkn->hasMannyAkunUkm)) @if($masterAkn->hasMannyAkunUkm->id_m_akun == $masterAkn->id) checked @endif @else  @endif value='@if(!empty($masterAkn->hasMannyAkunUkm)) @if($masterAkn->hasMannyAkunUkm->id_m_akun == $masterAkn->id) {{ $masterAkn->hasMannyAkunUkm->id }} @endif @else {{ $masterAkn->id }} @endif'>@if(!empty($masterAkn->hasMannyAkunUkm)) @if($masterAkn->hasMannyAkunUkm->id_m_akun == $masterAkn->id) Aktif @endif @else Tidak Aktif @endif</label>
                            </label>
                        </p>
                            @if(!empty($masterAkn->manySubAkun))
                                @foreach($masterAkn->manySubAkun as $mannySubAkun)
                                        <ul>
                                            <p>{{ $mannySubAkun->kode_m_sub_akun }}: {{ $mannySubAkun->nm_m_sub_akun }}
                                                <label class="pull-right" >
                                                    <input type="checkbox"  disabled class="minimal" value='{{ $mannySubAkun->id }}' @if($mannySubAkun->off_on=='1') checked  @endif> @if($mannySubAkun->off_on=='0') Tidak Aktif @else Aktif @endif
                                                </label>
                                            </p>
                                            @if(!empty($mannySubAkun->manySubsub))
                                                @foreach($mannySubAkun->manySubsub as $subsubmenu)
                                                <ul>
                                                  <p>  {{ $subsubmenu->kode_m_subsub_akun }}: {{ $subsubmenu->nm_m_subsub_akun }}
                                                      <label class="pull-right"><input type="checkbox" disabled name="id_m_akun_sub_sub" class="minimal-red"  value='{{ $subsubmenu->id_m_sub_akun }}' @if($subsubmenu->off_on=='1') checked @else checked @endif> @if($subsubmenu->off_on=='1') Aktif @else Tidak Aktif @endif</label>
                                                  </p>
                                                </ul>
                                                @endforeach
                                            @endif
                                        </ul>
                                @endforeach

                            @else

                            @endif

                    </ul>
                    @endforeach
                    </form>
                    @else

                        <form action="{{ url('tambah-ke-akun-aktif') }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="form-control"><i class="fa fa-repeat"></i> <font color="#DE5B06">Aktifkan Akun UKM Anda</font></button>
                            @foreach($akun_ukm as $akun_ukm)

                            <ul>
                                <p>
                                    {{ $akun_ukm->kode_akun }} :{{ $akun_ukm->nm_akun }}
                                    <button type="button" class="btn btn-xs btn-primary pull-right" onclick="tambah_sub_akun('{{ $akun_ukm->id }}')" style="margin-left: 5px"><i class="fa fa-plus"></i> Tambah Sub akun</button>
                                    <label class="pull-right">
                                        <input type="checkbox" name="akun_ukm[]" class="minimal-green" value="{{ $akun_ukm->id }}" checked> Aktif
                                    </label>
                                </p>
                                @foreach($akun_ukm->sub_akun_ukm as $sub_akun_ukm)
                                    <ul>
                                        <p>
                                            {{ $sub_akun_ukm->kode_sub_akun }} :{{ $sub_akun_ukm->nm_sub_akun }}
                                            <button type="button" class="btn btn-xs btn-danger pull-right" onclick="hidden_akun_sub('{{ $sub_akun_ukm->id }}')" style="margin-left: 5px">@if($sub_akun_ukm->off_on=='1')<i class="fa fa-eye-slash"></i> Sembunyikan @else <i class="fa fa-eye"></i> Munculkan @endif  </button>
                                            <button type="button" class="btn btn-xs btn-warning pull-right" onclick="ubah_sub_akun('{{ $sub_akun_ukm->id }}')" style="margin-left: 5px"><i class="fa fa-pencil"></i> ubah Sub akun</button>
                                            <button type="button" class="btn btn-xs btn-primary pull-right" onclick="tambah_sub_sub_akun('{{ $sub_akun_ukm->id }}')" style="margin-left: 5px"><i class="fa fa-plus"></i> Tambah Sub-sub akun</button>
                                            <label class="pull-right">
                                                <input type="checkbox" name="akun_ukm" class="minimal" @if($sub_akun_ukm->off_on=='1') checked @php($status_sub_aktif="Aktif") @else @php($status_sub_aktif="Tidak Aktif") @endif disabled> {{ $status_sub_aktif }}
                                            </label>
                                        </p>
                                        @foreach($sub_akun_ukm->subsub_ukm as $subsub_ukm)
                                            <ul>
                                                <p>
                                                    {{ $subsub_ukm->kode_subsub_akun }} :{{ $subsub_ukm->nm_subsub_akun }}
                                                    <button type="button" class="btn btn-xs btn-danger pull-right" onclick="hidden_akun_sub_sub('{{ $subsub_ukm->id }}')" style="margin-left: 5px">@if($subsub_ukm->off_on=='1')<i class="fa fa-eye-slash"></i> Sembunyikan @else <i class="fa fa-eye"></i> Munculkan @endif  </button>
                                                    <button type="button" class="btn btn-xs btn-warning pull-right" onclick="edit_akun_sub_sub('{{ $subsub_ukm->id }}')"> <i class="fa fa-pencil"></i> Sub Sub Akun</button>
                                                    <label class="pull-right">
                                                        <input type="checkbox" name="akun_ukm" class="minimal-red" @if($subsub_ukm->off_on=='1') checked @php($status_sub_sub_aktif="Aktif") @else @php($status_sub_sub_aktif="Tidak Aktif") @endif disabled/> {{ $status_sub_sub_aktif }} -
                                                    </label>
                                                </p>
                                            </ul>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </ul>
                        @endforeach
                        </form>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->

    @include('user.keuangan.section.akun.modal.modal_sub_sub_akun')
</div>
@stop


@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>

   <script>
       $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
           checkboxClass: 'icheckbox_minimal-blue',
           radioClass   : 'iradio_minimal-blue'
       })

       //Red color scheme for iCheck
       $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
           checkboxClass: 'icheckbox_minimal-red',
           radioClass   : 'iradio_minimal-red'
       })
       $('input[type="checkbox"].minimal-green, input[type="radio"].minimal-green').iCheck({
           checkboxClass: 'icheckbox_minimal-green',
           radioClass   : 'iradio_minimal-green'
       })

       edit_akun_sub_sub = function (id) {
           $.ajax({
               url: "{{ url('edit-sub-sub-akun') }}/"+ id,
               dataType: "json",
               success: function (result) {
                   $('[name="kode_sub_sub"]').val(result.kode_subsub_akun);
                   $('[name="nm_sub_sub"]').val(result.nm_subsub_akun);
                   $('[name="id_sub_sub"]').val(result.id);
                   $('#formulir_sub_sub').attr('action','update-sub-sub-akun');

               }
           })
            $('#modal-sub-sub-akun').modal('show')
       }

       hidden_akun_sub_sub = function (id) {
           $.ajax({
               url: "{{ url('hidden-sub-sub-akun') }}/"+ id,
               type: 'post',
               data :{
                 '_token': '{{ csrf_token() }}'
               },
               success: function (result) {
                   window.location.reload();
               }
           })
       }

       hidden_akun_sub = function (id) {
           $.ajax({
               url: "{{ url('hidden-sub-akun') }}/"+ id,
               type: 'post',
               data :{
                 '_token': '{{ csrf_token() }}'
               },
               success: function (result) {
                   window.location.reload();
               }
           })
       }
       tambah_sub_sub_akun = function (id) {
           $('[name="id_sub_akun_ukm"]').val(id);
           $('#formulir_sub_sub').attr('action','store-sub-sub-akun')
           $('#modal-sub-sub-akun').modal('show')
       }

       tambah_sub_akun = function (id) {
           $('[name="id_akun_ukm"]').val(id);
           $('#formulir_sub').attr('action','store-sub-akun')
           $('#modal-sub-akun').modal('show')
       }

       ubah_sub_akun = function (id) {
           $.ajax({
               url:"{{ url('edit-sub-akun') }}/"+id,
               dataType: "json",
               success:function (result) {
                   console.log(result);
                   $('[name="kode_sub"]').val(result.kode_sub_akun);
                   $('[name="nm_sub"]').val(result.nm_sub_akun);
                   $('[name="id_sub"]').val(result.id);
				   $('[name="posisi_saldo"]').val(result.posisi_saldo).trigger('change');
                   $('#formulir_sub').attr('action','update-sub-akun');
                   $('#modal-sub-akun').modal('show');
               }
           })
       }

       hidden_akun_sub = function (id) {
           $.ajax({
               url: "{{ url('hidden-sub-akun') }}/"+ id,
               type: 'post',
               data :{
                   '_token': '{{ csrf_token() }}'
               },
               success: function (result) {
                   window.location.reload();
               }
           })
       }
   </script>
@stop
