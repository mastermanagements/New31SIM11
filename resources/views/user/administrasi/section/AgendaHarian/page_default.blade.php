@extends('user.administrasi.master_user')

@section('skin')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Agenda Harian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-12">
               <div class="box box-success box-solid">
                   <div class="box-header">
                        <h3 class="box-title">Kalender</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Pilih Job Description</label>
                                   <select class="form-control select2" style="width: 100%;" name="id_jobdesc">
										<option>Pilih Jobdesc</option>
										@foreach($data_jobdesc as $jobdesc)
											@foreach ($jabatan_karyawan as $jabatan_karyawans)
												@if ($jabatan_karyawans->id_jabatan_p == $jobdesc->id_jabatan_p)
													<option value="{{ $jobdesc->id }}">{{ 		$jobdesc->getJabatan->nm_jabatan}}-{!! $jobdesc->job_desc !!}</option>
												@endif
											@endforeach
										@endforeach
                                   </select>
                                   <small style="color: red" id="notify"></small>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="box-body no-padding">
                                   <!-- THE CALENDAR -->
                               <div id="calendar"></div>
                               </div>
                           </div>
                       </div>
                       </div>
                   </div>
                        <!-- /.box-body -->
               </div>
                    <!-- /.box -->
            </div>

    </section>
    <!-- /.content -->
</div>
    
@stop

@section('plugins')
    <!-- select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- fullCalendar -->
    <script src="{{ @asset('component/bower_components/moment/moment.js') }}"></script>
    <script src="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="http://momentjs.com/downloads/moment-with-locales.js"></script>

    <script>
        $(function() {

            var selectValue =0;
            $('.select2').select2();

            calenderRender = function(divisi_id){
                var id_devisi = divisi_id;
                $('#calendar').fullCalendar({
                    selectable: true,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day'
                    },
                    dayClick: function(date, jsEvent, view) {
                        $('#modal-brifing').modal('show')
                        $("#title_modal").text(moment(date).format('DD-MMMM-YYYY'));
                        $("#dateText").val(moment(date).format('DD-MM-YYYY'));
                        getDataBrifing(moment(date).format('DD-MM-YYYY'), id_devisi)
                    },
                    eventSources: [
                        {
                            url : "{{ url('lihat-usulan-brifing') }}/"+ id_devisi,
                            type: 'get',
                            success:function (result) {
                                console.log(id_devisi)
                            },
                        },
                    ],
                    eventRender: function (event, element) {
                        element.attr('href', 'javascript:void(0);');
                        element.click(function() {

                            $("#title_modal").text(moment(event.start).format('DD-MMMM-YYYY'));
                            $("#dateText").val(moment(event.start).format('DD-MM-YYYY'));
                            $('#loading').hide();
                            getDataBrifing(moment(event.start).format('DD-MM-YYYY'), id_devisi)
                        });
                    }

                });
            }

            calenderRender($('[name="id_devisi"]').val())

            $('[name="id_devisi"]').change(function () {
                $('#calendar').fullCalendar( 'destroy');
                calenderRender($(this).val())
             })

            getDataBrifing = function(date, id_divisi)
            {
                $('#loading').show();
                $.ajax({
                    url: "{{ url('lihat-usulan-brifing-by-tgl') }}",
                    type : "post",
                    data :{
                        '_token': '{{ csrf_token() }}',
                        'tgl_usulan_brif': date,
                        'id_divisi': id_divisi
                    },
                    success: function (result) {
                        console.log(id_divisi)
                        var msg = "";
                        var btn_hapus = "";
                        console.log(result)
                        $.each(result, function (index, value) {

                            if(value.id_ky_login == value.id_ky_usulan){
                                btn_hapus = "<a href=\"#\" onclick=\"deleteUsulan("+value.id+")\" class='pull-right'><i class=\"fa fa-close\"></i></a>";
                            }else{
                                btn_hapus = ""
                            }
                            msg+="<div class=\"direct-chat-msg\" >"+
                                "<div class=\"direct-chat-info clearfix\">\n" +
                                "<span class=\"direct-chat-name pull-left\">"+value.nama_ky+"</span>\n" +
                                "</div>"+
                                "<img class=\"direct-chat-img\" src=\"{{ asset('filePFoto') }}/"+value.pas_foto + "\"\"+value.pas_foto + \"\\\" \"  alt=\"Message User Image\"><!-- /.direct-chat-img -->\n" +
                                "<div class=\"direct-chat-text\">\n" +
                                " "+value.materi + btn_hapus+
                                "</div>\n"+
                                "</div>";
                        })

                        if(result.length==0){
                            msg+="<div class=\"direct-chat-info clearfix\">\n" +
                                "                    <span class=\"direct-chat-name pull-left\">Belum ada usulan brifing</span>\n" +
                                "                  </div>";
                        }

                        $('#container_msg').html(msg);
                        $('#loading').hide();
                        $('#modal-brifing').modal('show')
                    }
                })
            }

            $('#saveBtn').click(function (){
                if($('[name="id_devisi"]').val() ==null){
                    return alert("Silahkan masukan divisi anda...!");
                }
                $.ajax({
                    url: "{{ url('store-brifing') }}",
                    type : 'post',
                    data :{
                        'tgl_usulan_brif': $('#dateText').val(),
                        'materi': $('#materi').val(),
                        '_token': '{{ csrf_token() }}',
                        'id_divisi': $('[name="id_devisi"]').val()
                    },
                    success:function (result) {
                        $('#calendar').fullCalendar( 'refetchEvents');
                        getDataBrifing($('#dateText').val(), $('[name="id_devisi"]').val())
                    }
                })
            })

            deleteUsulan = function (id) {
               if(confirm("Apakah anda akan menghapus usulan brifing ini..?")==true){
                   $.ajax({
                       url: "{{ url('delete-brifing') }}/"+id,
                       type : 'post',
                       data :{
                           'id': id,
                           '_token': '{{ csrf_token() }}',
                           '_method': 'put'
                       },
                       success:function (result) {
                           getDataBrifing($('#dateText').val(),$('[name="id_devisi"]').val())
                           $('#calendar').fullCalendar( 'refetchEvents');
                           alert("Usulan brifing telah terhapus");
                       }
                   })
               }else{
                   alert("Hapus usulan brifing dibatalkan");
               }
            }
        });
    </script>
@stop