@extends('user.administrasi.master_user')

@section('skin')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
    <link rel="stylesheet" href="{{ asset('component/plugins/iCheck/all.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Brifing
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
                            <a href="{{ url('Pengaturan-rapat') }}" class="pull-right"><i class="fa fa-gears"></i> Jenis Rapat</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Bagian Perusahaan</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_devisi">
                                            @foreach($data_bagian_devisi as $value)
                                                <optgroup label="{{ $value->nm_bagian }}">
                                                    @if(!empty($value->getDevisi))
                                                        @foreach($value->getDevisi as $value2)
                                                            <option value="{{ $value2->id }}">{{ $value2->nm_devisi }}</option>
                                                        @endforeach
                                                    @endif
                                                </optgroup>
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
    @include('user.administrasi.section.Brifing.modal.modal_brifing')
@stop

@section('plugins')
    <!-- select2 -->
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- fullCalendar -->
    <script src="{{ @asset('component/bower_components/moment/moment.js') }}"></script>
    <script src="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>

    <script>
        $(function() {
            $('#reply-form').hide()
            //iCheck for checkbox and radio inputs
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })

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
                                //console.log(id_devisi)
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
                $('#pesan_loading').text("Sedang menload Ulasan Brifing");
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
                              //  btn_hapus = "<a href=\"#\" onclick=\"deleteUsulan("+value.id+")\" class='pull-right btn btn-primary btn-xs'><i class=\"fa fa-close\"></i></a>";
                                btn_hapus = "                                                    <a class=\"btn btn-primary btn-xs\" href=\"#\"  onclick=\"deleteUsulan("+value.id+")\" ><i class=\"fa fa-close\"></i> </a>\n";
                            }else{
                                btn_hapus = ""
                            }

                            msg +=  " <li class=\"time-label\">\n" +
                                    "                                            <span class=\"bg-red\">\n" +
                                    "                                                 \n" +moment( value.tgl_usulan_brif).format('DD-MM-YYYY')+
                                    "                                            </span>\n" +
                                    "                                        </li>\n" +
                                    "                                   \n" +
                                    "  <li>\n" +
                                    "  \n" +
                                    "  <i class=\"fa  fa-bookmark bg-blue\" ></i>\n" +
                                    "   <div class=\"timeline-item\">\n" +
                                    "   <span class=\"time\"><a href=\"#\" onclick=\"replyRepat("+value.id+")\"><i class=\"fa fa-reply\"></i> Balas</a></span>" +
                                    "   <span class=\"time\"><i class=\"fa fa-clock-o\"></i> " + value.time_created+
                                    "   </span>\n" +
                                    "\n" +
                                    "<h3 class=\"timeline-header\"><a href=\"#\">"+
                                        value.nama_ky
                                    +"</a> </h3>\n" +
                                    "\n" +
                                    "                                                <div class=\"timeline-body\">\n" +
                                    "                                                    \n" +
                                    "                                                    " +
                                    value.materi +
                                    "                                                </div>\n" +
                                    "\n" +
                                    "                                                <div class=\"timeline-footer\">\n" +
                                btn_hapus +
                                    "                                                </div>\n" +
                                    "                                            </div>\n" +
                                    "                                        </li>"+
                                    ""+value.reply;

                         })
                        $('.timeline').html(msg);
                        $('#loading').hide();
                        $('#modal-brifing').modal('show')
                    }
                })
                return true;
            }

            $('#saveBtn').click(function (){
                if($('[name="id_devisi"]').val() ==null){
                    return alert("Silahkan masukan divisi anda...!");
                }

                if($('[name="jenis_rapat"]').val()==null){
                    return alert('Silahkan wasukan Jenis rapat anda');
                }
                $.ajax({
                    url: "{{ url('store-brifing') }}",
                    type : 'post',
                    data :{
                        'tgl_usulan_brif': $('#dateText').val(),
                        'materi': $('#materi').val(),
                        '_token': '{{ csrf_token() }}',
                        'id_divisi': $('[name="id_devisi"]').val(),
                        'id_jenis_rapat': $('[name="jenis_rapat"]').val()
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

            replyRepat = function(id){
                $('#reply-form').show();
                $('[name="idUsulanBrifing"]').val(id)
            }

            $('#saveKrm').click(function () {
                //alert('button click');

                $.ajax({
                    url: "{{ url('reply-brifing') }}",
                    type: "post",
                    data : {
                        '_token': "{{ csrf_token() }}",
                        'keterangan': $('#keterangan').val(),
                        'id_usulan_brifing': $('[name="idUsulanBrifing"]').val(),
                        'tgl_rapat': $('#dateText').val(),
                        'pilihan_rapat' : $('input[name="pilihan_rapat"]:checked').val()
                    },
                    success: function (result) {
                        $('#reply-form').hide();

                        if( getDataBrifing($('#dateText').val(),$('[name="id_devisi"]').val()) == true){
                            $('#pesan_loading').text("Sedang menload Balasan Dari ulasan rapat diatas");
                        }
                    }
                })
            })

            deleteReply = function (id) {
                if(confirm("Apakah anda akan menghapus data ini...?")==true){
                    $.ajax({
                        url : "{{ url('delete-reply') }}/"+id,
                        type : "post",
                        data : {
                            '_method': 'put',
                            '_token': '{{ csrf_token() }}'
                        },
                        success:function (result) {
                            if( getDataBrifing($('#dateText').val(),$('[name="id_devisi"]').val()) == true){
                                $('#pesan_loading').text("Sedang menload Balasan Dari ulasan rapat diatas");
                            }
                        }
                    })
                }else {
                    alert("Data ini tidak jadi ");
                }
            }

        });
    </script>
@stop