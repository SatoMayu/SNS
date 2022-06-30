<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\User;
use App\Http\Requests\RegisterFormRequest;

class PostsController extends Controller
{
    //タイムライン
    public function index()
    {
        // $list = Post::latest()->get();
        // $list = \DB::table('posts')->get();に書き換え可能
        // ↑DB内のpostsテーブルからgetしてきた内容を代入
        // latestでレコードを新しい順にソート

        $following_id = Auth::user()->follows()->pluck('follows.followed_id');

        $list = Post::with('user')->whereIn('user_id',$following_id)->orWhere('user_id',Auth::id())->latest()->get();

        return view('posts.index',['list'=>$list]);
    }

    // 投稿作成
    public function create(Request $request)
    {
        $post = $request->input('newPost');

        Post::create([
        // \DB::table('posts')->insert([
            'post'=>$post,
            'user_id'=>Auth::id()
            // ↑ログインしているidのみをuser_idに入れる
        ]);

        return redirect('/top');
    }

    // 投稿削除
    public function delete($id)
    {
        Post::where('id',$id)->delete();
        return redirect('/top');
    }

    public function update(Request $request)
    {
        $id = $request->input('post_id');
        $up_post = $request->input('upPost');
        Post::where('id',$id)->update(['post' => $up_post]);
        return redirect('/top');
    }

    // フォローリスト
    public function followList()
    {
        $following_id = Auth::user()->follows()->pluck('follows.followed_id');

        $posts = Post::with('user')->whereIn('user_id',$following_id)->latest()->get();

        $following_users = Auth::user()->whereIn('id',$following_id)->get();

        return view('follows.follow_list',compact('posts','following_users'));
    }

    // フォロワーリスト
    public function followerList()
    {
        $followed_id = Auth::user()->followers()->pluck('follows.following_id');

        $posts = Post::with('user')->whereIn('user_id',$followed_id)->latest()->get();

        $followed_users = Auth::user()->whereIn('id',$followed_id)->get();

        return view('follows.follower_list',compact('posts','followed_users'));
    }


    // Auth認証↓↓
    public function __construct()
    {
        $this->middleware('auth');
    }
}
