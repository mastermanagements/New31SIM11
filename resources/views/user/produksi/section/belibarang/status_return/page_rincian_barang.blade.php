@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Status Return Barang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail Barang</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                            <form role="form" action="{{ url('cek-barang/'.$data_order->id) }}" method="post" >
                                <div class="col-md-12" style="margin-top:10px">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" name="_method" value="put">
                                            <label>No. Order</label>
                                            <input type="text" name="no_order" class="form-control" value="{{  $data_order->no_order }}" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal. PO</label>
                                            <input type="date" name="tgl_order" class="form-control" value="{{ $data_order->tgl_order }}" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label>No. Pesanan Pembelian</label>
                                            <select class="form-control select2" name="id_po" style="width: 100%" disabled
                                                 {{-- onchange="if(confirm('Apakah anda akan mengambil data barang penawaran dari kode surat ini ... ?')){ return window.location.href='{{ url('rincian-penawaran') }}/'+$(this).val() }else{ alert('Data Barang tidak dapat diambil') }" --}}
                                                 >
                                                @if(!empty($pesana_pembelian))
                                                    <option value="0">Pilihan pesananan pembelian</option>
                                                    @foreach($pesana_pembelian as $data)
                                                          <option value="{{ $data->id }}" @if($data->id == $data_order->id_po) selected @endif>{{ $data->no_po }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select class="form-control select2" name="id_supplier" disabled required style="width: 100%">
                                                @if(!empty($supplier))
                                                    <option>Pilihan supplier</option>
                                                    @foreach($supplier as $data)
                                                          <option value="{{ $data->id }}" @if($data->id == $data_order->id_supplier) selected @endif>{{ $data->nama_suplier }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Barang tiba</label>
                                            <input type="date" name="tgl_tiba" value="{{ $data_order->tgl_tiba }}" class="form-control" required>
                                        </div>
                                        
                                </div>
                                 <div class="col-md-12">
                                @php($no=1)
                                @php($sub_total=0)
                              
                                        <h4>detail barang penawaran</h4>
                                        {{ csrf_field() }}
                                            <table style="width: 100%; margin-bottom: 10px; overflow-y:scroll; ">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Barang</th>
                                                <th style="width:80px;">Harga Beli</th>
                                                <th style="width:70px;">Diskon</th>
                                                <th style="width:60px;">Banyak</th>
                                                <th style="width:100px;">Jumlah</th>
                                                <th>Jumlah barang</th>
                                                <th>Kondisi barang</th>
                                                <th>Keterangan</th>
                                                <th>Respon</th>
                                                <th>Alasan</th>
                                                {{-- <th>Aksi</th> --}}
                                           </tr>
                                            @if(!empty($data_order->linkToPO))
                                         
                                                @foreach($data_order->linkToPO->linkToDetailPO as $data_tb)
                                                    <tr>
                                                    
                                                        <td>{{ $no++ }}</td>
                                                        <td>
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id_barang[]" value="{{ $data_tb->id_barang }}">
                                                            <input type="hidden" name="id_detail_barang[]" value="{{ $data_tb->id }}">
                                                            {{  $data_tb->linkToBarang->nm_barang }}
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="hpp[]" value="{{ $data_tb->hpp }}" readonly required>
                                                      
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="diskon_item[]" value="{{ $data_tb->diskon_item }}" readonly required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="jumlah_beli[]" value="{{ $data_tb->jumlah_beli }}" readonly required>
                                                     
                                                        </td>
                                                        <td>
                                                            @php($sub_total+=$data_tb->jumlah_harga*$data_tb->jumlah_beli)
                                                            <input type="number" class="form-control" name="jumlah_harga[]" value="{{ $data_tb->jumlah_harga }}" readonly required >
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="cek_jumlah[]" required>
                                                               @foreach ($kondisi as $key=> $item)
                                                                   <option value="{{ $key }}" @if(!empty($data_tb->getDetailCekBarang)) @if($data_tb->getDetailCekBarang->cek_jumlah == $key) selected @endif @endif>{{ $item }}</option>
                                                               @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="cek_kondisi[]" required>
                                                                @foreach ($kondisi as $keys=> $items)
                                                                   <option value="{{ $keys }}" @if(!empty($data_tb->getDetailCekBarang)) @if($data_tb->getDetailCekBarang->cek_kualitas == $keys) selected @endif @endif>{{ $items }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control" name='ket[]'>@if(!empty($data_tb->getDetailCekBarang)) {{ $data_tb->getDetailCekBarang->ket }} @endif</textarea>
                                                            <p></p>
                                                        </td>
                                                        <td>
                                                                 <select class="form-control" name="respon[]" required>
                                                                    @foreach ($respon as $keys=> $item)
                                                                        <option value="{{ $keys }}" @if(!empty($data_tb->getDetailCekBarang)) @if($data_tb->getDetailCekBarang->status_return == $keys) selected @endif @endif>{{ $item }}</option>
                                                                    @endforeach
                                                                </select>
                                                        </td>
                                                        <td>
                                                            <textarea class="form-control" name='alasan[]'> @if(!empty($data_tb->getDetailCekBarang)) {{ $data_tb->getDetailCekBarang->alasan_ditolak }} @endif</textarea>
                                                            <p></p>
                                                        </td>
                                                        {{-- <td>
                                                            <div class="text-center">
                                                                <input type="checkbox" name="status[]" required>
                                                            </div>
                                                        </td> --}}
                                                       
                                                    {{-- <td>
                                                            <button type="submit" class="btn btn-warning"> ubah </button>
                                                            <a href="{{ url('hapus-pembelian-penawaran-barang/'.$data_tb->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> hapus </a>
                                                    </td> --}}
                                                
                                                    </tr>                                                
                                                @endforeach
                                            
                                            
                                            @else
                                                  
                                                    @endif
                                                {{-- </form>      --}}

                                                    @if($data_order->id_po ==0)

                                                            @if(!empty($data_order->linkToCekBarangDetail))
                                                                @php($data_orders = $data_order->linkToCekBarangDetail)
                                                            @else
                                                                @php($data_orders = $data_order->linkToDetailOrder)
                                                            @endif

                                                        @if(!empty($data_orders))
                                                            @foreach ($data_orders as $data_tb)
                                                                {{-- <form action="{{ url('Order/ubah-rincian-pembelian/'.$data_tb->id) }}" id="form-detail" method="post"> --}}
                                                                        <tr>
                                                                    
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="id_detail_barang[]" value="{{ $data_tb->id_detail_po }}">

                                                                                <select name="id_barang[]" class="form-control" readonly>
                                                                                    <option disabled>Pilih barang</option>
                                                                                    @foreach ($barang as $item)
                                                                                        <option value="{{ $item->id }}"
                                                                                            @if ($item->id == $data_tb->id_barang)
                                                                                                selected
                                                                                            @endif
                                                                                        >{{ $item->nm_barang }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" name="hpp[]" value="{{ $data_tb->hpp }}" readonly required>

                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" name="diskon_item[]" value="{{ $data_tb->diskon_item }}" readonly required>
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" name="jumlah_beli[]" value="{{ $data_tb->jumlah_beli }}" readonly required>
                                                                        
                                                                            </td>
                                                                            <td>
                                                                                @php($sub_total+=$data_tb->jumlah_harga*$data_tb->jumlah_beli)
                                                                                <input type="number" class="form-control" name="jumlah_harga[]" value="{{ $data_tb->jumlah_harga*$data_tb->jumlah_beli }}" readonly required >
                                                                            </td>
                                                                        
                                                                            <td>
                                                                                <select class="form-control" name="cek_jumlah[]" required readonly>
                                                                                   @foreach ($kondisi as $key=> $item)
                                                                                       <option value="{{ $key }}" @if(!empty($data_tb->cek_jumlah)) @if($data_tb->cek_jumlah==$key) selected @endif @endif> {{ $item }}</option>
                                                                                   @endforeach
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" name="cek_kondisi[]" required readonly>
                                                                                    @foreach ($kondisi as $key=> $item)
                                                                                       <option value="{{ $key }}" @if(!empty($data_tb->cek_kualitas)) @if($data_tb->cek_kualitas==$key) selected @endif @endif>{{ $item }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <textarea class="form-control" name='ket[]' readonly>{{ $data_tb->ket }}</textarea>
                                                                                <p></p>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" name="respon[]" required>
                                                                                    @foreach ($respon as $key=> $item)
                                                                                        <option value="{{ $key }}"  @if(!empty($data_tb->status_return)) @if($data_tb->status_return==$key) selected @endif @endif>{{ $item }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <textarea class="form-control" name='alasan[]'>@if(!empty($data_tb->ket)) {{ $data_tb->ket }} @endif</textarea>
                                                                                <p></p>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                {{-- </form> --}}
                                                            @endforeach                                          
                                                        @endif        
                                                  
                                                    {{-- <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><p>Jumlah Item : {{ $no-1 }}</p></td>
                                                        <td><p>Sub Total :{{ $sub_total }}</p></td>
                                                    </tr> --}}
                                                      @endif
                                            
                                         </table>
                                         <div class="form-group">
                                            <button type="submit" class="btn btn-primary"> Simpan </button>
                                         </div>
                                                        
                                </div>
                            
                            </form>
                        </div>
                        <!-- /.box-body -->

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $('[name="persentase"]').keyup(function () {
            var persentase = ($('[name="hpp"]').val()/100) * $(this).val();
            var harga_jual =parseInt($('[name="hpp"]').val()) + persentase;
            $('[name="harga_jual"]').val(harga_jual);
        })
    </script>

@stop