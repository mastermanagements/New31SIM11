@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventory
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
                <div class="box box-primary">
                    @include('user.produksi.section.inventory.menu')
                    <div class="box-body">
                       @if($menu == 'stok_awal')
                            @include('user.produksi.section.inventory.stok_awal.page_default')
                       @elseif($menu == 'itemIO')
                            @include('user.produksi.section.inventory.itemIO.page_default')
                       @elseif($menu == 'stok_akhir')
                            @include('user.produksi.section.inventory.stok_akhir.page_default')
                       @elseif($menu == 'stok_opname')
                            @include('user.produksi.section.inventory.stok_opname.page_default')
                       @elseif($menu == 'perbaikan_stok')
                            @include('user.produksi.section.inventory.stok_opname.page_create')
                       @elseif($menu == 'history-barang')
                            @include('user.produksi.section.inventory.stok_opname.page_create')
                       @elseif($menu == 'ubah-history-barang')
                            @include('user.produksi.section.inventory.stok_opname.page_edit')
                       @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
@stop