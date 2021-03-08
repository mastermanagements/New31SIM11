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
            Rincian Pembelian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rincian Pembelian</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                            <form role="form" action="{{ url('Order/'.$data_order->id.'/simpan') }}" method="post" >
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
                                            <input type="date" name="tgl_tiba" value="{{ $data_order->tgl_tiba }}" disabled class="form-control" required>
                                        </div>
                                        
                                </div>
                            <div class="col-md-12">
                                @php($no=1)
                                @php($sub_total=0)
                              
                                        <h4>detail barang penawaran</h4>
                                        {{ csrf_field() }}
                                            <table style="width: 100%; margin-bottom: 10px">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Beli</th>
                                                <th>Diskon</th>
                                                <th>Banyak</th>
                                                <th>Jumlah</th>
                                           </tr>
                                            @if(!empty($data_order->linkToPO))
                                         
                                                @foreach($data_order->linkToPO->linkToDetailPO as $data_tb)
                                                    <tr>
                                                    
                                                        <td>{{ $no++ }}</td>
                                                        <td>
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id_barang[]" value="{{ $data_tb->id }}">
                                                            {{  $data_tb->linkToBarang->nm_barang }}
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="hpp[]" id="hpp_" value="{{ $data_tb->hpp }}" readonly required>
                                                      
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="diskon_item[]" id="diskon" value="{{ $data_tb->diskon_item }}" readonly required>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="jumlah_beli[]" id="jumlah_beli" value="{{ $data_tb->jumlah_beli }}" readonly required>
                                                     
                                                        </td>
                                                        <td>
                                                            @php($sub_total+=$data_tb->jumlah_harga*$data_tb->jumlah_beli)
                                                            <input type="text" class="form-control" name="jumlah_harga[]" id="jumlah_harga" value="{{ $data_tb->jumlah_harga }}" readonly required >
                                                        </td>
                                                       
                                                    {{-- <td>
                                                            <button type="submit" class="btn btn-warning"> ubah </button>
                                                            <a href="{{ url('hapus-pembelian-penawaran-barang/'.$data_tb->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> hapus </a>
                                                    </td> --}}
                                                
                                                    </tr>                                                
                                                @endforeach
                                                
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><p>Jumlah Item : {{ $no-1 }}</p></td>
                                                    <td><p>Sub Total :{{ $sub_total }}</p></td>
                                                </tr>
                                             <div class="form-group">
                                                <button type="submit" class="btn btn-primary"> Simpan Barang </button>
                                            </div>
                                            @else
                                                   <tr style="background-color: greenyellow">
                                                        <td>#</td>
                                                        <td>
                                                            {{ csrf_field() }}
                                                            <select name="id_barang[]" class="form-control">
                                                                <option disabled>Pilih barang</option>
                                                                @foreach ($barang as $item)
                                                                     <option value="{{ $item->id }}">{{ $item->nm_barang }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="hpp[]" required>                                                           
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="diskon_item[]" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="jumlah_beli[]" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="jumlah_harga[]" readonly required >
                                                        </td>
                                                        <td>
                                                                <button class="btn btn-primary" style="width: 100%">Simpan Barang</button>
                                                        </td>
                                                           
                                                    </tr>
                                                    @endif

                                                </form>
                                                    @if($data_order->id_po ==0)
                                                        @if(!empty($data_orders=$data_order->linkToDetailOrder))
                                                            @foreach ($data_orders as $data_tb)
                                                                <form action="{{ url('Order/ubah-rincian-pembelian/'.$data_tb->id) }}" id="form-detail" method="post">
                                                                        <tr>
                                                                    
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>
                                                                                {{ csrf_field() }}
                                                                                <select name="id_barang[]" class="form-control">
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
                                                                                <input type="text" class="form-control" name="hpp[]" value="{{ $data_tb->hpp }}"  required>

                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" name="diskon_item[]" value="{{ $data_tb->diskon_item }}"  required>
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" name="jumlah_beli[]" value="{{ $data_tb->jumlah_beli }}"  required>
                                                                        
                                                                            </td>
                                                                            <td>
                                                                                @php($sub_total+=$data_tb->jumlah_harga*$data_tb->jumlah_beli)
                                                                                <input type="text" class="form-control" name="jumlah_harga[]" value="{{ $data_tb->jumlah_harga*$data_tb->jumlah_beli }}" readonly required >
                                                                            </td>
                                                                        
                                                                            <td>
                                                                                    <button type="submit" class="btn btn-warning"> ubah </button>
                                                                                    <a href="{{ url('hapus-pembelian-penawaran-barang/'.$data_tb->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ... ?')"> hapus </a>
                                                                            </td>
                                                                    
                                                                        </tr>
                                                                </form>
                                                            @endforeach                                          
                                                        @endif        
                                                  
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><p>Jumlah Item : {{ $no-1 }}</p></td>
                                                        <td><p>Sub Total :{{ $sub_total }}</p></td>
                                                    </tr>
                                                      @endif
                                            
                                         </table>
                                                                     
                                </div>
                            
                            @if(!empty($data_order->linkToPO)) 
                            <div class="col-md-12">
                                <form action="{{ url('Order/'.$data_order->id.'/simpan-rincian-pembelian') }}" method="post">
                                    {{ csrf_field() }}
                                       <div class="col-md-12">
                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Uang Muka Pembelian</label>
                                                    <input type="text" name="dp_po" value="{{ $data_order->linkToPO->dp_po }}" class="form-control" readonly required>
                                                </div>
                                            </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Diskon Tambahan</label>
                                                       <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                                                       <input type="text" name="diskon_tambahan" value="@if(!empty($data_order->diskon_tambahan)){{ $data_order->diskon_tambahan }}@else {{ '0' }} @endif " class="form-control" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Pajak</label>
                                                       <input type="text" name="pajak" value="@if(!empty($data_order->pajak)) {{ $data_order->pajak }} @else 0 @endif" class="form-control" required>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Ongkos Kirim</label>
                                                       <input type="text" name="onkir" value=" @if(!empty($data_order->ongkir)) {{ $data_order->ongkir }} @else 0 @endif " class="form-control" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Jatuh Tempo</label>
                                                       <input type="date" name="tgl_jatuh_tempo" value="{{ $data_order->tgl_jatuh_tempo }}" class="form-control" required>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Metode pembayaran</label>
                                                        <select class="form-control" name="metode_bayar">
                                                            <option disabled>Pilih metode pembayaran</option>
                                                            @foreach ($metode_pembayaran as $key=> $item)
                                                                <option value="{{ $key }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Bayar</label>
                                                        <input class="form-control" name="bayar" value="{{ $data_order->bayar }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Hutang</label>
                                                        <input type="text" name="kurang_bayar" value="{{ $data_order->kurang_bayar }}" class="form-control" disabled required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <textarea class="form-control" name="ket">{{ $data_order->ket }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                       <div class="col-md-12">
                                          <label><input type="checkbox" value="on" name="jurnal_otomatis"> Buat jurnal otomatis </label> <button type="submit" onclick="return confirm('Pastikan yang anda isi telah sesuai atau tidak')" class="btn btn-primary"> Simpan daftar pembelian </button>
                                       </div>
                                </form>
                            </div>
                            @else
                            <div class="col-md-12">
                                <form action="{{ url('Order/'.$data_order->id.'/simpan-rincian-pembelian') }}" method="post">
                                    {{ csrf_field() }}
                                       <div class="col-md-12">
                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Uang Muka Pembelian</label>
                                                    <input type="text" name="dp_po" class="form-control" value="{{ $data_order->dp_po }}" required>
                                                </div>
                                            </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Diskon Tambahan</label>
                                                       <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                                                       <input type="text" name="diskon_tambahan" value="{{ $data_order->diskon_tambahan }}" class="form-control" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Pajak</label>
                                                       <input type="text" name="pajak" value="{{ $data_order->pajak }}" class="form-control" required>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Ongkos Kirim</label>
                                                       <input type="text" name="onkir" value="{{$data_order->ongkir}}" class="form-control" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Jatuh Tempo</label>
                                                       <input type="date" name="tgl_jatuh_tempo" value="{{ $data_order->tgl_jatuh_tempo }}" class="form-control" required>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Metode pembayaran</label>
                                                        <select class="form-control" name="metode_bayar" onchange=" var value = $(this).val(); if(value==0){ $('#hutang').hide() }else{ $('#hutang').show() }">
                                                            <option disabled>Pilih metode pembayaran</option>
                                                            @foreach ($metode_pembayaran as $key=> $item)
                                                                <option value="{{ $key }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Bayar</label>
                                                        <input class="form-control" name="bayar" value="{{ $data_order->bayar }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="hutang" style="display: @if($data_order->metode_bayar=="0") none @else show @endif;"  >
                                                    <div class="form-group">
                                                        <label>Hutang</label>
                                                        <input type="number" name="kurang_bayar" value="{{ $data_order->kurang_bayar }}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <textarea class="form-control" name="ket">{{ $data_order->ket }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                       <div class="col-md-12">
                                          <label><input type="checkbox" name="jurnal_otomatis" value="on" required> Buat jurnal umum otomatis </label> <button type="submit" onclick="return confirm('Pastikan yang anda isi telah sesuai atau tidak')" class="btn btn-primary"> Simpan daftar pembelian </button>
                                       </div>
                                </form>
                            </div>
                            @endif
    
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

        var hpp =0;
        var diskon = 0;
        var jumlah_barang = 0;
        var total =0

        $('#hpp_').keyup(function(){
            hpp = $(this).val();
            alert(hpp);
            calculate_jumlah();
        });

        $('#diskon').keyup(function(){
            diskon = $(this).val();
            calculate_jumlah();
        });

        $('#jumlah_beli').keyup(function(){
            jumlah_barang = $(this).val();
            calculate_jumlah();
        });

        calculate_jumlah = function(){
            var n_diskon = 0;
            var sub_total = 0;
            if(diskon !=0){
                n_diskon = diskon/100;
            }

            sub_total = hpp * jumlah_barang;
            dis_total = sub_total * n_diskon;
            total = sub_total - dis_total;
            $('#jumlah_harga').val(total);
        }



    </script>

@stop