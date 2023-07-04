<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NewPost;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function add_user(Request $request){
        $first_name = $request->input('fname');
        $last_name = $request->input('lname');
        $username = $request->input('user');
        $password = $request->input('password');
        $role = $request->input('role');
        $users = User::where('username', $username)->get();;
        if($users->isEmpty()){
            $users = new User();
            $users->first_name = $first_name;
            $users->last_name = $last_name;
            $users->username = $username;
            $users->password = $password;
            $users->role = $role;
            $users->save();
            $users = User::paginate(5);
            return view('admin.users',compact('users'));
            // return view('admin.users');
        }
    }
    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $users = User::where('username', $username)->get();
        if($users->isEmpty()){
            $message = "Username does not exist!";
            return view('admin.index', ['message' => $message]);
        }
        foreach($users as $user){
            if($user->password == $password){
                $request->session()->put('username', $username);
                $request->session()->put('first_name', $user->first_name);
                $posts = Post::paginate(5);
                return view('admin.post',compact('posts'));
            }else{
                $message = "Wrong password!";
                return view('admin.index', ['message' => $message]);
            }
        }
    }
    public function logout(){
        session()->forget('username');
        return view('admin.index');
    }
    public function add_category(Request $request){
        $cat = $request->input('cat');
        $category = Category::where('category_name', $cat)->get();
        if($category->isEmpty()){
            $Category = new Category();
            $Category->category_name = $cat;
            $Category->save();
            $message = "Your category has been inserted successfully.";
            return view('admin.add-category',['message'=>$message]);
        }else{
            $message = "Category already exists!";
            return view('admin.add-category',['message'=>$message]);
        }
    }
    public function add_post(){
        $categories = Category::all();
        return view('admin.add-post',compact('categories'));
    }
    
    public function add_posts(Request $request)
    {
        $title = $request->input('post_title');
        $description = $request->input('postdesc');
        $category = $request->input('category');
        $image_path = $request->file('fileToUpload')->store('image', 'public');
        $author = $request->session()->get('first_name');
    
        $add_post = new Post();
        $add_post->title = $title;
        $add_post->description = $description;
        $add_post->category = $category;
        $add_post->post_date = now();
        $add_post->author = $author;
        $add_post->post_img = $image_path;
        $add_post->save();
    
        // Increment the post count for the corresponding category
        Category::where('category_name', $category)->increment('post');
    
        $message = "Post has been added successfully.";
        $categories = Category::all();
    
        return view('admin.add-post', compact('categories', 'message'));
    }
    
    public function category(){
        $categories = Category::paginate(5);
        return view('admin.category', compact('categories'));
    }
    public function posts(){
        $posts = Post::paginate(5);
        return view('admin.post',compact('posts'));
    }

    public function users(){
        $users = User::paginate(5);
        return view('admin.users',compact('users'));
    }

    public function delete($post_id){
        $intid = intval($post_id);
        $post = Post::where('post_id',$intid)->first();
        $category = $post->category;
        // Decrement the post count for the corresponding category
        Category::where('category_name', $category)->decrement('post');
        Post::where('post_id',$intid)->delete();
        $posts = Post::paginate(5);
        return view('admin.post',compact('posts'));
    }

    public function deleteuser($user_id){
               $intid = intval($user_id);
               User::where('user_id',$user_id)->delete();
               $users = User::paginate(5);
               return view('admin.users',compact('users'));
    }

    public function updateuser($user_id){
        $intid = intval($user_id);
        $user = User::where('user_id',$user_id)->get();
        return view('admin.update-user',compact('user'));
    }

    public function updateusr(Request $request){
        $userid = $request->input('user_id');
        $intid = intval($userid);
        $firstname = $request->input('f_name');
        $lastname = $request->input('l_name');
        $username = $request->input('username');
        $role = $request->input('role');
        $introle = intval($role);
        // dd($request->all());
        $user = User::where('user_id', $intid)->update(["first_name" => $firstname,"last_name" => $lastname, "username" => $username, "role" => $introle]);
        // $user->first_name = $firstname;
        // $user->last_name = $lastname;
        // $user->username = $username;
        // $user->role = $introle;
        // $user->save();
        // return $user;
        
        $users = User::paginate(5);
        return view('admin.users', compact('users'));
        
    }

    public function updatepost($post_id){
        $intid = intval($post_id);
        $posts = Post::where('post_id', $intid)->get();
        $categories = Category::all();
        return view('admin.update-post',compact('posts', 'categories'));
    }
    public function updateposts(Request $request){
        $postid = $request->input('post_id');
        $intid = intval($postid);
        $posttitle = $request->input('post_title');
        $postdescription = $request->input('postdesc');
        $postcategory = $request->input('category');
        if($request->file('newimage')!==null){
            $image_path = $request->file('newimage')->store('image','public');
        }else{
            $images = Post::where('post_id', $intid)->first();
            $image_path = $images->post_img;
    }
        $post = Post::where('post_id', $intid)->update(["title" => $posttitle,"description" => $postdescription, "category" => $postcategory, "post_img" => $image_path]);
        $posts = Post::paginate(5);
        return view('admin.post',compact('posts'));
        // return $image_path;
        // return "hi";
        // return $image_path;
    }

    public function deletecategory($category_id){
        $catid = intval($category_id);
        Category::where('category_id',$catid)->delete();
        $categories = Category::paginate(5);
        return view('admin.category', compact('categories'));
    }

    public function updatecategory($category_id){
        $catid = intval($category_id);
        $category = Category::where('category_id',$catid)->get();
        return view('admin.update-category', compact('category'));
    }

    public function updatecat(Request $request){
        $catid = $request->input('cat_id');
        $intid = intval($catid);
        $catname = $request->input('cat_name');
        Category::where('category_id', $intid)->update(["category_name" => $catname]);
        $categories = Category::paginate(5);
        return view('admin.category', compact('categories'));
    }
}
