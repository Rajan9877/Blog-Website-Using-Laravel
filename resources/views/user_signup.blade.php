<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>User | Sign Up</title>
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
                        <h3 class="heading">User Sign Up</h3>
                        <!-- Form Start -->
                        <form  action="{{route('user_signup_post')}}" method ="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="conpassword" class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Sign Up"/>
                        </form>
                        <!-- /Form  End -->
                        <p style="margin-top: 7px;"><a style="color: black" onmouseover="this.style.color='red'"  onmouseout="this.style.color='black'" href="{{route('user_login')}}">Already have an account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
