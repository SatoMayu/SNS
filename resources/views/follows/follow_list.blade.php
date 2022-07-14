@extends('layouts.login')

@section('content')
<div class = "first_content">
  <div class="first_content_wrap">
    <h1>Follow List</h1>
    <div follow-list_icons>
      @foreach ($following_users as $following_user)

      <a href="/users/{{$following_user->id}}/users_profile">
        <img src="{{asset('storage/'.$following_user->images)}}">
      </a>

      @endforeach
    </div>
  </div>
</div>

<div class = "second_content">
  @foreach($posts as $post)
  <div class = "tweet-list">
    <div class = "tweet-list_left">
      <a href="/users/{{$post->user->id}}/users_profile">
        <img src="{{asset('storage/'.$post->user->images)}}">
      </a>
      <div class ="tweet-list_left_inner">
        <p>名前：{{$post->user->username}}</p>
        <p>投稿内容：{{$post->post}}</p>
      </div>
    </div>
    <div class ="tweet-list_right">
        <p>{{$post->created_at}}</p>
    </div>
  </div>
  @endforeach

</div>
@endsection
