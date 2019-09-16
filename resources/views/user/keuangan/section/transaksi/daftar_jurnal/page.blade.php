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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total_debet=0)
                        @php($total_kredit=0)
                        @foreach($data as $value)
                            <tr>
                                <th>{{ $value['tanggal'] }}</th>
                                <th>Nomor Transaksi: {{ $value['no_transaksi'] }}</th>
                                <td>{{ $value['kode_akun'] }}</td>
                                <td>{{ $value['nm_akun'] }}</td>
                                <td>{{ $value['jenis_jurnal'] }}</td>
                                <td>{{ $value['nama_keterangan'] }}</td>
                                <td>
                                    @php($total_debet+=$value['debet'])
                                    {{ number_format($value['debet'],2,',','.') }}
                                </td>
                                <td>
                                    @php($total_kredit+=$value['kredit'])
                                    {{ number_format($value['kredit'],2,',','.') }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-default" onclick="edit_jurnal({{ $value['no_transaksi'] }})">Ubah</button>
                                    <button type="button" class="btn btn-danger" onclick="delete_jurnal({{ $value['no_transaksi'] }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="6">Total</th>
                        <th style="background-color: #0b93d5">{{ number_format($total_debet,2,',','.') }}</th>
                        <th style="background-color: greenyellow">{{ number_format($total_kredit,2,',','.') }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
       </div>
  </div>
    @include('user.keuangan.section.transaksi.daftar_jurnal.modal');
</div>

