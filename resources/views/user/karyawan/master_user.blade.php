<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aturusaha.com</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ @asset('component/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ @asset('component/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ @asset('component/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ @asset('component/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  {{--<script src="{{ @asset('js/jQuery-2.2.0.min.js') }}"></script>--}}
@yield('skin')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ @asset('component/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ @asset('component/dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


  <![endif]-->

  <!-- Google Font -->
  
</head>
<body class="hold-transition skin-red-light sidebar-mini fixed ">
<div class="wrapper">

  @include('user.karyawan.include.header')
  @include('user.karyawan.include.sidebar')

    @yield('master_content')

  @include('user.karyawan.include.footer')
 @include('user.karyawan.include.control_sidebar')
  <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ @asset('component/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ @asset('component/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ @asset('component/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ @asset('component/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- SlimScroll -->
<script src=" {{ @asset('component/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }} "></script>
@yield('plugins')
<!-- AdminLTE App -->
<script src="{{ asset('component/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('component/dist/js/demo.js') }}"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })

        setSession= function (url, main_menu,subMenu) {
            $.ajax({
                url:'{{ url('setting-session-menu') }}',
                type:'post',
                data: {
                    'main_menu':main_menu,
                    'sub_menu': subMenu,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(result){
                    window.location.href=url;
                },
                error : function(xhr,status,error){
                    var err = eval("(" + xhr.responseText + ")");
                    alert('Klik ulang menu pilihan anda');
                }
            })
        }
    })
</script>
@include('layouts.setSessian')
</body>
</html>
