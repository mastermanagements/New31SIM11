@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Gudang
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
                        <div class="box-body">
                            <a href="{{ url('gudang/create') }}" class="btn btn-primary">Tambah Gudang</a>
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Gudang</th>
                                    <th>Status Gudang</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($gudang))
                                    @php($no=1)
                                    @foreach($gudang as $item_gudang)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item_gudang->gudang }}</td>
                                            <td>
                                                @if($item_gudang->jenis_gudang == '0')
                                                    Gudang
                                                @else
                                                    Show room
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('gudang/'.$item_gudang->id) }}" method="post">
                                                    @method('delete')
                                                    {{ csrf_field() }}
                                                    <a href="{{ url('gudang/'.$item_gudang->id.'/edit') }}"
                                                       class="btn btn-warning">ubah</a>
                                                    <button type="submit" onclick="return confirm('Apakah anda akan menghapus data gudang ini...?')" class="btn btn-danger">hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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
        onPromoEdit = function (kode) {
            $.ajax({
                'url': '{{ url('promo-crud') }}/' + kode + '/edit',
                'type': 'get',
                success: function (result) {
                    console.log(result.nama_promo);
                    $('#nama_promo').val(result.nama_promo);
                    $('[name="tgl_awal_promo"]').val(result.tgl_dibuat);
                    $('[name="tgl_akhir_promo"]').val(result.tgl_berlaku);
                    $('[name="syarat"]').text(result.syarat);
                    $('[name="fasilitas"]').val(result.fasilitas_promo);
                    $('[name="_method"]').val('put');
                    $('#form_promo').attr('action', '{{ url('promo-crud') }}/' + result.id);
                    $('#modal-default').modal('show')
                }
            })
        }
    </script>
@stop
