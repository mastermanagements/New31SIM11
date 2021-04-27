@extends('user.produksi.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Diskon
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Ubah Pengaturan Diskon Penjualan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <form role="form" action="{{ url('p-diskon/'.$pdiskon->id) }}" method="post" enctype="multipart/form-data">
                          <div class="row">
                              {{ csrf_field() }}
                              @method('put')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis Diskon</label>
                                        <input type="radio" name="jenis_diskon" value="0" @if($pdiskon->jenis_diskon=='0') checked @endif required> Berdasarkan Jumlah Pembelian
                                        <input type="radio" name="jenis_diskon" value="1" @if($pdiskon->jenis_diskon=='1') checked @endif> Diskon Member
                                    </div>
                                    <div class="form-group">
                                        <label>Grup Klien</label>
                                        <select class="select2 form-control" name="id_group" required>
                                            <option disabled>Pilih Grup klien</option>
                                            @if(!empty($group_klien))
                                                @foreach($group_klien as $data)
                                                    <option value="{{ $data->id }}" @if($pdiskon->id_group==$data->id) selected @endif>{{ $data->nama_group }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Maks Beli</label>
                                        <input type="number" id="rupiah" class="form-control" name="jumlah_maks_beli" value="{{ $pdiskon->jumlah_maks_beli }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                      <label><font color="#DE3106">Isi Salah Satu Saja (Diskon Persen atau Diskon Jumlah Uang):</font></label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Diskon Persen</label>
                                        <input type="number" class="form-control" name="diskon_persen" value="{{ $pdiskon->diskon_persen }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Diskon Nominal</label>
                                        <input type="number" class="form-control" id="rupiah2" name="diskon_nominal" value="{{ rupiahView($pdiskon->diskon_nominal) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                        </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop

@section('plugins')
    @include('user.global.rupiah_input')
    @include('user.global.rupiah_input2')
@stop
