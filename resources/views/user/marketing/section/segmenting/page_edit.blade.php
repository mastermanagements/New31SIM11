@extends('user.marketing.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Segmenting
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulir Edit Segmenting</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('update-segmenting/'. $data_subsg->id) }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori Segmenting</label>
                                <input type="text" name="item_sub_segmenting" class="form-control" value="{{ $data_subsg->item_sub_segmenting }}" id="exampleInputEmail1" required>
                                <small style="color: red">* Tidak Boleh Kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Kategori Segmenting</label>
                                <input type="text" name="item_subsub_segmenting" class="form-control"  value="{{ $data_subsg->getSubSubSegmenting->item_subsub_segmenting  }}"  id="exampleInputEmail1">
                            </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Sub Sub Kategori Segmenting</label>
                                <input type="text" name="content_segmenting" class="form-control"  value="{{ $data_subsg->getSubSubSegmenting->getContentSegmenting->content_segmenting }}"  id="exampleInputEmail1">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop

