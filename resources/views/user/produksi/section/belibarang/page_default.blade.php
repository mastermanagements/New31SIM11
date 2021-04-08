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
                        <li ><a href="#tab_3" data-toggle="tab">Pembelian</a></li>
                        <li ><a href="#tab_4" data-toggle="tab">Pembayaran</a></li>
                        <li ><a href="#tab_5" data-toggle="tab">Return pembelian</a></li>
                        <li ><a href="#tab_6" data-toggle="tab">Pengaturan akun pembelian</a></li>
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
                                @if(!empty($pesanan_pembelian))
                                    @php($i=1)
                                    
                                    @foreach($pesanan_pembelian as $data_pesanan_pembelian)
                                        @php($sub_total =0)
                                        @php($besar_diskon_tambahan =0)
                                        @php($besar_pajak =0)
                                        @php($pajak =0)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <th>{{ $data_pesanan_pembelian->tgl_po }}</th>
                                            <th>{{ $data_pesanan_pembelian->no_po }}</th>
                                            <th>{{ $data_pesanan_pembelian->linkToSupplier->nama_suplier }}</th>
                                            {{--@php($sub_total =($data_pesanan_pembelian->linkToDetailPO->sum('jumlah_harga')))--}}
                                            {{--@if($data_pesanan_pembelian->diskon_tambahan !=0)    --}}
                                                {{--@php($besar_diskon_tambahan = $sub_total*($data_pesanan_pembelian->diskon_tambahan/100))--}}
                                            {{--@else--}}
                                                {{--@php($besar_diskon_tambahan = 0)--}}
                                            {{--@endif--}}
                                            {{--@if($data_pesanan_pembelian->pajak !=0)--}}
                                                {{--@php($besar_pajak =($sub_total-$besar_diskon_tambahan)*($data_pesanan_pembelian->pajak/100))--}}
                                            {{--@else--}}
                                                {{--@php($besar_pajak =0)--}}
                                            {{--@endif--}}
                                            
                                            <th>
                                                {{ $data_pesanan_pembelian->total }}
                                            </th>
                                            <th>    
                                                <form action="{{ url('pesanan-pembelian/'.$data_pesanan_pembelian->id.'/hapus') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <a href="{{ url('show-barang-pembelian/'.$data_pesanan_pembelian->id) }}" class="btn btn-primary"> Rincian Barang </a>
                                                    <a href="{{ url('pesanan-pembelian/'.$data_pesanan_pembelian->id.'/edit') }}" class="btn btn-warning"> Ubah Pesanan</a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus nota ini ...?')"> Hapus pesanan</button>
                                                </form>
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_3">
                            <a href="{{ url('Oder/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pembelian</a>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Beli</th>
                                    <th>No. Order</th>
                                    <th>Supplier</th>
                                    <th>Tanggal tiba</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($data_pembelian))
                                    @php($no=1)
                                        @foreach ($data_pembelian as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->tgl_order)) }}</td>
                                                <td>{{ $item->no_order }}</td>
                                                <td>{{ $item->linkToSuppliers->nama_suplier }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->tgl_order)) }}</td>
                                                <td>ss{{ number_format($item->total,2,',','.') }}</td>
                                                <td>
                                                    <div class="btn-group open">
                                                        <button type="button" class="btn btn-default">Menu</button>
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li> <a href="{{  url('Oder/'.$item->id) }}">tambahkan barang</a>   </li>
                                                            <li> <a href="{{  url('cek-barang/'.$item->id) }}">cek barang</a>   </li>
                                                            <li> <a href="{{  url('status-return/'.$item->id) }}">status return</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">cetak</a></li>
                                                        </ul>
                                                    </div>
                                                    <form action="{{ url('Oder/'.$item->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                        @method('delete')
                                                        <a href="{{  url('Oder/'.$item->id.'/edit') }}" class="btn btn-warning">ubah</a>   
                                                        <button class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')">hapus</button>

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane " id="tab_4">
                            <div class="form-group">
                                <label>Pilih Jenis Pembayaran</label>
                                <select class="form-control" name="jenis_pembayaran">
                                    <option disabled>Pilih jenis pembayaran</option>
                                    @foreach($jenis_pembayaran as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="container_po" style="display: none; ">
                                    <table class="table table-bordered table-striped" id="tbl_bayar_po" >
                                        <thead>
                                            <tr>
                                                <th> No. </th>
                                                <th> No. Transaksi </th>
                                                <th> Supplier </th>
                                                <th> Tgl Transaksi </th>
                                                <th> Tgl Bayar </th>
                                                <th> Jumlah DP </th>
                                                <th> Jumlah Bayar </th>
                                                <th> Bukti Bayar </th>
                                                <th> Konfirmasi </th>
                                                <th> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>                                   
                                </div>
                                <div class="col-md-12" id="container_order" style="display: none; overflow-x: scroll;">
                                    <table class="table table-bordered table-striped" id="tbl_order" style="width: 500px;">
                                        <thead>
                                            <tr>
                                                <th> No.</th>
                                                <th> No. Transaksi </th>
                                                <th> Supplier </th>
                                                <th> Tgl Transaksi </th>
                                                <th> Tgl Bayar </th>
                                                <th> Jumlah Tagihan </th>
                                                <th> Jumlah Bayar </th>
                                                <th> Sisa </th>
                                                <th> Pembelian </th>
                                                <th> Bukti Bayar </th>                                                
                                                <th> Konfirmasi </th>
                                                <th> Status </th>
                                                <th> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane " id="tab_5">
                            <div class="row">
                                <div class="col-md-12" >
                                    <table class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th> No.</th>
                                            <th> No. Order </th>
                                            <th> Supplier </th>
                                            <th> Tgl Transaksi </th>
                                            <th> Jumlah Barang </th>
                                            <th> Total return </th>
                                            <th> Konfirmasi </th>
                                            <th> Aksi </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data_pembelian))
                                            @php($no=1)
                                            @foreach ($data_pembelian as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->no_order }}</td>
                                                    <td>{{ $item->linkToSuppliers->nama_suplier }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->tgl_order)) }}</td>
                                                    <td>{{ $item->linkToCekBarangDetail->where('status_return','1')->count('id') }}</td>
                                                    <td>{{ number_format($item->linkToCekBarangDetail->where('status_return','1')->sum('jumlah_harga'),2,',','.') }}</td>
                                                    <td></td>
                                                    <td><a href="{{ url('return-barang/'.$item->id) }}" class="btn btn-success"> return </a> 
                                                        <a href="{{ url('preview-return-barang/'.$item->id) }}" class="btn btn-success"> preview </a> 
                                                        <a href="#" class="btn btn-success"> konfirmasi </a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab_6">
                            <a href="{{ url('akun-pembelian/create') }}" class="btn btn-primary">Tambah Akun Pembelian</a>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered " style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Keterangan transaksi</th>
                                                <th>Kode & Nama Akun</th>
                                                <th>Posisi</th>
                                           </tr>
                                        </thead>
                                        @if(!empty($akun_pembelian))
                                            @php($no=1)
                                            @foreach($akun_pembelian as $data)
                                                @php($rowspan = 0)
                                                @if(!empty($data->linkToOneKetTransaksi->dataAkun))
                                                    @if($rows=$data->linkToOneKetTransaksi->dataAkun->count())
                                                        @php($rowspan=$rows+1)
                                                    @endif
                                                @endif
                                                <tr>
                                                    <th rowspan="{{ $rowspan }}">{{ $no++ }}</th>
                                                    <th rowspan="{{ $rowspan }}">{{ $jenis_jurnal[$data->jenis_jurnal] }}<br><a href="{{ url('akun-pembelian/'.$data->id.'/edit') }}">ubah</a> <a href="{{ url('hapus-akun-pembelian'.$data->id) }}" onclick="return confirm('Apakah anda akan menghapus akun pembelian ini.');">hapus</a> </th>
                                                    <th rowspan="{{ $rowspan }}">{{ $data->linkToOneKetTransaksi->nm_transaksi }}</th>
                                                </tr>
                                                @if(!empty($data->linkToOneKetTransaksi->dataAkun))
                                                    @if($data_ket=$data->linkToOneKetTransaksi->dataAkun)
                                                        @foreach($data_ket as $data)
                                                            <tr>
                                                                <td>{{ $data->transaksi->kode_akun_aktif }} {{ $data->transaksi->nm_akun_aktif }}</td>
                                                                <td>@if($data->posisi_akun=='0') D @else K @endif</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
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
                                        <input type="text" class="form-control" name="no_tawar" value="{{ $no_surat_penawaran }}" required>
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

        <div class="modal fade" id="modal-status-barang">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Form Status Return</h4>
                    </div>
                    <form action="#" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggapan Supplier</label>
                                        <select class="form-control" name="tanggapan_supplier" required>
                                            <option disabled>Pilih Tanggapan Supplier</option>
                                            @foreach ($tanggapan as $key=> $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="tgl" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Alasan</label>
                                        <textarea name="alasan" class="form-control" ></textarea>
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

        $(document).ready(function () {

        })


        $('[name="jenis_pembayaran"]').change(function(){
           var val_id = $(this).val();
           $.ajax({
               url : '{{ url('Order/pesanan_pembelian') }}/'+val_id,
               type : 'get',
               success: function(result){
                  var id_tabel;
                  if(val_id=='0'){
                      id_tabel = '#tbl_bayar_po';
                      $('#container_po').show();
                      $('#container_order').hide();
                  }else{
                      id_tabel = '#tbl_order';
                      $('#container_po').hide();
                      $('#container_order').show();
                  }  

                   var t= $(''+id_tabel).DataTable({
                        column:[
                           {'data':'0'},
                           {'data':'1'},
                           {'data':'2'},
                           {'data':'3'},
                           {'data':'4'},
                           {'data':'5'},
                           {'data':'6'},
                           {'data':'7'},
                           {'data':'8'},
                           {'data':'9'},
                           {'data':'10'},
                           {'data':'11'},
                           {'data':'12'},
                           {'data':'13'},
                       ],
                       filter: false,
                       pagging : true,
                       searching: false,
                       info : true,
                       ordering : true,
                       processing : true,
                       retrieve: true,
                   });
                   t.clear().draw();
                   t.rows.add(result.data).draw();
               }
           });
        });

    </script>
@stop