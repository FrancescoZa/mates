<!DOCTYPE html>

<html>
<head>

    <link rel="stylesheet" href="/css/login.css">
    <meta name="viewport" content="width = devide-width, initial-scale=1">
    <title>Mates</title>
    <script src = "login.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet">

</head>

<body>

<section>

    <div id = "form_container_login">

        <p id = "logo">mates</p>
        <p id = "slogan">Know your people</p>

        
        <form name = "login" id = "formLogin">
     
            <p>Username</p>
            <input class = "field" type="text" name = "Username" id = "username">

            <p>Password</p>
            <input class = "field" type="password" name = "Password" id = "password">

            <p id = "alertLog" class = "alert"></p>

            <div>

                <button id = "register" onclick="onRegister(); return false;">Sign up</button>
                <button id = "loginBtn" name = "submit" onclick="validateFormLogin(); return false;">Login</button>

            </div>

         </form>
        
    </div>

    <div id = "form_container_register">

        <p id = "logo">mates</p>
        <p id = "slogan">Know your people</p>

        <form name = "register">
     
            <p>Username</p>
            <input class = "field" type="text" name = "Username">

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

    <div id = "login_picture"></div>
    
    




</section>


</body>
</html><?php /**PATH D:\xampp\htdocs\Laravel\mates\resources\views/login.blade.php ENDPATH**/ ?>