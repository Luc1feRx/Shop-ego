@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
    <!-- form start -->
    <form action="{{ route('save-cate') }}" method="post">
        {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Tên Danh Mục</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Danh Mục" name="category_name">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Danh Mục Cha</label>
          <select class="custom-select form-control-border" id="exampleSelectBorder" name="parent_id">
            <option value="0">Danh Mục Cha</option>
              @foreach ($category_parent as $item)
                <option value="{{$item->id}}">{{$item->category_name}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Mô Tả</label>
            <textarea name="category_desc" id="ckeditor3" class="form-control" cols="30" rows="10"></textarea>
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

@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
        CKEDITOR.replace('id4');
    </script>
@endsection
