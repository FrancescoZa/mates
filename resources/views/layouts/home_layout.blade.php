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

    <meta name="csrf-token" content="{{ csrf_token() }}">



</head>



<body onload="start();">

    @yield('menu')

    <section class = "headerMobile">
        <p id = "logoMobile">mates</p>
    </section>

    <section id = "contents">

       <section id = "newPost">

        <form id = "newPostForm" name = "newPostForm" enctype="multipart/form-data" method="post">
            @csrf
            <textarea id = "newPostBar" class = "errorPostBar" name="postContent" cols="40" rows="5" placeholder="Write something here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write something here...'"></textarea>

            <input class = "field" type = "file" name = "imageSelector" id = "imageSelector">
            <button  type = "button" id = "shareBtn" name = "submit" onclick="newPost(); return false;">Share</button>

        </form>

       </section>

       <section id = "postsArea">

        <h1 id = "noPosts">What a pity, there are no posts to show right now.</h1>

       </section>

    </section>


    @yield('secondary_menu')

    @yield('navbar')

</body>



</html>