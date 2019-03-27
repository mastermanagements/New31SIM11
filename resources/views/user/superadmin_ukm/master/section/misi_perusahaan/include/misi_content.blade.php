<div>
    <a href="{{ url('membuat-misi') }}" class="btn btn-block btn-info"><i class="fa fa-sticky-note-o"></i> Masukan Misi Anda</a>
    @if(!empty(session('message_success')))
        <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
    @elseif(!empty(session('message_fail')))
        <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
    @endif
    <p></p>
    <div class="row">
        @foreach($misi as $value)

        <div class="col-md-6">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-green">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('logoUsaha/'.$value->getPerusahaan->logo) }}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $value->getPerusahaan->nm_usaha }}</h3>
                    <h5 class="widget-user-desc">Misi</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li style="padding: 10px">{!! $value->misi !!}</li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        @endforeach
    </div>
</div>