<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Master Manajement</title>
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
<body class="hold-transition skin-black-light sidebar-mini fixed">
<div class="wrapper">

  @include('user.karyawan.include.header')
  @include('user.karyawan.include.sidebar')
  @yield('master_content')
  @include('user.produksi.include.footer')
  @include('user.produksi.include.control_sidebar')

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
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })

        get_harga = function(functionNumber,segment) {
            if(segment == undefined){
                var id_barang = $('[name="id_barang"]').val();
            }else{
                var id_barang = $('#id_barang'+segment).val();
            }
            $.ajax({
                url : "{{ url('getHargaBarang') }}",
                type : 'post',
                data : {
                    '_token':'{{csrf_token()}}',
                    'id_barang': id_barang,
                    'number_call_function':functionNumber
                },

                success: function (result) {
                    console.log(segment);
                    if(segment == undefined){
                        $('#show_harga').val(result.harga);
                    }else{
                        $('#show_harga'+segment).val(result.harga);
                    }
                }
            });
        }

        $('#diskon_tambahan').keyup(function () {
            calculate_total_akhir();
        });

        $('#pajak_tambahan').keyup(function () {
            calculate_total_akhir();
        });

        $('#uang_muka').keyup(function () {
            calculate_total_akhir();
        });

        $('#ongkir').keyup(function () {
            calculate_total_akhir();
        });

        $('#bayar').keyup(function () {
            calculate_total_akhir();
        });

        calculate_total_akhir = function(){
            var sub_total = $('#sub_total').text();
            var diskon_tambahan = $('#diskon_tambahan').val();
            var pajak = $('#pajak_tambahan').val();
            var uang_muka = $('#uang_muka').val();
            var ongkir = $('#ongkir').val();
            var bayar = $('#bayar').val();
            var total = sub_total;

            // Hitung jika ada diskon
            if(diskon_tambahan !=0){
                var n_diskon = total * (diskon_tambahan/100);
                total = total - n_diskon;
            }else{
                total = total - 0;
            }

            if(typeof ongkir !='undefined'){
                if(ongkir !=0){
                    total = total + ongkir;
                }else{
                    total = total + 0;
                }
            }
            console.log(total)
            // Tambahkah dengan nilai uang muka
//            total = parseInt(total)+parseInt(uang_muka);

            // Hitung jika ada pajak
            if(typeof pajak !='undefined') {
                if (pajak != 0) {
                    var n_pajak = total * (pajak / 100);
                    total = total + n_pajak;
                }
            }

            if(typeof bayar !='undefined') {
                if (bayar != 0) {
                    total = total - bayar;
                    $('#kurang_bayar').val(total);
                }
            }

            if(typeof uang_muka !='undefined') {
                if (uang_muka != 0) {
                    hutang = total - uang_muka;
                    $('#kurang_bayar').val(hutang);
                }
            }
            // Kurang Bayar
            var hutang = 0;

            if(total <= 0){
                alert('Total Bayar tidak boleh melebihi jumlah total');
                $('#final_total').text("Total Akhir "+total);
            }else{
                $('#final_total').text("Total Akhir "+total);
            }
        }
    });
</script>
</body>
</html>