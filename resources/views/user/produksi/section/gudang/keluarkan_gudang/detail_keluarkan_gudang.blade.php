@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Detail Keluarkan Barang
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
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Tabel Keluarkan Barang</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ url('detail-barang-keluar-gudang') }}" method="post">
                                        <table class="table table-responsive table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>Jumlah Keluar</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th># {{ csrf_field() }}<input type="hidden" name="id_keluar_gudang"
                                                                               value="{{ $id_keluar_gudang }}"></th>

                                                <th>
                                                    @if(!empty($stok_gudang))
                                                        <select class="form-control" name="id_barang" id="id_barang_form">
                                                            <option>Piilih Stok Barang Yang Tersisa</option>
                                                            @foreach($stok_gudang as $item_stok_gudang)
                                                                <option value="{{ $item_stok_gudang->id_barang }}">{{ $item_stok_gudang->nm_barang }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </th>
                                                <th><input class="form-control" id="stok" readonly></th>
                                                <th>
                                                    <input type="number" class="form-control" name="jumlah">
                                                </th>
                                                <th>
                                                    <button class="btn btn-primary" type="submit" id="btn_simpan">Simpan</button>
                                                </th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="box-title">Daftar barang keluar</h4>
                                    @if(!empty($masuk_gudang->linkToDetailKeluarkanGudang))
                                        @php($no=1)
                                        <table class="table table-responsive table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Keluar</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($masuk_gudang->linkToDetailKeluarkanGudang as $item_detail_barang)
                                            <form action="{{ url('detail-barang-keluar-gudang/'.$item_detail_barang->id) }}" method="post">

                                                <tr>

                                                    <th>{{ $no++ }} {{ csrf_field() }} @method('put')<input type="hidden" name="id_keluar_gudang"
                                                                                   value="{{ $id_keluar_gudang }}"> </th>
                                                    <th>
                                                        @if(!empty($stok_gudang))
                                                            <select class="form-control" name="id_barang">
                                                                <option>Piilih Stok Barang Yang Tersisa</option>
                                                                @foreach($stok_gudang as $item_stok_gudang)
                                                                    <option value="{{ $item_stok_gudang->id_barang }}" @if($item_detail_barang->id_barang==$item_stok_gudang->id_barang) selected @endif>{{ $item_stok_gudang->nm_barang }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </th>
                                                    <th>
                                                        <input type="number" class="form-control" name="jumlah" value="{{ $item_detail_barang->jumlah }}">
                                                    </th>
                                                    <th>
                                                        {{--<button class="btn btn-warning" type="submit">ubah</button>--}}
                                                        <a href="{{ url('detail-barang-keluar-gudang/'.$item_detail_barang->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini..?')" type="button">hapus</a>
                                                    </th>

                                                </tr>
                                                @endforeach
                                            </form>
                                            </tbody>
                                        </table>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->


        <!-- /.modal -->

    </div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>
    @include('user.administrasi.section.arsip.jenis_arsip.modal.JS')
    <script>
        $('#id_barang_form').change(function (e) {
            e.preventDefault();
            $('#stok').val(0);
            $.ajax({
                url:'{{ url('get-stok-gudang') }}',
                type: 'post',
                data: {
                  'id_gudang': '{{ $id_gudang }}',
                  'id_barang': $(this).val(),
                  '_token': '{{ csrf_token() }}'
                },
                success : function (result) {
                    $('#stok').val(result[0].jumlah);
                }
            });
        })

        $('[name="jumlah"]').keyup(function () {
            var input = $(this).val()
            var stok = $('#stok').val();

            if(input > stok){
                $('#btn_simpan').prop('disabled',true);
            }else{
                $('#btn_simpan').prop('disabled',false);
            }
        })
    </script>
@stop
