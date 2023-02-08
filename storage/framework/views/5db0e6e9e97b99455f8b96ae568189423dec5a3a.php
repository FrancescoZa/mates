<?php $__env->startSection('form_login'); ?>

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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('form_register'); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.welcome_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\mates\resources\views/welcome.blade.php ENDPATH**/ ?>