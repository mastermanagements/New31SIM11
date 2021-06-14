<div>
    <a href="{{ url('unggah-akta') }}" class="btn btn-block btn-info"><i class="fa fa-sticky-note-o"></i> Tambah Akta Perusahaan</a>
    @if(!empty(session('message_success')))
        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
    @elseif(!empty(session('message_fail')))
        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
    @endif
    <p></p>
    <div class="row">

        @foreach($akta as $value)
        <div class="col-md-6">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-green">
                    <div class="widget-user-image">
                        <img class="img-circle" src="https://cdn2.iconfinder.com/data/icons/file-format-colorful/100/rar-512.png" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $value->getPerusahaan->nm_usaha }}
                      @if($value->getPerusahaan->jenis_kantor !== NULL)
                        @if($value->getPerusahaan->jenis_kantor =='0')
                              (Pusat)
                        @else ($value->getPerusahaan->jenis_kantor =='1')
                              (Cabang)
                        @endif
                      @endif
                    </h3>

                    @if(!empty($value))
                    <form action="{{ url('delete-akta/'.$value->id) }}" method="post">
                        <a href="{{ url('ubah-akta/'.$value->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah </a>
                        {{ csrf_field() }}
                        <input name="_method" value="put" type="hidden">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini...?')"><i class="fa fa-trash"></i> Hapus </button>
                    </form>
                    @endif
                </div>

                <div class="info-box bg-white">
                  <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Nomor Akta</b> <a class="pull-right">{{ $value->no_akta }}&nbsp;</a>
                      </li>
                      <li class="list-group-item">
                        <b>Tanggal Akta</b> <a class="pull-right">{{ date('d-m-Y'),strtotime($value->tgl_akta) }}&nbsp;</a>
                      </li>
                      <li class="list-group-item">
                        <b>Notaris</b> <a class="pull-right">{{ $value->notaris }}&nbsp;</a>
                      </li>
                      @if(!empty($value->no_rak))
                      <li class="list-group-item">
                        <b>Nomor Rak</b> <a class="pull-right">{{ $value->no_rak }}&nbsp;</a>
                      </li>
                      @endif
                      @if(!empty($value->ket))
                      <li class="list-group-item">
                        <b>Keterangan</b> <a class="pull-right">{{ $value->ket }}&nbsp;</a>
                      </li>
                      @endif
                    </ul>
                  </div>
                <div class="box-footer no-padding">
                    <b>File Akta: </b><a class="pull-right" href="{{ asset('fileAkta/'.$value->file_akta) }}" class="btn btn-primary pull-right" style="margin: 10px"><i class="fa fa-download"> Download</i></a>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        @endforeach
    </div>
</div>
