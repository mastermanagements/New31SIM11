<div class="tab-pane @if(Session::get('tab3') == 'tab3') active @else '' @endif" id="tab_3">
    <div class="row">
        @if(!empty($data_monitoring))
            @foreach($data_monitoring as $data_monitoring)
                <div class="col-md-12">
                <div class="box box-primary collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tgl Mulai: {{ $data_monitoring->tgl_mulai }}, Supervisor: {{ $data_monitoring->linkToSupervisor->nama_ky }}
                            , Barang : {{ $data_monitoring->linkToBarang->nm_barang }}
                        </h3>
                        <div class="box-tools pull-right">
                            <form action="{{ url('quality-control/'.$data_monitoring->id) }}" method="post">
                                {{ csrf_field() }} @method('put')
                                <a href="{{ url('proses-pengerjaan/'. $data_monitoring->id) }}" class="btn btn-box-tool" title="Laksanakan Proses Produksi"><i class="fa fa-plus-square"></i></a>
                                <button type="submit" class="btn btn-box-tool" title="Quality control dan hasil"><i class="fa fa-signal"></i></button>
                                <button type="button" class="btn btn-box-tool" title="Selesai Produksi" onclick="callModal({{ $data_monitoring->id }})"><i class="fa fa-hourglass-end"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </form>

                        </div>
                        <div class="box-body">
                            <div class="row">
                                @if(!empty($data_monitoring->linkToMannyProsesPengerjaan))
                                @foreach($data_monitoring->linkToMannyProsesPengerjaan as $data_proses_produksi)
                                    <div class="col-md-12">
                                     <div class="box box-primary ">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">{{ $data_proses_produksi->linkToProsesBisnis->proses_bisnis }}</h3>
                                            <div class="box-tools pull-right">
                                                <a href="{{ url('proses-pengerjaan/'. $data_proses_produksi->id.'/edit') }}" class="btn btn-box-tool"><i class="fa fa-pencil"></i></a>
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                            </div>
                                            <div class="box-body" >
                                                <div class="form-group">
                                                    <label>Mulai dikerjakan</label>
                                                    <p>{{ date('d-m-Y', strtotime($data_proses_produksi->tgl_mulai)) }}, {{ date('H:i:s', strtotime($data_proses_produksi->jam_mulai)) }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <p>{{ $data_proses_produksi->ket }}</p>
                                                </div>
                                                @if(!empty($data_proses_produksi->tgl_selesai) && !empty($data_proses_produksi->jam_selesai))
                                                    <div class="form-group">
                                                        <label>Akhir dikerjakan</label>
                                                        <p>{{ date('d-m-Y', strtotime($data_proses_produksi->tgl_selesai)) }}, {{ date('H:i:s', strtotime($data_proses_produksi->jam_selesai)) }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                @endforeach
                                    <div class="col-md-12">
                                        <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Quality Control</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                            </div>
                                            <div class="box-body" >
                                               <div>
                                                   <table class="table table-responsive">
                                                       <table>
                                                           <thead>
                                                                <form action="{{ url('quality-control/'.$data_monitoring->id.'/update') }}" method="post">
                                                                    <tr>
                                                                        <th>{{ csrf_field() }} Tgl selesai pengecekkan hasil akhir</th>
                                                                        <th>
                                                                            <input type="hidden" name="id_barang" value="{{ $data_monitoring->id_barang }}">
                                                                            <input name="tgl_mulai_qc" value="{{ $data_monitoring->tgl_mulai_qc }}" type="text" required class="form-control"/>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Barang Dalam Proses</th>
                                                                        <th>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label>Bagus</label>
                                                                                        <input type="text" name="jumlah_bdp_bagus" value="{{ $data_monitoring->jumlah_bdp_bagus }}" required class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label>Rusak</label>
                                                                                        <input type="text" name="jumlah_bdp_rusak" value="{{ $data_monitoring->jumlah_bdp_rusak }}" required class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Barang Dalam Proses masuk ke stok akhir persediaan</th>
                                                                        <th>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <input type="radio" @if(!empty($data_monitoring->status_bdp=='1')) checked @endif name="status_bdp" value="1" required>
                                                                                        <label>Ya</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <input type="radio" @if(!empty($data_monitoring->status_bdp=='0')) checked @endif  value="0" name="status_bdp">
                                                                                        <label>Tidak</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Barang Jadi</th>
                                                                        <th>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label>Bagus</label>
                                                                                        <input name="jumlah_brg_jadi_bagus" id="jumlah_brg_jadi_bagus_form" type="number" value="{{ $data_monitoring->jumlah_brg_jadi_bagus }}" required class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label>Rusak</label>
                                                                                        <input name="jumlah_brg_jadi_rusan" type="number" value="{{ $data_monitoring->jumlah_brg_jadi_rusan }}" required class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Tgl kadarluarsa</th>
                                                                        <th><input type="date" name="expired_date_bj" value="{{ $data_monitoring->expired_date_bj }}" class="form-control" required /></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th><p></p><input type="submit" class="btn btn-warning m-3"></th>
                                                                    </tr>
                                                                </form>
                                                           </thead>
                                                       </table>
                                                   </table>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <div class="modal fade" id="modal-status-barang">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Akhiri Produksi</h4>
                </div>
                <form action="{{ url('quality-control-end-produksi') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jumlah Barang Jadi</label>
                                    <input type="hidden" name="id_quality_control">
                                    <input name="jumlah_brg_jadi_bagus" id="jumlah_brg_jadi_bagus_modal" class="form-control" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script>
    callModal = function (id)
    {
       $.ajax({
           url:'{{ url('quality-control') }}/'+id+'/show',
           type:'get',
           dataType: 'json',
           success:function(result){
             $('#jumlah_brg_jadi_bagus_modal').val(result.data.jumlah_brg_jadi_bagus);
             $('[name="id_quality_control"]').val(result.data.id);
             $('#modal-status-barang').modal('show');
           }
       })
    }
</script>
