<!DOCTYPE html>

<html>
<head>

    <link rel="stylesheet" href="/css/login.css">
    <meta name="viewport" content="width = devide-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Mates</title>
    <script src = "/js/login.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet">

</head>

<body>

<section>

    @yield('form_login')

    @yield('form_register')

    <div id = "login_picture"></div>
    
</section>


</body>
</html>