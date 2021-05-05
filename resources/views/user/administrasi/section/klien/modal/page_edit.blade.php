@extends('user.administrasi.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Rekening Supplier
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <p></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Ubah Rekening Klien</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('RekKlien/'.$rek_klien->id) }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('put')
                            <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Klien</label>
                                  <select class="form-control select2" style="width: 100%;" name="id_klien" required>
                                      @if(empty($klien))
                                          <option>Dtaa klien Masih Kosong</option>
                                      @else
                                          @foreach($klien as $value)
                                              <option value="{{ $value->id }}" @if($value->id==$rek_klien->id_klien) selected @endif>{{ $value->nm_klien}}</option>
                                          @endforeach
                                      @endif
                                  </select>
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Bank</label>
                                  <input name="nama_bank" class="form-control" placeholder="Nama Bank" value="{{ $rek_klien->nama_bank }}" required>
                                  <small style="color: red">* Tidak boleh kosong</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">No Rekening</label>
                                  <input name="no_rek" class="form-control" placeholder="No. Rekening" value="{{ $rek_klien->no_rek }}" required>
                                  <small style="color: red">* Tidak boleh kosong</small>
                              </div>

                              <div class="form-group">
                                  <label for="exampleInputEmail1">Atas Nama</label>
                                  <input name="atas_nama" class="form-control" placeholder="Pemilik Rekening" value="{{ $rek_klien->atas_nama }}" required>
                                  <small style="color: red">* Tidak boleh kosong</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Kantor Cabang</label>
                                  <input name="kcp" class="form-control" placeholder="Kantor Cabang" value="{{ $rek_klien->kcp }}">
                              </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop