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

                    <h3 class="box-title">Daftar Akun</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @foreach($master_akun as $masterAkn)
                    <ul>
                        <p>{{ $masterAkn->kode_m_akun }}:{{ $masterAkn->nm_m_akun }}
                            <label class="pull-right">
                                <input type="checkbox" name="status" class="minimal-green" @if(!empty($masterAkn->hasMannyAkunUkm)) @if($masterAkn->hasMannyAkunUkm->id_m_akun == $masterAkn->id) checked @endif @endif value='@if(!empty($masterAkn->hasMannyAkunUkm)) @if($masterAkn->hasMannyAkunUkm->id_m_akun == $masterAkn->id) {{ $masterAkn->hasMannyAkunUkm->id }} @endif @else {{ $masterAkn->id }} @endif'>Simpan</label>
                            </label>
                        </p>
                        @if(!empty($masterAkn->manySubAkun))
                            @foreach($masterAkn->manySubAkun as $mannySubAkun)
                                <ul>
                                    <p>{{ $mannySubAkun->kode_m_sub_akun }}: {{ $mannySubAkun->nm_m_sub_akun }}
                                        <label class="pull-right" ><input type="checkbox" name="status" class="minimal" value='{{ $mannySubAkun->id_m_akun }}' @if($mannySubAkun->off_on=='1') checked  @endif> @if($mannySubAkun->off_on=='0') Tidak Aktif @else Aktif @endif</label></p>
                                    @if(!empty($mannySubAkun->manySubsub))
                                        @foreach($mannySubAkun->manySubsub as $subsubmenu)
                                        <ul>
                                          <p>  {{ $subsubmenu->kode_m_subsub_akun }}: {{ $subsubmenu->nm_m_subsub_akun }}
                                              <label class="pull-right"><input type="checkbox" name="status" class="minimal-red" value='{{ $subsubmenu->id_m_sub_akun }}' @if($mannySubAkun->off_on=='1') checked  @endif> @if($mannySubAkun->off_on=='0') Tidak Aktif @else Aktif @endif</label>
                                          </p>
                                        </ul>
                                        @endforeach
                                    @endif
                                </ul>
                            @endforeach
                        @endif
                    </ul>
                    @endforeach
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->
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

       $('.minimal-green').on('ifChecked', function (event) {
           $.ajax({
              url:"{{ url('store_master_akun_to_ukm') }}",
              type:"post",
              data: {
                  "_token":"{{ csrf_token() }}",
                  "id_akun_master": $(this).val()
              },
              success: function (result) {
                  alert("Berhasil diaktifkan");
              }
           });
       })
       $('.minimal-green').on('ifUnchecked', function (event) {
           $.ajax({
               url:"{{ url('nonaktif_master_akun_to_ukm') }}",
               type:"post",
               data: {
                   "_token":"{{ csrf_token() }}",
                   "id_akun_master": $(this).val()
               },
               success: function (result) {
                   alert("Berhasil dinonaktifkan");
               }
           });
       })

       $('.minimal').on('ifChecked', function (event) {
           console.log($(this).val())
       })
   </script>
@stop

