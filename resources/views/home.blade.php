@extends('layouts.home_layout')

@section('friend_content')

<article>

<div class = "imagePic">fr</div>
<button id = "name1" onclick="" class = "recommended_friend">@Francesco</button>
<button id = "add1" onclick="" class = "add_recommended_friend">Follow</button>

</article>

@endsection

@section('menu')

<section id = "menu">

        <header>

            <p id = "logo">mates</p>

        </header>

        <button onclick = "goHome()"><i class="material-icons" style="font-size: 30px">home</i> <span><b>Home</b><span></button>
        <button onclick = "toProfile()"><i class="material-icons" style="font-size: 30px">face</i> <span>Profile<span><span id = "user_id" style="display:none">{{ Session::get('id')}}</span></button>
        <button onclick="goToEvents()"><i class="material-icons" style="font-size: 30px">event</i> <span>News<span></button>
        <button><i class="material-icons" style="font-size: 30px">favorite_border</i> <span>Liked<span></button>
        <a href = "logout"><i class="material-icons" style="font-size: 30px">exit_to_app</i> <span>Logout<span></span></a>

    </section>

@endsection

@section('navbar')

<footer>

    <button onclick = "goHome()"><i class="material-icons" style="font-size: 30px">home</i></button>
    <button onclick = "toProfile()"><i class="material-icons" style="font-size: 30px">face</i><span id = "user_id" style="display:none">session id</span></button>
    <button onclick="goToEvents()"><i class="material-icons" style="font-size: 30px">event</i></button>
    <button><i class="material-icons" style="font-size: 30px">favorite_border</i></button>

</footer>

@endsection


@section('secondary_menu')

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

@endsection



