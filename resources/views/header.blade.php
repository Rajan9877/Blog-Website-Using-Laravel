@php
    use App\Models\Category;
    $categorieg = Category::all();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title') - Our Blogs</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <style>
       #login:hover{
        color: black !important;
       }
       #signup:hover{
        color: black !important;
       }
    </style>
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="/" id="logo" style="color: white; font-size: 50px;">Our Blogs</a>
            </div>
            <!-- /LOGO -->
        </div>
        <div class="authen">
            @if(!(session()->has('username')))
            <a id="login" href="{{route('user_login')}}" style="font-size: 20px; font-weight: bold; margin-right: 10px; color: white;">Login</a>
            <a id="signup" href="{{route('user_signup')}}" style="font-size: 20px; font-weight: bold; color: white;">Sign Up</a>
            @else
            <a id="login" href="{{route('user_logout')}}" style="font-size: 20px; font-weight: bold; margin-right: 10px; color: white;">Logout</a>
            @endif
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    @foreach ($categorieg as $category)    
                    <li><a href='{{route('categories', ['categories' => $category->category_name])}}'>{{$category->category_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
