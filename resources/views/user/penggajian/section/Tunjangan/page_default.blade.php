@extends('user.penggajian.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li @if(Session::get('menu_tun')=="itemTunjangan") class="active" @endif><a href="{{ url('item-tunjangan') }}" >Item Tunjangan</a></li>
                        <li @if(Session::get('menu_tun')=="SkalaTunjangan") class="active" @endif ><a href="{{ url('Skala-tunjangan') }}">Skala Tunjangan</a></li>
                        <li @if(Session::get('menu_tun')=="TunjanganGaji") class="active" @endif ><a href="{{ url('TunjanganGaji') }}" >Tunjangan Gaji</a></li>
                        <li @if(Session::get('menu_tun')=="KelasProyek") class="active" @endif ><a href="{{ url('Kelas-proyek') }}" >Kelas Proyek</a></li>
                        <li @if(Session::get('menu_tun')=="BonusProyek") class="active" @endif ><a href="{{ url('Bonus-proyek') }}" >Bonus Proyek</a></li>
                        <li class="pull-left header"><i class="fa fa-th"></i> Tunjangan Gaji</li>
                    </ul>
                    <div class="tab-content">
                        @if(Session::get('menu_tun')=="itemTunjangan")
                            <div class="tab-pane  @if(Session::get('menu_tun')=="itemTunjangan") active @endif" id="tab_1-1">
                                @include('user.penggajian.section.Tunjangan.item_tunjangan.page')
                            </div>
                        @elseif(Session::get('menu_tun')=="SkalaTunjangan")
                            <div class="tab-pane  @if(Session::get('menu_tun')=="SkalaTunjangan") active @endif" id="tab_2-2">
                                @include('user.penggajian.section.Tunjangan.skala_tunjangan.page2')
                            </div>
                        @elseif(Session::get('menu_tun')=="TunjanganGaji")
                            <div class="tab-pane  @if(Session::get('menu_tun')=="TunjanganGaji") active @endif" id="tab_3-3">
                                @include('user.penggajian.section.Tunjangan.tunjangan_gaji.page')
                            </div>
                        @elseif(Session::get('menu_tun')=="KelasProyek")
                            <div class="tab-pane  @if(Session::get('menu_tun')=="KelasProyek") active @endif" id="tab_4-4">
                                @include('user.penggajian.section.Tunjangan.klas_proyek.page')
                            </div>
                        @elseif(Session::get('menu_tun')=="BonusProyek")
                            <div class="tab-pane  @if(Session::get('menu_tun')=="BonusProyek") active @endif" id="tab_5-5">
                                @if(!empty(Session::get('menu_sub_tun')) && Session::get('menu_sub_tun') =='SkalaBonusProyek')
                                    @include('user.penggajian.section.Tunjangan.skala_tunjangan.page')
                                @else
                                    @include('user.penggajian.section.Tunjangan.bonus_proyek.page')
                                @endif
                            </div>
                        @endif

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

    <script>
        $('.select2').select2()

        update_item_tunjangan= function (id) {
            $.ajax({
                url: "{{ url('edit-item-tunjangan') }}/"+id,
                dataType:'json',
                success: function (data) {
                    console.log(data)
                    $('[name="nm_tunjangan"]').val(data.nm_tunjangan);
                    $('[name="id"]').val(data.id);
                    $('#formulir_item_tunjangan').attr('action','update-item-tunjangan');
                }
            })
        }
        update_skala_tunjangan= function (id) {
            $.ajax({
                url: "{{ url('edit-skala-tunjangan') }}/"+id,
                dataType:'json',
                success: function (data) {
                    console.log(data)
                    $('[name="id_jabatan"]').val(data.id_jabatan).trigger('change');
                    $('[name="id_item_tunjangan"]').val(data.id_item_tunjangan).trigger('change');
                    $('[name="besar_tunjangan"]').val(data.besar_tunjangan);
                    $('[name="id"]').val(data.id);
                    $('#formulir_skala_tunjangan').attr('action','update-skala-tunjangan');
                }
            })
        }

        update_kelas_proyek= function (id) {
            $.ajax({
                url: "{{ url('edit-kelas-proyek') }}/"+id,
                dataType:'json',
                success: function (data) {
                    console.log(data)
                    $('[name="nm_kelas"]').val(data.nm_kelas);
                    $('[name="keterangan"]').val(data.keterangan);
                    $('[name="persen_besar_proyek"]').val(data.persen_besar_proyek);
                    $('[name="id"]').val(data.id);
                    $('#formulir_kelas_proyek').attr('action','update-kelas-proyek');
                }
            })
        }

        statuOnSkala = function (id) {
            if(confirm('apakah anda akan mengubah status skala tunjangan ini ... ?')){
                $.ajax({
                    url:"{{ url('status-skala-on') }}/"+id,
                    type:"post",
                    data: {
                        "_method": "put",
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (result) {
                        window.location.reload();
                    }
                })
            }else{
                alert('Proses dibatalkan');
            }
        }
        statuOffSkala = function (id) {
            if(confirm('apakah anda akan mengubah status skala tunjangan ini ... ?')){
                $.ajax({
                    url:"{{ url('status-skala-off') }}/"+id,
                    type:"post",
                    data: {
                        "_method": "put",
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (result) {
                        window.location.reload();
                    }
                })
            }else{
                alert('Proses dibatalkan');
            }
        }

    </script>
@stop