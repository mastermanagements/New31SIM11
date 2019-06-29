@extends('user.hrd.master_user')

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
            Kalender Kerja
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kalender</h3>
                            </div>

                            <div class="box-body">
                                <div class="box-body no-padding">
                                    <!-- THE CALENDAR -->
                                    <a href="{{ url('daftar-event-kalender') }}" class="btn btn-primary"><i class="fa fa-list"></i> Lihat Daftar Kelender</a>
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@stop


@section('plugins')
    <!-- fullCalendar -->
    <script src="{{ asset('component/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('component/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
    <script>
        $(function() {
            calenderRender = function () {
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
                    dayClick: function (date, jsEvent, view) {
                    },
                    eventSources: [
                        {
                            url : "{{ url('get-event-calender') }}",
                            type: 'get',
                            success:function (result) {
                                console.log(result)
                            },
                            color : 'red',
                            textColor : 'white'
                        }
                    ],
                    eventRender: function (event, element) {
                        element.attr('href', 'javascript:void(0);');
                        element.click(function () {

                        });
                    }

                });
            }

            calenderRender()
        });
    </script>
@stop