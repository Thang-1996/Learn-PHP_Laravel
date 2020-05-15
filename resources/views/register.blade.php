@extends("layout")
@section("content")
    <link rel="stylesheet" type="text/css" href="/css/registerstyle.css"/>
    <div class="box-login">
        <div class="left-img">
            <img src="/images/image1.PNG"/>
        </div>
        <div class="right-form">
            <div class="title">
                <img src="/images/logo-instagram.png" width="100px"/>
            </div>
            <div class="form">
                <form>
                    <x-input.textField name="email" holder="UserName"/>
                    <x-input.email name="email" holder="Email"/>
                    <x-input.pass name="email" holder="Password"/>
                    <x-input.pass name="email" holder="ConfirmPassword"/>
                </form>
            </div>
            <div class="button">
                <button type="submit" class="btn btn-info">Register</button>
            </div>
        </div>
    </div>
@endsection

