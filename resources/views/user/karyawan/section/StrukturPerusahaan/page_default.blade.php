@extends('user.karyawan.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="{{ asset('getorgchart/getorgchart.js') }}"></script>
    <link href="{{ asset('getorgchart/getorgchart.css') }}" rel="stylesheet" />
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Strategi Jangka Panjang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="#"  id="bagan" class="btn btn-primary">Buat Bagan</a>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            <div class="col-md-12" id="struktur_perusahaan">

            </div>
        </div>
    </section>
    <!-- /.content -->
    @include('user.karyawan.section.StrukturPerusahaan.include.modal');
</div>
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

        var dataSource;

        $(function () {

        });

        var btnEdit = '<g data-action="edit" class="btn" transform="matrix(0.14,0,0,0.14,50,0)"><rect style="opacity:0" x="0" y="0" height="300" width="300" /><path fill="#686868" d="M149.996,0C67.157,0,0.001,67.161,0.001,149.997S67.157,300,149.996,300s150.003-67.163,150.003-150.003 S232.835,0,149.996,0z M221.302,107.945l-14.247,14.247l-29.001-28.999l-11.002,11.002l29.001,29.001l-71.132,71.126 l-28.999-28.996L84.92,186.328l28.999,28.999l-7.088,7.088l-0.135-0.135c-0.786,1.294-2.064,2.238-3.582,2.575l-27.043,6.03 c-0.405,0.091-0.817,0.135-1.224,0.135c-1.476,0-2.91-0.581-3.973-1.647c-1.364-1.359-1.932-3.322-1.512-5.203l6.027-27.035 c0.34-1.517,1.286-2.798,2.578-3.582l-0.137-0.137L192.3,78.941c1.678-1.675,4.404-1.675,6.082,0.005l22.922,22.917 C222.982,103.541,222.982,106.267,221.302,107.945z"/></g>';
        var btnDel = '<g data-action="delete" class="btn" transform="matrix(0.14,0,0,0.14,100,0)"><rect style="opacity:0" x="0" y="0" height="300" width="300" /><path fill="#686868" d="M112.782,205.804c10.644,7.166,23.449,11.355,37.218,11.355c36.837,0,66.808-29.971,66.808-66.808 c0-13.769-4.189-26.574-11.355-37.218L112.782,205.804z"/> <path stroke="#686868" fill="#686868" d="M150,83.542c-36.839,0-66.808,29.969-66.808,66.808c0,15.595,5.384,29.946,14.374,41.326l93.758-93.758 C179.946,88.926,165.595,83.542,150,83.542z"/><path stroke="#686868" fill="#686868" d="M149.997,0C67.158,0,0.003,67.161,0.003,149.997S67.158,300,149.997,300s150-67.163,150-150.003S232.837,0,149.997,0z M150,237.907c-48.28,0-87.557-39.28-87.557-87.557c0-48.28,39.277-87.557,87.557-87.557c48.277,0,87.557,39.277,87.557,87.557 C237.557,198.627,198.277,237.907,150,237.907z"/></g>';

        getOrgChart.themes.monica.box += '<g transform="matrix(1,0,0,1,350,10)">'
            + btnEdit
            + btnDel
            + '</g>';



            function getNodeByClickedBtn(el) {
                while (el.parentNode) {
                    el = el.parentNode;
                    if (el.getAttribute("data-node-id"))
                        return el;
                }
                return null;
            }

        $.getJSON("{{ url('getRequestStrukturPerusahaan') }}", function (source) {
            var orgChart = new getOrgChart(document.getElementById("struktur_perusahaan"), {
                primaryFields: ["Nama_karyawan", "Jabatan", "Nik"],
                photoFields: ["Image"],
                theme: "monica",
                enableEdit: false,
                enableDetailsView: false,
                dataSource:source
            });
            init();

            var btns = document.getElementsByClassName("btn");
            for (var i = 0; i < btns.length; i++) {

                btns[i].addEventListener("click", function () {
                    var nodeElement = getNodeByClickedBtn(this);
                    var action = this.getAttribute("data-action");
                    var id = nodeElement.getAttribute("data-node-id");
                    var node = orgChart.nodes[id];

                    switch (action) {
                       case "edit":
                            modelEdit(node.id);
                            break;
                        case "delete":
                            modelDelete(node.id);
                            break;
                    }
                });
            }
        });

        var init = function () {


            };


        $(document).ready(function () {
            var ids;
            $('#storeBagan').click(function () {
                $.ajax({
                    url : "{{ url('store-bagan') }}",
                    type : "post",
                    data : {
                        '_token': "{{ csrf_token() }}",
                        'parentId' : $('[name="parentId"]').val(),
                        'id_karyawan' : $('[name="id_karyawan"]').val(),
                        'id_jabatan' : $('[name="id_jabatan"]').val(),
                    },
                    success:function (result) {
                        window.location.reload()
                    }
                })
            });

            $('#bagan').click(function () {
                $('#modal-tambah-bagan').modal('show');
            });

            modelEdit = function (id) {
                $.ajax({
                    url:"{{ url('ubah-struktur') }}/"+id,
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.bagan);
                        ids = result.bagan.id;
                        $('[name="parentId_ubah"]').val(result.bagan.parentId).trigger('checked');
                        $('[name="id_karyawan_ubah"]').val(result.bagan.id_karyawan).trigger('checked');
                        $('[name="id_jabatan_ubah"]').val(result.bagan.id_jabatan).trigger('checked');
                        $('#modal-ubah-bagan').modal('show');
                    }
                })
            };

            $('#updateBagan').click(function () {
               $.ajax({
                   url: "{{ url('update-struktur') }}/"+ids,
                   type: "post",
                   data : {
                       'parentId': $('[name="parentId_ubah"]').val(),
                       'id_karyawan': $('[name="id_karyawan_ubah"]').val(),
                       'id_jabatan':   $('[name="id_jabatan_ubah"]').val(),
                       '_method': 'put',
                       '_token': '{{ csrf_token() }}',
                   },
                   success: function () {
                       window.location.reload();
                   }
               })
            });

            modelDelete = function (id) {
                if(confirm('Apakah anda yakin akan menghapus bagian ini ... ?'))
                {
                    $.ajax({
                        url : "{{ url('delete-struktur') }}/"+ id,
                        type : "post",
                        data: {
                            '_method': 'put',
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function () {
                            window.location.reload()
                        }
                    })
                }
                else
                {
                    alert("Proses hapus dibatalkan");
                }
            }
        })
    </script>
@stop
