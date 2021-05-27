<div class="tab-pane @if(Session::get('tab1') == 'tab1') active @else '' @endif" id="tab_1">
    <a href="{{ url('sop-produksi/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah</a>
    <p></p>
    <div class="row">
        @if(!empty($sop_produksi))
            @foreach($sop_produksi as $p_proses_produksi)
                <div class="col-md-12">
                <div class="box box-primary collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $p_proses_produksi->nama_sop }}</h3>
                        <div class="box-tools pull-right">
                            <form action="{{ url('sop-produksi/'.$p_proses_produksi->id) }}" method="post">
                                {{ csrf_field() }}
                                @method('delete')
                                 <a href="{{ url('proses-bisnis/'.$p_proses_produksi->id) }}" class="btn btn-box-tool" title="Tambah Proses Bisnis"><i class="fa fa-plus-circle"></i></a>
                                 <a href="{{ url('barang-sop/'.$p_proses_produksi->id) }}" class="btn btn-box-tool" title="Tambah barang SOP"><i class="fa fa-plus-square"></i></a>
                                 <a href="{{ url('sop-produksi/'.$p_proses_produksi->id.'/edit') }}" class="btn btn-box-tool" title="Ubah Nama SOP"><i class="fa fa-pencil"></i></a>
                                 @if(empty($p_proses_produksi->LinkToMannyPSOPProduksi))
                                 <button type="submit" class="btn btn-box-tool" title="Hapus Nama SOP" onclick="return confirm('Apakah anda akan menghapus SOP Produksi ini ...?')"><i class="fa fa-eraser"></i></button>
                                 @endif
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Buka-tutup"><i class="fa fa-times"></i>
                            </form>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: none;">
                        @if(!empty($p_proses_produksi->LinkToMannyPSOPProduksi))
                            <div class="row">
                            @php($no=1)
                            @foreach($p_proses_produksi->LinkToMannyPSOPProduksi as $data)
                                <div class="col-md-12">

                                        <div class="box-header with-border">
                                            <h3 class="box-title">{{ $no++ }}.&nbsp;{{ $data->proses_bisnis }}</h3>
                                            <br>
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->ket }}
                                            <div class="box-tools pull-right">
                                                <form action="{{ url('proses-bisnis/'.$data->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('proses-bisnis/'.$data->id.'/edit') }}" class="btn btn-box-tool" title="Ubah proses bisnis"><i class="fa fa-pencil"></i></a>
                                                    <button type="submit" class="btn btn-box-tool" title="hapus proses bisnis" onclick="return confirm('Apakah anda akan menghapus proses bisnis ini ...?')"><i class="fa fa-eraser"></i></button>
                                                </form>
                                            </div>
                                            <!-- /.box-tools -->
                                            </div>


                                    </div>
                            @endforeach
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
            <!-- /.box -->
        </div>
            @endforeach
        @endif
    </div>
</div>
