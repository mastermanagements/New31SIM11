<div class="row">

    <div class="col-md-12">
            <!-- /.box-header -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Tahun dividen</label>
                <input type="text" class="form-control" name="thn" id="datepicker3" value="{{ $thn_proses }}">
                <small style="color: darkgray">* Tahun akan disetting otomatis berdasarkan tahun server</small>
            </div>
        </div>

            <div class="box-body" style="">

                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-besar-nisbah"> <i class="fa fa-plus"></i> Besar Nisbah</button>
                    </div>
                    <div class="col-md-4">
                        @if(!empty(session('message_success')))
                            <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                        @elseif(!empty(session('message_fail')))
                            <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-danger pull-right" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-nisbah"> <i class="fa fa-book"></i> Daftar Nisbah</button>
                    </div>
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Periode Per tahun</h3>
                            </div>
                            <div class="box-body" id="btn-container">

                            </div>
                            <!-- /.box-body -->
                            <!-- Loading (remove the following to stop the loading)-->
                            <div class="overlay" id="loading">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                            <!-- end loading -->
                        </div>
                    </div>
                </div>

                <table id="example1" class="table table-bordered table-striped tbdividenBulanan" style="width: 100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Periode Investasi</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Labar Rugi</th>
                        <th>Net kas</th>
                        <th>Nisbah Pelaksana</th>
                        <th>Nisbah Pemodal</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>