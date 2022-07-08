

<?php $__env->startSection('friend_content'); ?>

<article>

<div class = "imagePic">fr</div>
<button id = "name1" onclick="" class = "recommended_friend">@Francesco</button>
<button id = "add1" onclick="" class = "add_recommended_friend">Follow</button>

</article>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>

<section id = "menu">

        <header>

            <p id = "logo">mates</p>

        </header>

        <button onclick = "goHome()"><i class="material-icons" style="font-size: 30px">home</i> <span><b>Home</b><span></button>
        <button onclick = "toProfile()"><i class="material-icons" style="font-size: 30px">face</i> <span>Profile<span><span id = "user_id" style="display:none"><?php echo e(Session::get('id')); ?></span></button>
        <button onclick="goToEvents()"><i class="material-icons" style="font-size: 30px">event</i> <span>News<span></button>
        <button><i class="material-icons" style="font-size: 30px">favorite_border</i> <span>Liked<span></button>
        <a href = "logout"><i class="material-icons" style="font-size: 30px">exit_to_app</i> <span>Logout<span></span></a>

    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('navbar'); ?>

<footer>

    <button onclick = "goHome()"><i class="material-icons" style="font-size: 30px">home</i></button>
    <button onclick = "toProfile()"><i class="material-icons" style="font-size: 30px">face</i><span id = "user_id" style="display:none">session id</span></button>
    <button onclick="goToEvents()"><i class="material-icons" style="font-size: 30px">event</i></button>
    <button><i class="material-icons" style="font-size: 30px">favorite_border</i></button>

</footer>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('secondary_menu'); ?>

<aside id = "secondary_menu">

    <div id = "search_container">

    <form name = "search" id = "searchForm" autocomplete="off" onkeyup="searchFriend()" onsubmit = "return false;">

        <input class = "searchField" type = "text" name = "searchValue" placeholder="Find new mates" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Find new mates'">
        
    </form>

    </div>

    <div id = "newFriends_container">


        <div id = "newFriendsBackground" class = "newFriendsBackground">
             

        </div>

    </div>

    
</aside>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.home_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Laravel\mates\resources\views/home.blade.php ENDPATH**/ ?>