@extends('user.hrd.master_user')
@section('skin')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Item Keahliah
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Daftar Jabatan dan Item Keahlian</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">

                                @foreach($jabatan as $jabatans)
                                    <div class="col-md-12">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">{{ $jabatans->nm_jabatan }}</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool tambah_item " style="color: #0b93d5" value="{{ $jabatans->id }}"><i class="fa fa-plus"></i> Tambah item</button>
                                            </div>
                                            <!-- /.box-tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">

                                                @if(!empty($jabatans->item_keahlian))
                                                    <div class="row">
                                                    @foreach($jabatans->item_keahlian as $item_keahlian)
                                                       <div class="col-md-10" style="width: 90%">
                                                           {!! $item_keahlian->item_tes_keahlian !!}
                                                           <hr>
                                                       </div>

                                                       <div class="col-md-1">
                                                            <button class="btn btn-box-tool tombol_ubah" value="{{ $item_keahlian->id }}" style="color: orange"><i class="fa fa-pencil"></i> Ubah Item</button>
                                                            <button class="btn btn-box-tool tombol_hapus" value="{{ $item_keahlian->id }}" style="color: red"><i class="fa fa-eraser"></i> Hapus Item</button>
                                                       </div>
                                                     @endforeach
                                                    </div>
                                                @else
                                                    <h5>Belum ada item keahlian</h5>
                                                @endif

                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                @endforeach

                            </div>
                        </div>

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
    @include('user.hrd.section.tes.keahlian.itemkeahlian.modal.modal')
@stop

@section('plugins')
    <script>
        $(document).ready(function () {

            CKEDITOR.replace( 'item_keahlian',{
                height: 300
            } );
            CKEDITOR.replace( 'item_ubah_keahlian',{
                height: 300
            } );

            $('.tambah_item').click(function () {
                $('[name="id_jabatan_p"]').val($(this).val());
               $('#modal-tambah-item-keahlian').modal('show');
            });

            $('.tombol_ubah').click(function () {
               $.ajax({
                   url: "{{ url('ubah-item-keahlian') }}/"+$(this).val(),
                   dataType: "json",
                   success:function (result) {
                       $('[name="id_item_keahlian"]').val(result.id);
                       CKEDITOR.instances.item_ubah_keahlian.setData(result.item_tes_keahlian);
                       $('#modal-ubah-item-keahlian').modal('show');
                   }
               })
            });

            $('.tombol_hapus').click(function () {
               if(confirm('Apakah Anda akan menghapus item ini ...?')==true){
                   $.ajax({
                       url: "{{ url('hapus-item-keahlian') }}",
                       type: 'post',
                       data : {
                           '_token': "{{ csrf_token() }}",
                           'id_item': $(this).val(),
                       },
                       success: function (result) {
                           alert(result.message);
                           window.location.reload()
                       }
                   })
               }else{
                   alert("Proses hapus telah dibatalkan");
               }
            });
        });
    </script>
@stop