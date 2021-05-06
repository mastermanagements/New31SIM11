@extends('user.produksi.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Diskon
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Diskon</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                      <div class="box-body">
                          <form role="form" action="{{ url('p-diskon') }}" method="post" enctype="multipart/form-data">
                          <div class="row">
                              {{ csrf_field() }}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Jenis Diskon</label>
                                        <input type="radio" name="jenis_diskon" onclick="javascript:yesnoCheck();" id="yesCheck" value="0" required> Berdasarkan Jumlah Pembelian
                                        <input type="radio" name="jenis_diskon" onclick="javascript:yesnoCheck();" id="noCheck" value="1"> Diskon Member
                                    </div>
                                </div>
                                <div id="ifYes" style="visibility:hidden" class="col-md-12">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Maksimal Pembelian</label>
                                        <input type="text" id="yes" class="form-control" name="jumlah_maks_beli">
                                    </div>
                                  </div>
                                </div>
                                <div id="ifNo" style="visibility:hidden" class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Member</label>
                                        <select class="select2 form-control" id="no" name="id_group" required>
                                            <option disabled>Pilih Jenis Member</option>
                                            @if(!empty($group_klien))
                                                @foreach($group_klien as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_group }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </div>

                                      <div class="col-md-12">
                                        <label><font color="#DE3106">Isi Salah Satu Saja (Diskon Persen atau Diskon Jumlah Uang):</font></label>
                                      </div>
                                      <div class="col-md-12">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label>Diskon Persen (%)</label>
                                              <input type="number" class="form-control" name="diskon_persen" value="0">
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Diskon Nominal</label>
                                                <input type="text" id="rupiah2" class="form-control" name="diskon_nominal" value="0">
                                            </div>
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
  <script>
      function yesnoCheck() {
      if (document.getElementById('yesCheck').checked) {
          document.getElementById('ifYes').style.visibility = 'visible';
      }
      else document.getElementById('ifYes').style.visibility = 'hidden';

      if (document.getElementById('noCheck').checked) {
          document.getElementById('ifNo').style.visibility = 'visible';
      }
      else document.getElementById('ifNo').style.visibility = 'hidden';
    }
  </script>

@stop
