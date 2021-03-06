@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">

@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Slip Gaji
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 3%">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Slip Gaji {{ $data_slip->karyawan->nama_ky }}</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <div class="row">
                               <div class="col-md-12">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label>Periode</label>
                                               <div class="input-group date">
                                                   <div class="input-group-addon">
                                                       <i class="fa fa-calendar"></i>
                                                   </div>
                                                   <input type="text" class="form-control pull-right" id="datepicker"  name="periode" value="{{ date('d-m-Y', strtotime($data_slip->periode)) }}" required readonly>
                                               </div>
                                               <!-- /.input group -->
                                               <small style="color: red">* Tidak boleh kosong</small>
                                           </div>
                                       </div>
                                      <div class="col-md-12">
                                          <div class="row">
                                              <div class="col-md-1">
                                                  Nama
                                              </div>
                                              <div class="col-md-2">
                                                  : {{ $data_slip->karyawan->nama_ky }}
                                              </div>
                                          </div>
                                      </div>
                                       <div class="col-md-12">
                                          <div class="row">
                                              <div class="col-md-1">
                                                  Jabatan
                                              </div>
                                              <div class="col-md-2">: {{ $data_slip->karyawan->jabatan_ky->getJabatan->nm_jabatan }}
                                              </div>
                                          </div>
                                      </div>
                                       <div class="col-md-12">
                                          <div class="row">
                                              <div class="col-md-1">
                                                  Status
                                              </div>
                                              <div class="col-md-1">
                                                  : {{ $data_slip->karyawan->jabatan_ky->status_jabatan }}
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                        <table class="table-bordered table">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Item Gaji</th>
                                                    <th>Jumlah Gaji</th>
                                                    <th>Absensi</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>Gaji Pokok</th>
                                                <th>
                                                    @php($gaji_pokok=$data_slip->karyawan->getMannyDaftarGaji->where('status_aktif',1)->first()['besar_gaji'] ) {{ $data_slip->karyawan->getMannyDaftarGaji->where('status_aktif',1)->first()['besar_gaji'] }}
                                                </th>
                                                <th>Hari Normal Masuk</th>
                                                <th>
                                                    @foreach($data_slip->karyawan->getAbsensi as $value)
                                                        {{ $value->whereraw('month(periode)='.date('m', strtotime($data_slip->periode)).' ')->whereraw('year(periode)='.date('Y', strtotime($data_slip->periode)).' ')->first()->normal_hari }}
                                                    @endforeach
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <th>Tunjangan Tetap</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            @php($total_tunjangan_tetap = 0)
                                            @foreach($data_slip->karyawan->getMannyTunjangan->where('status_aktif',1) as $data)
                                                @if($data->skalaTunjangan->status_tunjangan==1)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $data->skalaTunjangan->item_tunjangan->nm_tunjangan }}</td>
                                                        <td>{{ $data->skalaTunjangan->besar_tunjangan }}</td>
                                                         <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @php($total_tunjangan_tetap+=$data->skalaTunjangan->besar_tunjangan)
                                                @endif
                                            @endforeach
                                            <tr>
                                                <th></th>
                                                <th>Sub Total Tunjangan Tetap</th>
                                                <th>{{ $total_tunjangan_tetap }}</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <th>Tunjangan Tidak Tetap</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            @php($total_tunjangan_non_tetap = 0)
                                            @foreach($data_slip->karyawan->getMannyTunjangan->where('status_aktif',1) as $data)
                                                @if($data->skalaTunjangan->status_tunjangan==0)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $data->skalaTunjangan->item_tunjangan->nm_tunjangan }}</td>
                                                        <td>{{ $data->skalaTunjangan->besar_tunjangan }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @php($total_tunjangan_non_tetap +=$data->skalaTunjangan->besar_tunjangan)
                                                @endif
                                            @endforeach
                                            <tr>
                                                <th></th>
                                                <th>Sub Total Tunjangan Tidak Tetap</th>
                                                <th>{{ $total_tunjangan_non_tetap }}</th>
                                               <th></th>
                                                <th></th>
                                            </tr>

                                            <tr>
                                                <th>4</th>
                                                <th>Lembur</th>
                                                <th></th>
                                                <th></th>
                                                <th><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lembur"><i class="fa fa-plus"></i></button></th>
                                            </tr>
                                            @php($total_lembur=0)
                                            @if(!empty($data_slip->lembur))
                                            <tr>
                                                <td></td>
                                                <td>{{ $data_slip->lembur->jum_lembur }}</td>
                                                <td>{{ $data_slip->lembur->jum_besaran_lembur }}</td>
                                                <td></td>
                                                <th>
                                                    <form action="{{ url('delete-lembur/'.$data_slip->lembur->id) }}" method="post">
                                                        <input type="hidden" name="_method" value="put">
                                                        {{ csrf_field() }}
                                                        <button type="submit" onclick="return confirm('Apakah anda akan mengapus data lembur ini..?')" class="btn btn-sm btn-danger" ><i class="fa fa-eraser"></i></button>
                                                    </form>
                                                    @php($total_lembur += $data_slip->lembur->jum_besaran_lembur )
                                                </th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>Sub Total Lembur</th>
                                                <th>{{ $total_lembur }}</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>5</th>
                                                <th>Bonus</th>
                                                <th></th>
                                                <th></th>
                                                <th><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-bonus"><i class="fa fa-plus"></i></button></th>
                                            </tr>
                                            @php($totalBonusProyek=0);
                                            @if(!empty($bonus= $data_slip->BonusProyek))
                                                @foreach($bonus as $bonus)
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            @if(empty($bonus->proyek))
                                                                {{ $bonus->nama_bonus }}
                                                            @else
                                                                {{ $bonus->proyek->spk->nm_spk }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $bonus->besaran_bonus }}
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <form action="{{ url('delete-bonus-proyek/'.$bonus->id) }}" method="post">
                                                                <input type="hidden" name="_method" value="put">
                                                                {{ csrf_field() }}
                                                                <button type="submit" onclick="return confirm('Apakah anda akan mengapus bonus ini..?')" class="btn btn-sm btn-danger" ><i class="fa fa-eraser"></i></button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                    @php($totalBonusProyek+=$bonus->besaran_bonus)
                                                    <tr>
                                                        <th></th>
                                                        <th>Sub Total Bonus</th>
                                                        <th>{{ $totalBonusProyek }}</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>

                                                @endforeach


                                            @endif

                                            <tr>
                                                <th>6</th>
                                                <th>Tambahan Pendapatan</th>
                                                <th></th>
                                                <th></th>
                                                <th><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambahan-pendapatan"><i class="fa fa-plus"></i></button></th>
                                            </tr>
                                            @php($total_tambahan = 0 )
                                            @if(!empty($tambahan= $data_slip->tambahanGaji))
                                                @foreach($tambahan as $dataT)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $dataT->keterangan }}</td>
                                                        <td>{{ $dataT->jumlah_uang }}</td>
                                                       <td></td>
                                                        <td>
                                                            <form action="{{ url('delete-tambahan/'.$dataT->id) }}" method="post">
                                                                <input type="hidden" name="_method" value="put">
                                                                {{ csrf_field() }}
                                                                <button type="submit" onclick="return confirm('Apakah anda akan mengapus data tambahan pendapatan ini..?')" class="btn btn-sm btn-danger" ><i class="fa fa-eraser"></i></button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                    @php($total_tambahan+=$dataT->jumlah_uang)
                                                @endforeach
                                                <tr>
                                                    <th></th>
                                                    <th>Sub Total Tambahan Pendapatan</th>
                                                    <th>{{ $total_tambahan }}</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th>7</th>
                                                <th>Potongan Tetap</th>
                                                <th></th>
                                                <th></th>
                                                <th><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambahan-pendapatan"><i class="fa fa-plus"></i></button></th>
                                            </tr>
                                            @php($total_potongan_tetap = 0)
                                            @foreach($potongan_tetap as $potongan_t)
                                                @if(!empty($potongan_t->potongan_absen))
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $potongan_t->nm_potongan }}</td>
                                                        <td>{{ $potongan_t->besar_potongan }} x

                                                                @php($jumlah_item_potongan = $potongan_t->potongan_absen->whereraw('month(periode)='.date('m', strtotime($data_slip->periode)).' ')->whereraw('year(periode)='.date('Y', strtotime($data_slip->periode)).' ')->first()->jumlah_item_p)
                                                                {{ $jumlah_item_potongan }} = @php($potongan_tetaps = $potongan_t->besar_potongan * $jumlah_item_potongan) {{ $potongan_tetaps }}
                                                                @php($total_potongan_tetap += $potongan_tetaps)

                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @else 0  = 0 @endif</td>
                                            @endforeach
                                            <tr>
                                                <th></th>
                                                <th>Sub Total Potongan Pendapatan</th>
                                                <th>{{ $total_potongan_tetap }}</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th>8</th>
                                                <th>Potongan Tambahan</th>
                                                <th></th>
                                                <th></th>
                                                <th><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-potongan-tambahan"><i class="fa fa-plus"></i></button></th>
                                            </tr>
                                            @php($total_pot = 0)
                                            @if(!empty($potongan= $data_slip->PotonganTambahan))
                                                @foreach($potongan as $potongan)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $potongan->keterangan }}</td>
                                                        <td>{{ $potongan->jumlah_potongan }}</td>
                                                        <td></td>
                                                        <td>
                                                            <form action="{{ url('delete-potongan/'.$potongan->id) }}" method="post">
                                                                <input type="hidden" name="_method" value="put">
                                                                {{ csrf_field() }}
                                                                <button type="submit" onclick="return confirm('Apakah anda akan mengapus data potongan ini..?')" class="btn btn-sm btn-danger" ><i class="fa fa-eraser"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @php($total_pot+=$potongan->jumlah_potongan)
                                                @endforeach
                                            @endif
                                            <tr>
                                                <th></th>
                                                <th>Sub Total Potongan Tambahan</th>
                                                <th>{{ $total_pot }}</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Total Netto</th>
                                                <th>
                                                    {{ ($gaji_pokok+$total_tunjangan_non_tetap+$total_tunjangan_tetap+$total_lembur+$total_tambahan+$totalBonusProyek)-($total_pot+$total_potongan_tetap) }}
                                                </th>
                                                 <th></th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>Pembayaran Dengan Cara</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                      </div>
                                   </div>
                               </div>
                           </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

    @include('user.penggajian.section.daftar_gaji.slipGaji.modal_slip_gaji.modal_lembur')
    @include('user.penggajian.section.daftar_gaji.slipGaji.modal_slip_gaji.modal_tambahan')
    @include('user.penggajian.section.daftar_gaji.slipGaji.modal_slip_gaji.modal_potongan_tambahan')
    @include('user.penggajian.section.daftar_gaji.slipGaji.modal_slip_gaji.modal_bonus')

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $('.select2').select2()
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-alokasi-gaji') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="thn"]').val(result.thn);
                  $('[name="persen"]').val(result.persen);
                  $('[name="jumlah"]').val(result.jumlah);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-alokasi-gaji') }}');
              }
          })
       }

       $('[name="id_proyek"]').change(function () {
           if($(this).val()!="null"){
               $('[name="nm_bonus"]').prop('readonly',true)
               $('[name="jumlah_bonus"]').prop('readonly',true)
               $('[name="id_kelas"]').prop('required',true)
           }else{
               $('[name="nm_bonus"]').prop('readonly',false)
               $('[name="jumlah_bonus"]').prop('readonly',false)
           }
       })
    </script>
@stop