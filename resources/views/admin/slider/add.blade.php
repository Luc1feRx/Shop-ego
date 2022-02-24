@extends('admin.master')


@section('content')
<div class="card card-primary">
        <form action="" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Tiêu Đề</label>
                <input type="text" class="form-control" value="{{old('name')}}" id="exampleInputEmail1" name="name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Đường Dẫn</label>
                <input type="text" class="form-control" value="{{old('url')}}" id="exampleInputEmail1" name="url">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Sắp Xếp</label>
                <input type="number" class="form-control" value="{{old('sort_by')}}" id="exampleInputEmail1" name="sort_by">
            </div>


            <div class="form-group">
                <label for="exampleInputFile">Hình Ảnh</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" class="form-control" name="thumb" id="thumb">
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Kích Hoạt</label>
                <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="active" checked>
                <label class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="0" name="active">
                    <label class="form-check-label">Không</label>
                </div>
            </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
        </div>
        </form>
  </div>
@endsection
