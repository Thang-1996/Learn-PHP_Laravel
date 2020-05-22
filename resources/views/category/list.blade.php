@extends("layout")
@section("title","Category Listing")
@section("contentHeader","Category")
{{--// thêm section là biến yield động và tham số thứ 2 là 1 string truyền vào--}}
@section("content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category</h3>
                <a href="{{url("/new-category")}}" class="btn btn-outline-success ml-3">+</a>
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
                    <th>Category_Name</th>
                    <th>Create_At</th>
                    <th>Update_At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                {{--                    dùng vòng lặp đổ dữ liệu vào --}}
                {{--                    // cú pháp vòng lặp của balde engine--}}
                @foreach($categories as $category)
                <tr>
{{--                    <td>{{@$category->id}}</td>--}}
{{--                    <td>{{@$category->category_name}}</td>--}}
{{--                    <td>{{@$category->created_at}}</td>--}}
{{--                    <td>{{@$category->updated_at}}</td>--}}
                    <td>{{$category->__get("id")}}</td>
                    <td>{{$category->__get("category_name")}}</td>
                    <td>{{$category->__get("created_at")}}</td>
                    <td>{{$category->__get("updated_at")}}</td>
                    <td>
                        <a href="{{url("/edit-category/{$category->__get("id")}")}}" class="btn btn-outline-dark">Edit</a>
                    </td>
                    <td>
                        <form action="{{url("/delete-category/{$category->__get("id")}")}}" method="post">
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
