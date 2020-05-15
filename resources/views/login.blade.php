@extends("layout")
@section("content")
    <link rel="stylesheet" type="text/css" href="/css/loginstyle.css"/>
    <div class="box-login">
        <div class="left-img">
            <img src="/images/image1.PNG"/>
        </div>
        <div class="right-form">
            <div class="title">
                <img src="/images/logo-instagram.png" width="100px"/>
            </div>
            <div class="form">
{{--                dung component input de thay the--}}
                <form>
{{--                    thay x input de su dung dc nhieu lan trong cac page khac nhau--}}
                    <x-input.email name="email" holder="Số điện thoại,tên người dùng hoặc email"/>
                    <x-input.pass name="password" holder="Password"/>
                </form>
            </div>
            <div class="button">
                <button type="submit" class="btn btn-info">Login</button>
            </div>
        </div>
    </div>
@endsection
