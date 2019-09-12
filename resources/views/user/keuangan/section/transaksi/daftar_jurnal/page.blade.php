<div class="tab-pane active" id="tab_1">
  <div class="row">
      <div class="col-md-12">
          @if(!empty(session('message_success')))
              <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
          @elseif(!empty(session('message_fail')))
              <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
          @endif
      </div>
       <div class="col-md-12" style="margin-top: 10px">
            <div class="box  box-danger box-solid">
                <table id="example_rincian" class="table table-bordered table-hover" style="width: 100% ">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Transaksi</th>
                            <th>Kode Akun</th>
                            <th>Akun</th>
                            <th>Jenis Jurnal</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $value)
                            <tr>
                                <th>{{ $value['tanggal'] }}</th>
                                <th>Nomor Transaksi: {{ $value['no_transaksi'] }}</th>
                                <th>{{ $value['kode_akun'] }}</th>
                                <th>{{ $value['nm_akun'] }}</th>
                                <th>{{ $value['jenis_jurnal'] }}</th>
                                <th>{{ $value['nama_keterangan'] }}</th>
                                <th>{{ $value['debet'] }}</th>
                                <th>{{ $value['kredit'] }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       </div>
  </div>
</div>