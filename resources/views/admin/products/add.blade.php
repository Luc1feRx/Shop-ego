@extends('admin.master')

@section('ckeditor')
    <script src="{{ asset('template/admin/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="card card-primary">
        <form action="" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" value="{{old('product_name')}}" id="exampleInputEmail1" placeholder="Nhập Tên Sản Phẩm" name="product_name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">Danh Mục</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder" name="category_id">
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá Gốc</label>
                        <input type="number" class="form-control" value="{{old('product_price')}}" id="exampleInputEmail1" placeholder="Nhập Giá Gốc" name="product_price">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá Giảm</label>
                        <input type="number" class="form-control" value="{{old('product_price_sale')}}" id="exampleInputEmail1" placeholder="Nhập Giá Giảm" name="product_price_sale">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Mô Tả</label>
                <textarea name="product_description" id="ckeditor3" class="form-control" cols="30" rows="10">{{old('product_description')}}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Nội Dung</label>
                <textarea name="product_content" id="ckeditor1" class="form-control" cols="30" rows="10">{{old('product_description')}}</textarea>
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
