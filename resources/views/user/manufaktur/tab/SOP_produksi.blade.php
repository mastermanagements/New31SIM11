<div class="tab-pane active" id="tab_1">
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
                                 <a href="{{ url('proses-produksi/'.$p_proses_produksi->id) }}" class="btn btn-box-tool" title="Tambah Proses Produksi"><i class="fa fa-plus-circle"></i></a>
                                 <a href="{{ url('barang-sop/'.$p_proses_produksi->id) }}" class="btn btn-box-tool" title="Tambah barang produksi"><i class="fa fa-plus-square"></i></a>
                                 <a href="{{ url('sop-produksi/'.$p_proses_produksi->id.'/edit') }}" class="btn btn-box-tool"><i class="fa fa-pencil"></i></a>
                                 <button type="submit" class="btn btn-box-tool" onclick="return confirm('Apakah anda akan menghapus SOP Produksi ini ...?')"><i class="fa fa-eraser"></i></button>
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </form>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: none;">
                        @if(!empty($p_proses_produksi->LinkToMannyPSOPProduksi))
                            <div class="row">
                            @foreach($p_proses_produksi->LinkToMannyPSOPProduksi as $data)
                                <div class="col-md-12">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">{{ $data->proses_bisnis }}</h3>
                                            <div class="box-tools pull-right">
                                                <form action="{{ url('proses-produksi/'.$data->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    <a href="{{ url('proses-produksi/'.$data->id.'/edit') }}" class="btn btn-box-tool"><i class="fa fa-pencil"></i></a>
                                                    <button type="submit" class="btn btn-box-tool" onclick="return confirm('Apakah anda akan menghapus proses produksi ini ...?')"><i class="fa fa-eraser"></i></button>
                                                </form>
                                            </div>
                                            <!-- /.box-tools -->
                                            </div>
                                            <div class="box-body">
                                                {{ $data->ket }}
                                            </div>
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