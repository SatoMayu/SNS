<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UsersController extends Controller
{
    //
    public function profile()
    {
        return view('users.profile');
    }

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


    // ユーザープロフィール
    public function showUsersProfile($id)
    {
        $profile_id=User::find($id);
        $tweets=Post::where('user_id',$id)->latest()->get();
        

        return view('users.users_profile',compact('profile_id','tweets'));
    }


}
