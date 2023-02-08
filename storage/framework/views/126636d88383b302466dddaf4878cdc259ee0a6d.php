<!DOCTYPE html>


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

    <?php echo $__env->yieldContent('menu'); ?>

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


    <?php echo $__env->yieldContent('secondary_menu'); ?>

    <?php echo $__env->yieldContent('navbar'); ?>

</body>



</html><?php /**PATH D:\xampp\htdocs\Laravel\mates\resources\views/layouts/home_layout.blade.php ENDPATH**/ ?>