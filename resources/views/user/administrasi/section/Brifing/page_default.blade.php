@extends('user.administrasi.master_user')

@section('skin')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
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
        <p></p>
        <div class="row">
            <div class="col-md-12">
               <div class="box box-success box-solid">
                   <div class="box-header">
                        <h3 class="box-title">Kalender</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="box-body no-padding">
                           <!-- THE CALENDAR -->
                           <div id="tests">Coba clik</div>
                           <div id="calendar"></div>
                       </div>
                   </div>
                        <!-- /.box-body -->
               </div>
                    <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
    @include('user.administrasi.section.Brifing.modal.modal_brifing')
@stop

@section('plugins')
    <!-- fullCalendar -->
    <script src="{{ @asset('component/bower_components/moment/moment.js') }}"></script>
    <script src="{{ @asset('component/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="http://momentjs.com/downloads/moment-with-locales.js"></script>

    <script>
        $(function() {

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
                    $("#title_modal").text(moment(date).format('MMMM Do YYYY, h:mm:ss a'));
                    $("#dateText").val(moment(date).format('DD-MM-YYYY'));
                    getDataBrifing(moment(date).format('DD-MM-YYYY'))
                },
                eventSources: [
                    {
                        url : "{{ url('lihat-usulan-brifing') }}",
                        type: 'get',
                        success:function (result) {
                            console.log(result)
                        },
                    },
                ],
                eventRender: function (event, element) {
                    element.attr('href', 'javascript:void(0);');
                    element.click(function() {

                        $("#title_modal").text(moment(event.start).format('MMMM Do YYYY, h:mm:ss a'));
                        $("#dateText").val(moment(event.start).format('DD-MM-YYYY'));
                        $('#loading').hide();
                        getDataBrifing(moment(event.start).format('DD-MM-YYYY'))
                    });
                }

            });

            getDataBrifing = function(date)
            {
                $('#loading').show();
                $.ajax({
                    url: "{{ url('lihat-usulan-brifing-by-tgl') }}",
                    type : "post",
                    data :{
                        '_token': '{{ csrf_token() }}',
                        'tgl_usulan_brif': date
                    },
                    success: function (result) {
                        var msg = "";
                        console.log(result)
                        $.each(result, function (index, value) {
                            msg+=" <div class=\"direct-chat-msg\" >"+
                                "<img class=\"direct-chat-img\" src=\"{{ asset('component/icon_plus.png') }}\" alt=\"Message User Image\"><!-- /.direct-chat-img -->\n" +
                                "<div class=\"direct-chat-text\">\n" +
                                "   "+value.materi +
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
                $.ajax({
                    url: "{{ url('store-brifing') }}",
                    type : 'post',
                    data :{
                        'tgl_usulan_brif': $('#dateText').val(),
                        'materi': $('#materi').val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    success:function (result) {
                         getDataBrifing($('#dateText').val())
                        $('#calendar').fullCalendar( 'refetchEvents' );
                    }
                })
            })
        });
    </script>
@stop