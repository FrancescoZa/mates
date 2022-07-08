<!DOCTYPE html>

<script>

    function onResponse(response){
     
        return response.json();
        
    }

    function onJSONsession(json){

        if(json == 0){
            window.open("login","_self"); redirrect
    
        }
     }
    
     fetch("home/checkUserSession").then(onResponse).then(onJSONsession);


</script>

<html>

<head>

    <link rel="stylesheet" href="/css/home.css">
    <meta name="viewport" content="width = devide-width, initial-scale=1">
    <title>Mates - Home</title>
    <script src = "/js/home.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">



</head>



<body onload="start();">

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

    <section class = "headerMobile">
        <p id = "logoMobile">mates</p>
    </section>

    <section id = "contents">

       <section id = "newPost">

        <form id = "newPostForm" name = "newPostForm" enctype="multipart/form-data" method="post">
            <?php echo csrf_field(); ?>
            <textarea id = "newPostBar" class = "errorPostBar" name="postContent" cols="40" rows="5" placeholder="Write something here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write something here...'"></textarea>

            <input class = "field" type = "file" name = "imageSelector" id = "imageSelector">
            <button  type = "button" id = "shareBtn" name = "submit" onclick="newPost(); return false;">Share</button>

        </form>

       </section>

       <section id = "postsArea">

        <h1 id = "noPosts">What a pity, there are no posts to show right now.</h1>

       </section>

    </section>

    <aside id = "secondary_menu">

        <div id = "search_container">

        <form name = "search" id = "searchForm" autocomplete="off" onkeyup="searchFriend()" onsubmit = "return false;">

            <input class = "searchField" type = "text" name = "searchValue" placeholder="Find new mates" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Find new mates'">
            
        </form>

        </div>

        <div id = "newFriends_container">


            <div id = "newFriendsBackground" class = "newFriendsBackground">
                 
                <?php echo $__env->yieldContent('friend_content'); ?>

            </div>

        </div>

        

    </aside>

    <footer>

            <button onclick = "goHome()"><i class="material-icons" style="font-size: 30px">home</i></button>
            <button onclick = "toProfile()"><i class="material-icons" style="font-size: 30px">face</i><span id = "user_id" style="display:none">session id</span></button>
            <button onclick="goToEvents()"><i class="material-icons" style="font-size: 30px">event</i></button>
            <button><i class="material-icons" style="font-size: 30px">favorite_border</i></button>

    </footer>

</body>



</html><?php /**PATH D:\xampp\htdocs\Laravel\mates\resources\views/layouts/home.blade.php ENDPATH**/ ?>