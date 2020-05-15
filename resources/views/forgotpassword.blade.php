@extends("layout")
@section("content")
    <link rel="stylesheet" type="text/css" href="/css/forgotpassword.css"/>

    <div class="img-title">
        <img src="/images/user.PNG"/>
    </div>
    <div class="form-box">
        <div class="box">
            <div class="form-input">
                <x-input.largeInput name="username" holder="UserName"/>
                <x-input.largeInput name="email" holder="EmailAddress"/>
                <x-input.largeInput name="question" holder="YourSecretQuestion?"/>
                <x-input.largeInput name="anwser" holder="Youranwser ?"/>
            </div>
            <div class="button">
                <button type="submit" class="btn btn-warning">Submit</button>
            </div>
            <div class="action">
                <span>Don't Have Account Yet?</span>
                <a href="register"><span>Click Here To Register</span></a>
            </div>
            <div class="action">
                <span>Login</span>
                <a href="register"><span>Click Here To Login</span></a>
            </div>
        </div>
    </div>
@endsection
