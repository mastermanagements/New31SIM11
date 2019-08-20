@extends('user.marketing.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Detail Positioning Perusahaan Terhadap Kompetitor
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
           <div class="col-md-12">
               <!-- Profile Image -->
               <div class="box box-primary">
                   <div class="box-body box-profile">

                       <h3 class="profile-username text-center">
                           {{ $data_posisi_p->getKompetitor->nm_kompetitor }}<br>
						   <small>{{ $data_posisi_p->getBarang->nm_barang }} </small>
                       </h3>
                       <p class="text-muted text-center">Profil Lengkap Psitioning Perusahaan</p>
                       <ul class="list-group list-group-unbordered">

                           <li class="list-group-item">
                               <b>Kelebihan Produk Kompetitor</b> 
							   <a class="pull-right">{!! $data_posisi_p->plus_produk_k !!}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Value Produk Kompetitor Terhadap Konsumen </b> <a class="pull-right">{!! $data_posisi_p->value_produk_k !!}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Kekurangan Produk Kompetitor</b> <a class="pull-right">{!! $data_posisi_p->minus_produk_k !!}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Positioning Kompetitor di Target Pasar Yang Sama</b> <a class="pull-right">{!! $data_posisi_p->getPosisiMarketingK->posisi_perusahaan !!}</a>
                           </li>
                           <li class="list-group-item">
                               <b>Kelebihan Produk Perusahaan Anda</b> <a class="pull-right">{!! $data_posisi_p->plus_produk_p !!}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Value Produk Anda Terhadap Konsumen </b> <a class="pull-right">{!! $data_posisi_p->value_produk_p !!}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Kekurangan Produk Anda</b> <a class="pull-right">{!! $data_posisi_p->minus_produk_p !!}</a>
                           </li>
						   <li class="list-group-item">
                               <b>Positioning Perusahaan di Target Terhadap Kompetitor</b> <a class="pull-right">{{ $data_posisi_p->getPosisiMarketingP->posisi_perusahaan }}</a>
                           </li>
                       </ul>

                   </div>
                   <!-- /.box-body -->
               </div>
               <!-- /.box -->
           </div>

       </div>
    </section>
    <!-- /.content -->
</div>
@stop
