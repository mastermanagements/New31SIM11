<div>
    <a href="{{ url('unggah-akta') }}" class="btn btn-block btn-info"><i class="fa fa-sticky-note-o"></i> Unggah Akta Anda</a>
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
                    <h3 class="widget-user-username">{{ $value->getPerusahaan->nm_usaha }}</h3>
                    <h5 class="widget-user-desc">{{ $value->file_akta }}</h5>
                </div>
                <div class="box-footer no-padding" sy>
                    <a href="{{ asset('fileAkta/'.$value->file_akta) }}" class="btn btn-primary pull-right" style="margin: 10px"><i class="fa fa-download"></i></a>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        @endforeach
    </div>
</div>