<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Atur Usaha</title>
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

    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">


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
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-red-light sidebar-mini fixed">
<div class="wrapper">

  @include('user.karyawan.include.header')
  @include('user.karyawan.include.sidebar')
  @yield('master_content')
  @include('user.produksi.include.footer')
  @include('user.produksi.include.control_sidebar')
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
<script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

@include('user.global.rupiah_input')
<script>
    $(function () {
        $('.select2').select2()
    });
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     <script>
         $(function () {
             $('#example1').DataTable();
             $('#example3').DataTable();
             $('#example2').DataTable({
                 'paging'      : false,
                 'lengthChange': false,
                 'searching'   : false,
                 'ordering'    : false,
                 'info'        : true,
                 'autoWidth'   : false
             })


             {{--get_harga = function(functionNumber,segment) {--}}
                 {{--if(segment == undefined){--}}
                     {{--var id_barang = $('[name="id_barang"]').val();--}}
                 {{--}else{--}}
                     {{--var id_barang = $('#id_barang'+segment).val();--}}
                 {{--}--}}
                 {{--$.ajax({--}}
                     {{--url : "{{ url('getHargaBarang') }}",--}}
                     {{--type : 'post',--}}
                     {{--data : {--}}
                         {{--'_token':'{{csrf_token()}}',--}}
                         {{--'id_barang': id_barang,--}}
                         {{--'number_call_function':functionNumber--}}
                     {{--},--}}
                     {{--success: function (result) {--}}
                         {{--console.log(result);--}}
                         {{--if(segment == undefined && result.harga!=0){--}}
                             {{--var hpp = formatRupiah(result.harga.replace('.00',''));--}}
                             {{--console.log(hpp);--}}
                             {{--$('#show_harga').val(hpp);--}}
                         {{--}else{--}}
                             {{--if(result.harga!=0){--}}
                                {{--var hpp = formatRupiah(result.harga.replace('.00',''));--}}
                                {{--$('#show_harga'+segment).val(hpp);--}}
                             {{--}--}}
                         {{--}--}}
                     {{--}--}}
                 {{--});--}}
             {{--}--}}

             get_harga = function(functionNumber,segment) {
                 if(segment == undefined){
                     var id_barang = $('[name="id_barang"]').val();
                 }else{
                     var id_barang = $('#id_barang'+segment).val();
                 }
                 $.ajax({
                     url: '{{ url('response_json') }}/' + id_barang,
                     dataType: 'json',
                     type: 'post',
                     data: {
                       '_token':'{{csrf_token()}}',
                      },
                     success: function (result) {
                       var hpp = formatRupiah(result.hpp.replace('.00',''));
                         $('#show_harga').val(hpp);
                      },
                     error: function (xhr, status, error) {
                         var err = eval("(" + xhr.responseText + ")");
                         alert(err.Message);
                     }
                 })
             }
         });
     </script>
</body>
@include('layouts.setSessian')
</html>
