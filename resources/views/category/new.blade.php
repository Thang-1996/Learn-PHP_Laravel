@extends("layout")
@section("title","Create new Category")
@section("contentHeader","Create a New Category")
{{--// thêm section là biến yield động và tham số thứ 2 là 1 string truyền vào--}}
@section("content")
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{url("admin/save-category")}}" method="post" enctype="multipart/form-data">
            @method("POST")
{{--            // method"POST" dùng để báo route--}}
            @csrf
{{--            // dùng để tạo mã token nếu thiếu sẽ báo lỗi 419--}}
            <div class="card-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="category_name" class="form-control @error("category_name") is-invalid @enderror" placeholder="New Category">
                    @error("category_name")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category Image</label>
                    <input type="file" name="category_image" class="form-control" placeholder="New Product Image">
                </div>
{{--                // biến error để lưu lỗi--}}
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
