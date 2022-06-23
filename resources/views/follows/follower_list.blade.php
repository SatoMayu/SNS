@extends('layouts.login')
@section('content')

<h1>Follower List</h1>
@foreach ($followed_users as $followed_user)
  <a href="/users/{{$followed_user->id}}/users_profile">
    <img src="{{asset('storage/'.$followed_user->images)}}">
  </a>
  <p>{{$followed_user->username}}</p>

@endforeach

@foreach($posts as $post)
  <a href="/users/{{$post->user->id}}/users_profile">
    <img src="{{asset('storage/'.$post->images)}}"></a>
  <p>名前：{{$post->user->username}}</p>
  <p>投稿内容：{{$post->post}}</p>

@endforeach

@endsection
