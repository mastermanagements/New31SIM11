@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pembelian
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
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active" ><a href="#tab_1" data-toggle="tab">Penawaran pembelian</a></li>
                        <li ><a href="#tab_2" data-toggle="tab">Pesanan pembelian</a></li>
                        <li ><a href="#tab_3" data-toggle="tab">Daftar Pembelian</a></li>
                        <li ><a href="#tab_4" data-toggle="tab">Return pembelian</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Penawaran Pembelian</a>
                            <p></p>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Penarawan</th>
                                    <th>Supplier</th>
                                    <th>Tanggal</th>
                                    <th>Tgl berlaku</th>
                                    <th>Tgl Dikirm</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no=1)
                                    @if(!empty($tawar_beli))
                                        @foreach($tawar_beli as $data)
                                            <tr>
                                                <th>{{ $no++ }}</th>
                                                <th>{{ $data->no_tawar }}</th>
                                                <th>Supplier</th>
                                                <th>{{ date('d-m-Y',strtotime($data->tgl_tawar)) }}</th>
                                                <th>{{ date('d-m-Y',strtotime($data->tgl_tawar)) }}</th>
                                                <th>@if(!empty($data->tgl_kirim)){{ date('d-m-Y',strtotime($data->tgl_kirim)) }}@endif</th>
                                                <th>
                                                    <a href="{{ url('tawar-beli/'.$data->id) }}" class="btn btn-success">Barang Penawaran</a>
                                                    <a href="#" onclick="updatePembelianBarang({{$data->id}})" class="btn btn-warning">Ubah</a>
                                                    <a href="{{ url('tawar-beli/'.$data->id.'/hapus') }}" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" class="btn btn-danger">Hapus</a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="tab_2">
                           <p style="margin-bottom: 10px;">Daftar Pesanan pembelian  <a href="{{ url('pesanan-pembelian') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Pesanan Pembelian</a>
                           </p>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nomor Penawaran</th>
                                    <th>Supplier</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <a href="{{ url('tambah-pembelian') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pembelian</a>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Order</th>
                                    <th>No. Faktur</th>
                                    <th>Tanggal Beli</th>
                                    <th>Barang</th>
                                    <th>Supplier</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($data_pembelian as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->no_order  }}</td>
                                        <td>{{ $value->no_faktur  }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->tgl_beli)) }}</td>
                                        <td>{{ $value->getBarang->nm_barang }}</td>
                                        <td>{{ $value->getSupplier->nama_suplier }}</td>
                                        <td>{{ $value->jumlah_barang }}</td>
                                        <td>{{ number_format($value->harga_beli,2,',','.') }}</td>
                                        <td>{{ number_format($value->jumlah_barang*$value->harga_beli,2,',','.') }}</td>
                                       <td>
                                            <form action="{{ url('hapus-pembelian/'.$value->id) }}" method="post">
                                                <a href="{{ url('ubah-pembelian/'.$value->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus pembelian ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="tab_4">
                            <h1>Return pembelian</h1>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Form Penawaran Pembelian</h4>
                    </div>
                    <form action="{{ url('tawar-beli') }}" method="post" id="form_tawar_beli">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Penawaran</label>
                                        <input type="date" class="form-control" name="tgl_tawar"  required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Belaku</label>
                                        <input type="date" class="form-control" name="tgl_berlaku"  required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Penawaran</label>
                                        <input type="text" class="form-control" name="no_tawar"  required>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select name="id_supplier" class="form-control"  required>
                                            @if(!empty($suppliers))
                                                @foreach($suppliers as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_suplier }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </section>
    <!-- /.content -->
</div>

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/plugins/iCheck/icheck.min.js') }}"></script>

    <script>
        updatePembelianBarang = function (id) {
            $.ajax({
                url:'{{ url('tawar-beli') }}/'+id+'/edit',
                type : 'get',
                success:function (result) {
                    console.log(result);
                    $('[name="no_tawar"]').val(result.no_tawar);
                    $('[name="tgl_tawar"]').val(result.tgl_tawar);
                    $('[name="tgl_berlaku"]').val(result.tgl_berlaku);
                    $('[name="id_supplier"]').val(result.id_supplier).trigger('changed');
                    $('#form_tawar_beli').attr('action','{{ url('tawar-beli') }}/'+id);
                    $('[name="_method"]').val('put');
                    $('#modal-default').modal('show');
                }
            })
        }
    </script>
@stop