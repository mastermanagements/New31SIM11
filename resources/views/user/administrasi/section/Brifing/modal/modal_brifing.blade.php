
<div class="modal  fade" id="modal-brifing">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <form action="{{ url('upload-file-spk') }}" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="title_modal">Formulir Brifing</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="padding-bottom: 2%">
                            <input type="text" id="dateText" class="form-control" name="tgl_usulan_brif" readonly>
                        </div>
                        <div class="col-md-4">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Daftar Usulan Brifing</h3>
                                </div>
                                <div class="box-body">
                                    <div class="direct-chat-messages" id="container_msg" style="overflow-y: scroll; ">
                                    </div>
                                    <div class="form-group">
                                        <label>Materi</label>
                                        <textarea class="form-control" style="height: 80px" id="materi"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Rapat</label>
                                        <div class="form-group">
                                            @foreach($data_jenis_brifing as $value)
                                                <p><label>
                                                    <input type="radio"  name="jenis_rapat" class="minimal" value="{{ $value->id }}" required>
                                                    {{ $value->jenis_rapat}}
                                                </label></p>
                                            @endforeach
                                            <p></p>
                                            <small style="color: red">* Tidak Boleh Kosong</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="saveBtn" type="button" class="btn btn-default bg-green pull-right">Simpan</button>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" id="loading">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                                <!-- end loading -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-md-4">
                            <div class="box box-success box-solid" >
                                <div class="box-header with-border">
                                    <h3 class="box-title">Time Line</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" >
                                    <ul class="timeline"  style="height: 455px; overflow-y: scroll; ">
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="time-label">
                                            <span class="bg-red">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <!-- timeline icon -->
                                            <i class="fa fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                                                <div class="timeline-body">
                                                    ...
                                                    Content goes here
                                                </div>

                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

