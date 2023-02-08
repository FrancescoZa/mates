<!DOCTYPE html>


<html>

<head>
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/post.css">

    <meta name="viewport" content="width = devide-width, initial-scale=1">
    <title>Mates - Profile</title>
    <script src = "/js/profile.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body onload="start()">

    <section class = "headerMobile">
        <a href="home.php"><p id = "logoMobile">mates</p></a>

    </section>

    <header id = "profile" class = "profile">

        
        <section class = "profile_pic_container">

            <div id = "profile_pic" class = "profile_pic">
                
            </div>

            @php
            $request = request();
            $id = $request['user_id'];

            if($id == Session::get('id')){
                echo "<button class = 'changePictureBtn' onclick='openSettings()'>Change picture</button>";
            }

            @endphp

        </section>

        <section class = "profile_pic_info">
            <div>
            <span id = "username" class = "username"></span>
            @php
            $request = request();
            $id = $request['user_id'];

            if($id != Session::get('id')){
              echo"<button id = 'followBtn' onclick = 'follow(".$id.")'></button>";
            }else{
                echo"<button  id = 'followBtn' style = 'display:none;'></button>";

            }
            @endphp

            <span id = "userId" style = "display:none">
            @php
            $request = request();
            $id = $request['user_id'];

                echo $id;
            
            @endphp
            </span>
            </div>


            <span id = "bio" class = "bio">
            </span>

            @php
            $request = request();
            $id = $request['user_id'];

            if($id == Session::get('id')){
                echo "<button class = 'changeBio' onclick='openSettings()'>Change your bio</button>";
            }
            @endphp
            

            <section class = "follow_info">

                <span class = "title">Posts:</span>
                <span id = "nPosts" class = "number"></span>

                <span class = "title">Following:</span>
                <span class = "number" id = "followingNumber"></span>

                <span class = "title">Followers:</span>
                <span class = "number" id = "followerNumber"></span>

            </section>

        </section>

  
    </header>

          

        

    <header id = "settings" class = "settings">

        <form id = "settingsForm" name = "settingsForm" enctype="multipart/form-data" action="" method="post">

            <div class = "bioContainer">
                <label>Write something interesting about yourself</label>
                <textarea id = "newBioBar" name="BioContent" cols="40" rows="5" placeholder="What do you want people to remember about you?" onfocus="this.placeholder = ''" onblur="this.placeholder = 'What do you want people to remember about you?'"></textarea>
            </div>

            <div class = "picContainer">
            <label>Choose a picture that you like</label>

            <div class = "buttonsContainer">
            <input class = "field" type = "file" name = "imageSelector" id = "imageSelector">
            <button id = "noPicture">Remove picture</button>
            </div>

            <div class = "buttonsContainer">
            <button id = "shareBtn" name = "submit" onclick="saveImp(); return false;">Confirm!</button>
            <button id = "cancelBtn" name = "cancel" onclick="back(); return false;">Back</button>
            </div>

            </div>
        </form>

    </header>
    

    <section id = "postsArea" class = "postsArea">

        <label  id = "noPostsLabel"></label>


    </section>
    
   

</body>

</html>
