@extends("layout")
@section("title","Edit Category")
@section("contentHeader","Edit Category")
{{--// thêm section là biến yield động và tham số thứ 2 là 1 string truyền vào--}}
@section("content")
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
{{--        update thì method sẽ là put method trong form thi phai la post @method thi la put--}}
        <form role="form" action="{{url("/update-category/{$category->__get("id")}")}}" method="post">
            @method("PUT")
            {{--            // method"POST" dùng để báo route--}}
            @csrf
            {{--            // dùng để tạo mã token nếu thiếu sẽ báo lỗi 419--}}
            <div class="card-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" value="{{$category->__get("category_name")}}" name="category_name" class="form-control @error("category_name") is-invalid @enderror" placeholder="New Category">
                    @error("category_name")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
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
