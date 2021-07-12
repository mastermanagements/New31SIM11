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
                            <h3 class="box-title">Formulir Ubah Rekening Supplier</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('RekSupplier/'.$rek_supplier->id) }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          @method('put')
                            <div class="box-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Supplier</label>
                                  <select class="form-control select2" style="width: 100%;" name="id_supplier" required>
                                      @if(empty($supplier))
                                          <option>Dtaa supplier Masih Kosong</option>
                                      @else
                                          @foreach($supplier as $value)
                                              <option value="{{ $value->id }}" @if($value->id==$rek_supplier->id_supplier) selected @endif>{{ $value->nama_suplier }}</option>
                                          @endforeach
                                      @endif
                                  </select>
                                  <small style="color: red">* Tidak Boleh Kosong</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Bank</label>
                                  <input name="nama_bank" class="form-control" placeholder="Nama Bank" value="{{ $rek_supplier->nama_bank }}" required>
                                  <small style="color: red">* Tidak boleh kosong</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">No Rekening</label>
                                  <input name="no_rek" class="form-control" placeholder="No. Rekening" value="{{ $rek_supplier->no_rek }}" required>
                                  <small style="color: red">* Tidak boleh kosong</small>
                              </div>

                              <div class="form-group">
                                  <label for="exampleInputEmail1">Atas Nama</label>
                                  <input name="atas_nama" class="form-control" placeholder="Pemilik Rekening" value="{{ $rek_supplier->atas_nama }}" required>
                                  <small style="color: red">* Tidak boleh kosong</small>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Kantor Cabang</label>
                                  <input name="kcp" class="form-control" placeholder="Kantor Cabang" value="{{ $rek_supplier->kcp }}">
                              </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@stop
