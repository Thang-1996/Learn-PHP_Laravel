@extends("layout")
@section("title","Product Listing")
@section("contentHeader","Product")
{{--// thêm section là biến yield động và tham số thứ 2 là 1 string truyền vào--}}
@section("content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Product</h3>
            <a href="{{url("/new-product")}}" class="btn btn-outline-success ml-3">+</a>
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
                    <th>Product_Name</th>
                    <th>Product_Image</th>
                    <th>Product_Desc</th>
                    <th>Product_Price</th>
                    <th>Product_Qty</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Create At</th>
                    <th>Update At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                {{--                    dùng vòng lặp đổ dữ liệu vào --}}
                {{--                    // cú pháp vòng lặp của balde engine--}}
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->__get("id")}}</td>
                        <td>{{$product->__get("product_name")}}</td>
                        <td><img src="{{$product->getImage()}}" width="60px"/></td>
                        <td>{{$product->__get("product_desc")}}</td>
                        <td>{{number_format($product->__get("price"))}}</td>
                        {{--                        // number_format de format lai --}}
                        <td>{{$product->__get("qty")}}</td>
                        {{--                        <td>{{$product->__get("category_name")}}</td>--}}
                        {{--                        <td>{{$product->__get("brand_name")}}</td>--}}
                        {{--                        su dung model tra ve doi tuong quan he 1-1 de lay duoc doi tuong Category va lay dc truong Category_name--}}
                        <td>{{$product->Category->__get("category_name")}}</td>
                        <td>{{$product->Brand->__get("brand_name")}}</td>
                        <td>{{$product->__get("created_at")}}</td>
                        <td>{{$product->__get("updated_at")}}</td>
                        <td>
                            <a href="{{url("/edit-product/{$product->__get("id")}")}}"
                               class="btn btn-outline-dark">Edit</a>
                        </td>
                        <td>
                            <form action="{{url("/delete-product/{$product->__get("id")}")}}" method="post">
                                @method("DELETE")
                                @csrf
                                <button type="submit" onclick="return confirm('chac khong?');"
                                        class="btn btn-outline-dark">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $products ->links() !!}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
