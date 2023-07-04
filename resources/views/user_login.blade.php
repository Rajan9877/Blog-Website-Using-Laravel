<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>User | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            @isset($message1)
            <p style="text-align: center; color: rgb(255, 0, 0);">{{$message1}}</p>
            @endisset
            @isset($message2)
            <p style="text-align: center; color: green;">{{$message2}}</p>
            @endisset
            <div class="container" style="margin-bottom: 70px;">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <a href="/" id="logo" style="color: #ff0000; font-size: 50px;">Our Blogs</a>
                        <h3 class="heading">User Login</h3>
                        <!-- Form Start -->
                        <form  action="{{route('user_login_post')}}" method ="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div>
                                <a href="{{route('forgot-password')}}" style="color: black; position: relative; bottom: 7px;" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">Forgot Password</a>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Login"/>
                        </form>
                        <!-- /Form  End -->
                        <p style="margin-top: 7px;"><a style="color: black" onmouseover="this.style.color='red'"  onmouseout="this.style.color='black'" href="{{route('user_signup')}}">Create New Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
