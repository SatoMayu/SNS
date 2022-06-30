<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Post;
use Auth;
use App\Http\Requests\UpdateFormRequest;

class UsersController extends Controller
{
    //

    public function index()
    {
        $users = User::get();

        // $users = \DB::table('users')->get();に書き換え可能
        // ↑DB内のusersテーブルからgetしてきた内容を代入
        return view('users.search_form',compact('users'));
    }

    public function search(Request $request)
    {
        $keyword_name=$request->input('keyword_name');

        if(!empty($keyword_name)){
            $query = User::query();
            $users=$query->where('username','like',"%{$keyword_name}%")->get();

            return view('users.search_form',compact('users','keyword_name'));
        }

        else{
            return redirect('/search-form');
        }
    }

    public function follow($id)
    {
        $follower=auth()->user();
        // ↑ログイン中のユーザー自身
        $is_following = $follower->isFollowing($id);
                          // ↑ログイン中のユーザー自身からフォローしてるidを引っ張ってくる
        if(!$is_following){
            $follower->follow($id);
            return back();
        }
    }

    public function unfollow($id)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($id);
        if($is_following){
            $follower->unfollow($id);
        }
        return back();
    }


    // 他ユーザープロフィール
    public function showUsersProfile($id)
    {
        $profile_id=User::find($id);
        $tweets=Post::with('user')->where('user_id',$id)->get();
        // $tweets=Post::where('user_id',$id)->latest()->get();
        // ↑これだと負荷がかかってしまうので、withでメソッドを使ってあげる

        return view('users.users_profile',compact('profile_id','tweets'));
    }

    // ログインユーザーのプロフィール
     public function profile()
    {
        $user=auth()->user();

        return view('users.profile',compact('user'));
    }


    // public function validator($data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'mail' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:4|confirmed',
    //         'password_confirm' => 'required|string|min:4|confirmed',
    //         'bio' => 'required|string|min:4|confirmed',


    //     ]);
    // }


    public function profileUpdate(UpdateFormRequest $request)
    {

        $user=auth()->user();



        $username=$request->input('name');
        $mail=$request->input('mail');
        $password=$request->input('password');
        // $password_confirm=$request->input('password_confirm');
        $bio=$request->input('bio');

        $image=$request->file('image');
        $path=$user->images;

        // if (isset($image)){
        //     $path=$image->store('');
        //     // ↑↑ store('任意のディレクトリ')
        if($request->file('image')){
            $file_name = $request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('public',$file_name);

            User::where('id',Auth::user()->id)->update([
                'images'=>$file_name
            ]);
        }


        User::where('id',Auth::user()->id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => bcrypt($password),
            'bio' => $bio,

        ]);
        return redirect('/top');

    }

}
