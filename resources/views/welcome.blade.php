@extends('layouts.welcome_layout')

@section('form_login')

<div id = "form_container_login">

    <p id = "logo">mates</p>
    <p id = "slogan">Know your people</p>

    
    <form name = "login" id = "formLogin">
 
        <p>Username</p>
        <input class = "field" type="text" name = "Username" id = "username" autocomplete="off">

        <p>Password</p>
        <input class = "field" type="password" name = "Password" id = "password">

        <p id = "alertLog" class = "alert"></p>

        <div>

            <button id = "register" onclick="onRegister(); return false;">Sign up</button>
            <button id = "loginBtn" name = "submit" onclick="validateFormLogin(); return false;">Login</button>

        </div>

     </form>
    
</div>

@endsection


@section('form_register')

<div id = "form_container_register">

    <p id = "logo">mates</p>
    <p id = "slogan">Know your people</p>

    <form name = "register">
 
        <p>Username</p>
        <input class = "field" type="text" name = "Username" autocomplete="off">

        <p>Password</p>
        <input class = "field" type="password" name = "Password">

        <p>Confirm your password</p>
        <input class = "field" type="password" name = "PasswordConfirm">

        <p id = "alertReg" class = "alert"></p>

        <div>
            <button id = "registerBtn" name = "submit" onclick = "validateFormRegister(); return false">Sign up</button>
        </div>

     </form>

</div>

@endsection