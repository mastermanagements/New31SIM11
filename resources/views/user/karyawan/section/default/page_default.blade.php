@extends('user.karyawan.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard Karyawan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="box-title"><b>Agenda Harian</b></h4>
                        </div>
                        <div class="box-body">

                            @if(!empty($agenda))
                                <ol>
                                    @foreach($agenda as $item_agenda)
                                        <li>{{ $item_agenda->agenda }}</li>
                                    @endforeach
                                </ol>
                            @else
                                <h1>Agenda hari ini kosong</h1>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h4 class="box-title"><b>Produksi</b></h4>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-warning">
                                                <div class="box-body" style="background-color: orange">
                                                    <h4>Produksi Harian : {{ date('d-m-Y') }}</h4>
                                                    <ol>
                                                        @if(!empty($produksi_harian))
                                                            @foreach($produksi_harian as $data)
                                                                <li>{{ $data->linkToBarang->nm_barang }} {{ $data->jumlah_brg_jadi_bagus }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
										{{--<div class="box box-warning">--}}
                                                <div class="box-body" style="background-color: orange">
                                                    <h4>Produksi Bulanan : {{ date('F Y') }}</h4>
                                                    <ol>
                                                        @if(!empty($produksi_bulanan))
                                                            @foreach($produksi_bulanan as $item_bulanan)
                                                                <li>{{ $item_bulanan->nm_barang }} {{ $item_bulanan->total_produksi }} buah</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </div>
												{{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h4 class="box-title"><b>Biaya</b></h4>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-info">
                                                <div class="box-body" style="background-color: deepskyblue">
                                                    <h4>Pengeluaran Hari ini : {{ date('d-m-Y') }}</h4>
                                                    <p>Rp. @if(!empty($biaya_harian[0]->total)) {{ number_format($biaya_harian[0]->total,0,',','.') }} @else 0 @endif</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
										{{-- <div class="box box-info"> --}}
                                                <div class="box-body" style="background-color: deepskyblue">
                                                    <h4>Pengeluaran Bulan ini : {{ date('F Y') }}</h4>
                                                    <p>Rp. @if(!empty($biaya_bulanan[0]->total)) {{ number_format($biaya_bulanan[0]->total,0,',','.') }} @else 0 @endif</p>
                                                </div>
												{{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h4 class="box-title"><b>Penjualan</b></h4>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-warning">
                                                <div class="box-body" style="background-color: orange">
                                                    <h4>Penjualan Harian : {{ date('d-m-Y') }}</h4>
                                                    <p></p>
                                                    <p>Rp @if(!empty($pengeluaran_harian[0]->total_biaya)) {{ number_format($pengeluaran_harian[0]->total_biaya,0,',','.') }} @else 0 @endif</p>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
										{{-- <div class="box box-warning"> --}}
                                                <div class="box-body" style="background-color: orange">
                                                    <h4>Penjualan Bulan ini : {{ date('F Y') }}</h4>
                                                    <p>Rp. @if(!empty($pengeluaran_bulanan[0]->total_biaya)) {{ number_format($pengeluaran_bulanan[0]->total_biaya,0,',','.') }} @else 0 @endif</p>
                                                </div>
												{{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h4 class="box-title"><b>Laba Rugi</b></h4>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-info">
                                                <div class="box-body" style="background-color: deepskyblue">
                                                    <h4>Laba Rugi Hari ini : {{ date('d-m-Y') }}</h4>
                                                    <p>Rp. {{ $laba_harian}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="box box-info">
                                                <div class="box-body" style="background-color: deepskyblue">
                                                    <h4>Laba Rugi Bulan ini : {{ date('F Y') }}</h4>
                                                    <p>Rp. {{ $laba_bulanan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fix for small devices only -->

            </div>
        </section>
        <!-- /.content -->
    </div>
@stop