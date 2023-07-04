<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\AuthSignup;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
{
    $posts = Post::orderBy('created_at', 'desc')->paginate(3);
    return view('index', compact('posts'));
}
    public function single($post_id){
        $intid = intval($post_id);
        $posts = Post::where('post_id',$intid)->get();
        return view('single',compact('posts'));
        // foreach($posts as $post){
        //     echo($post->post_title);
        // }
    //     foreach($posts as $post){
    //     echo $post->title;
    // }
}
public function search(Request $request){
    $search = $request->input('search');
    $posts = Post::where('title','like','%'.$search.'%')->orwhere('description','like','%'.$search.'%')->orwhere('category','like','%'.$search.'%')->orwhere('post_date','like','%'.$search.'%')->orwhere('author','like','%'.$search.'%')->get();
    return view('search',compact('posts','search'));
    // return $posts;
}

public function categories($categories){
    $posts = Post::where('category','like','%'.$categories.'%')->paginate(3);
    return view('category',compact('posts','categories'));
}

public function author($author){
    $posts = Post::where('author','like','%'.$author.'%')->paginate(3);
    return view('author',compact('posts','author'));
}

public function user_signup(){
    return view('user_signup');
    // return "success";
}

public function user_signup_post(Request $request){
    $name = $request->name;
    $email = $request->email;
    $username = $request->username;
    $password = $request->password;
    $conpassword = $request->conpassword;
    if($password !== $conpassword){
        $message1 = "Password din't match!";
        return view('user_signup', compact('message1'));
    }
    $signup_users = AuthSignup::where('username',$username)->get();
    if(count($signup_users) > 0){
        $message1 = "Username already exists!";
        return view('user_signup', compact('message1'));
    }
    $user_signup = new AuthSignup;
    $user_signup->name = $name;
    $user_signup->email = $email;
    $user_signup->username = $username;
    $user_signup->password = $password;
    $user_signup->save();
    $message2 = "You have successfully signed in.";
    return view('user_signup', compact('message2'));
    // return $email;
    // return "signup post";
}

public function user_login_post(Request $request){
    $username = $request->username;
    $password = $request->password;
    // return gettype($password);
    $signup_user = AuthSignup::where('username', $username)->first();
    if(!$signup_user){
        $message1 = "User does not exist!";
        return view('user_login',compact('message1'));
    }
    if ($password !== $signup_user->password) {
        $message1 = "Password din't match with the user!";
        return view('user_login',compact('message1'));
    }else{
        $request->session()->put('username', $username);
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return view('index', compact('posts'));
    }
    // echo var_dump(Hash::check($password, $hashedPassword));
    // return view('auth.welcome');
}

public function user_logout(){
    session()->flush();
    $posts = Post::orderBy('created_at', 'desc')->paginate(3);
    return view('index', compact('posts'));
 }

public function user_login(){
    return view('user_login');
}

public function comment(Request $request){
    $hidden = $request->hidden;
    if (!($request->session()->get('username'))) {
        $message = "Please login first!";
        $comments = Comment::where('post_id', $hidden)
            ->orderBy('id', 'desc')
            ->get();
        
        return response()->json([
            'comments' => $comments,
            'message' => $message
        ]);
    }
    $comment = $request->comment;
    $username = $request->session()->get('username');
    $date = now();
    // return gettype($hidden);
    Comment::insert(['comment' => $comment,'username' => $username, 'post_id'=> $hidden, 'date' => $date]);
    $message = "Comment Added Successfully.";
    $comments = Comment::where('post_id', $hidden)
    ->orderBy('id', 'desc')
    ->get();
    return response()->json([
        'comments' => $comments,
        'message' => $message
    ]);
}

public function forgot_password(Request $request){
    $email = $request->email;
    $token = $request->_token;
    $user = AuthSignup::where('email',$email)->first();
    if($user == null){
        $message1 = "User does not exist with this email.";
        return view('forgot_password',compact('message1')); 
    }
    $resetLink = 'http://localhost:8000/reset-password?email=' . urlencode($email) . '&token=' . urlencode($token);
        Mail::to($email)->send(new ResetPasswordEmail($resetLink));
        $passwordData = new PasswordResetToken;
        $passwordData->email = $email;
        $passwordData->_token = $token;
        $passwordData->save();
        $message2 = "Reset password link sent to your email.";
        return view('forgot_password',compact('message2')); 
}

public function reset_password(Request $request){
    $token = $request->token;
    $email = $request->email;
    $newpassword = $request->newpassword;
    $conpassword = $request->conpassword;
    if($newpassword !== $conpassword){
        $resetLink = 'http://localhost:8000/reset-password?email=' . urlencode($email) . '&token=' . urlencode($token);
        $message1 = "Passwords do not match with each other.";

// Append the message to the reset link as a query parameter
        $resetLink .= '&message=' . urlencode($message1);

// Redirect the user to the reset link
       
// Redirect the user to the reset link
        return redirect($resetLink);
    }
    $tokenData = PasswordResetToken::where('_token', $token)->where('email', $email)->first();

    if ($tokenData !== null) {
        $user = AuthSignup::where('email', $email)->first();

        if ($user !== null) {
            $user->password = $newpassword;
            $user->save();

            PasswordResetToken::where('_token', $token)->delete();

            $message2 = "Your password has been changed successfully.";
            return view('user_login',compact('message2'));
        }
    }

    $message1 = "Invalid token or email.";
    return view('reset_password',compact('message1'));

}

}

