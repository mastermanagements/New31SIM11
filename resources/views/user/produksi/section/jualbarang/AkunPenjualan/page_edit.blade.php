@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Ubah Akun Penjualan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubah Akun Penjualan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <div class="row">
                              <form role="form" action="{{ url('pengaturan-akun-penjualan/'.$akun_penjualan->id) }}" method="post">
                              {{ csrf_field() }}
                                  @method('put')
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Jurnal</label>
                                                <select class="form-control select2" name="jenis_jurnal">
                                                    @foreach($jenis_jurnal as $key=>$data)
                                                        <option value="{{ $key }}" @if($key==$akun_penjualan->jenis_jurnal) selected @endif>{{ $data }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Catatan Transaksi</label>
                                                <select class="form-control select2" name="id_ket_transaksi">
                                                    @if(!empty($akun_transaksi))
                                                        @foreach($akun_transaksi as $akun_transaksi)
                                                            <option value="{{ $akun_transaksi->id }}" @if($akun_transaksi->id ==$akun_penjualan->id_ket_transaksi) selected @endif>{{ $akun_transaksi->nm_transaksi }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>


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


                $('#datepicker').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

                $('#datepicker2').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

                $('#datepicker3').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });

                $('[name="jumlah_barang"]').keyup(function () {
                    hitung_total();
                })

                $('[name="hpp"]').keyup(function () {
                    hitung_total();
                })

                $('[name="diskon"]').keyup(function () {
                    hitung_total();
                })

                hitung_total = function () {
                    var diskon = $('[name="diskon"]').val()
                    var total_sebdis=0;
                    total_sebdis = $('[name="jumlah_barang"]').val() * $('[name="hpp"]').val();
                    if(diskon != 0){
                        var setelah_diskon = (total_sebdis * (diskon/100));
                        total_sebdis = total_sebdis - setelah_diskon;
                    }
                    $('[name="total"]').val(total_sebdis);
                }

    </script>

@stop