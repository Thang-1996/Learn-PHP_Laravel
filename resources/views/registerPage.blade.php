@extends("layout")
@section("content")
    <link rel="stylesheet" type="text/css" href="/css/forgotpassword.css"/>
    <link rel="stylesheet" type="text/css" href="/css/loginPage.css"/>

    <div class="img-title">
        <img src="/images/user.PNG"/>
    </div>
    <div class="form-box">
        <div class="box">
            <div class="form-input">
                <x-input.largeInput name="username" holder="UserName"/>
                <x-input.largePass name="password" holder="Password"/>
                <x-input.largePass name="password" holder="ConfirmPassword"/>
                <x-input.largeInput name="email" holder="EmailAddress"/>
            </div>
            <div class="button">
                <button type="submit" class="btn btn-warning">Register</button>
            </div>
            <div class="action">
                <span>Already Have Account?</span>
                <a href="login"><span>Click Here To Login</span></a>
            </div>
        </div>
    </div>
@endsection
