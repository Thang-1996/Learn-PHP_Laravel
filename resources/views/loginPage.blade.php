@extends("layout")
@section("content")
    <link rel="stylesheet" type="text/css" href="/css/loginPage.css"/>

    <div class="img-title">
        <img src="/images/user.PNG"/>
    </div>
    <div class="form-box">
        <div class="box">
            <div class="form-input">
                <x-input.largeInput name="username" holder="Username"/>
                <x-input.largePass name="password" holder="Password"/>
            </div>
            <div class="button">
                <button type="submit" class="btn btn-warning">Login</button>
            </div>
            <div class="action">
               <span>Don't Have Account Yet?</span>
                <a href="register"><span>Click Here</span></a>
            </div>
            <div class="action">
                <span>Forgot Password?</span>
                <a href="forgotpassword"><span>Click Here</span></a>
            </div>
        </div>
    </div>


@endsection
