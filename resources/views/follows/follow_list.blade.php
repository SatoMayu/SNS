@extends('layouts.login')

@section('content')

<h1>Follow List</h1>
@foreach ($following_users as $following_user)

  <p>{{$following_user->images}}</p>
  <p>{{$following_user->username}}</p>

@endforeach

@foreach($posts as $post)
  <a href="/users/{{$post->user->id}}/users_profile">{{$post->user->images}}</a>
  <p>名前：{{$post->user->username}}</p>
  <p>投稿内容：{{$post->post}}</p>

@endforeach

@endsection