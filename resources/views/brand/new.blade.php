@extends("layout")
@section("title","Create new brand")
@section("contentHeader","Create a New brand")
{{--// thêm section là biến yield động và tham số thứ 2 là 1 string truyền vào--}}
@section("content")
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{url("admin/save-brand")}}" method="post" enctype="multipart/form-data">
            @method("POST")
{{--            // method"POST" dùng để báo route--}}
            @csrf
{{--            // dùng để tạo mã token nếu thiếu sẽ báo lỗi 419--}}
            <div class="card-body">
                <div class="form-group">
                    <label>brand Name</label>
                    <input type="text" name="brand_name" class="form-control @error("brand_name") is-invalid @enderror" placeholder="New brand">
                    @error("brand_name")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Brand Logo</label>
                    <input type="file" name="brand_image" class="form-control" placeholder="New Brand Logo">
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
