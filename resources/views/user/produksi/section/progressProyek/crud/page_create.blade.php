@extends('user.administrasi.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Monitoring Proyek
        </h1>
		<h5 class="pull-right"><a href="{{ url('Proyek')}}">Kembali ke Halaman utama</a></h5>
		
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif

             <div class="col-md-12">
                 <div class="row">
                 <div class="col-md-12" style="padding-bottom: 15px">
                     <a href="#" data-toggle="modal" data-target="#modal-tambah-progress-proyek"  class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Tambah Progress</a>
                 </div>
                     <div class="col-md-12">
                         <ul class="timeline">
                             @foreach($data_progress as $value)
                             <li class="time-label">
                                  <span class="bg-red">
                                    {{ date('d M Y', strtotime($value->created_at)) }}
                                  </span>
                             </li>
                             <li>
                                             <i class="fa fa-envelope bg-blue"></i>

                                             <div class="timeline-item">
                                                 <span class="time"><i class="fa fa-clock-o"></i>  {{ date('H:i:s', strtotime($value->created_at)) }}</span>

                                                 <h3 class="timeline-header"><a href="#"><b>Pelaksana:</b>{{ $value->karyawan->nama_ky }}</a></h3>

                                                 <div class="timeline-body">
                                                     <p>
                                                         <b>Masalah:</b> <br>
                                                        {!! $value->masalah !!}
                                                         <hr>
                                                        <b>Solusi :</b><br>
                                                        {!! $value->solusi !!}
                                                        <hr>
                                                        <b>Rincian Pengerjaan :</b><br>
                                                        {!! $value->rincian_pekerjaan !!}
                                                        <hr>

                                                     </p>
                                                 </div>
                                                 <div class="timeline-footer">
                                                     @if(Session::get('id_karyawan') == $value->id_karyawan)
                                                        <button  value="{{ $value->id }}" id="ubah" class="btn btn-warning btn-xs">Ubah</button>
                                                        <button  value="{{ $value->id }}" id="hapus" class="btn btn-danger btn-xs">Hapus</button>

                                                     @endif
                                                     <label class="pull-right">Tanggal pengerjaan :
                                                     {{ date('d-m-Y', strtotime($value->tgl_dikerjakan)) }}
                                                     </label>
                                                 </div>
                                             </div>
                                         </li>
                            @endforeach
                         </ul>
                     </div>
                 </div>
            </div>

        </div>
    </section>

    @include('user.produksi.section.progressProyek.crud.modal.modal')

</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        $('#content_modal').slimScroll({
            height: '450px'
			
        });
        $('#content_modal_update').slimScroll({
            height: '450px'
        });

        window.onload = function() {
            CKEDITOR.replace( 'masalah',{
                height: 185
            } );
            CKEDITOR.replace( 'solusi',{
                height: 100
            } );
            CKEDITOR.replace( 'rincian_pekerjaan',{
                height: 100
            } );

            var editor_masalah=CKEDITOR.replace( 'masalah_ubah',{
                height: 185
            } );
            CKEDITOR.replace( 'solusi_ubah',{
                height: 100
            } );
            CKEDITOR.replace( 'rincian_pekerjaan_ubah',{
                height: 100
            } );
        };

        $('#ubah').click(function () {
           $.ajax({
               url: '{{ url('ubah-progress-jadwal') }}/'+$(this).val(),
               dataType: 'json',
               success:function (result) {
                   CKEDITOR.instances.masalah_ubah.setData(result.masalah);
                   CKEDITOR.instances.solusi_ubah.setData(result.solusi);
                   CKEDITOR.instances.rincian_pekerjaan_ubah.setData(result.rincian_pekerjaan);
                   $('[name="tgl_dikerjakan_ubah"]').val(moment(result.tgl_dikerjakan).format('DD-MM-YYYY'));
                   $('[name="id_progress_proyek"]').val(result.id);
                   $('#modal-ubah-progress-proyek').modal('show')
               }
           });
        })

        $('#hapus').click(function () {

           if(confirm('Apakah Anda yakin akan menghapus data ini ... ?')==true){
           $.ajax({
               url: '{{ url('hapus-progress-jadwal') }}/'+$(this).val(),
               type: 'post',
               data:{
                   '_method':'put',
                   '_token':'{{ csrf_token() }}',
                   'id': $(this).val()
               },
               success:function (result) {
                  window.location.reload();
               }
           });
           }else{
               alert('Proses hapus diberhentikan');
           }
        })
    </script>
@stop