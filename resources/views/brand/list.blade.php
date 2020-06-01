@extends("layout")
@section("title","brand Listing")
@section("contentHeader","brand")
{{--// thêm section là biến yield động và tham số thứ 2 là 1 string truyền vào--}}
@section("content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Brand</h3>
                <a href="{{url("admin/new-brand")}}" class="btn btn-outline-success ml-3">+</a>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>brand_Name</th>
                    <th>Brand_Image</th>
                    <th>Create_At</th>
                    <th>Update_At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                {{--                    dùng vòng lặp đổ dữ liệu vào --}}
                {{--                    // cú pháp vòng lặp của balde engine--}}
                @foreach($brands as $brand)
                <tr>
                    <td>{{$brand->__get("id")}}</td>
                    <td>{{$brand->__get("brand_name")}}</td>
                    <td>{{$brand->__get("brand_image")}}</td>
                    <td>{{$brand->__get("created_at")}}</td>
                    <td>{{$brand->__get("updated_at")}}</td>
                    <td>
                        <a href="{{url("admin/edit-brand/{$brand->__get("id")}")}}" class="btn btn-outline-dark">Edit</a>
                    </td>
                    <td>
                        <form action="{{url("admin/delete-brand/{$brand->__get("id")}")}}" method="post">
                            @method("DELETE")
                            @csrf
                            <button type="submit" onclick="return confirm('chac khong?');" class="btn btn-outline-dark">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
