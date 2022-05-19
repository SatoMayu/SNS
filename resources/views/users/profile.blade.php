@extends('layouts.login')

@section('content')

<img src="{{asset('storage/profiles/'.$user->images)}}" alt="プロフィール画像">

<form action="/profile/update" method="POST" enctype="multipart/form-data">
  @csrf
  <p>
    user name <input type="text" name="name" value={{$user->username}}>
  </p>
  <div>{{$errors->first('name')}}</div>

  <p>
    mail address <input type="address" name="mail" value={{$user->mail}}>
  </p>
  <div>{{$errors->first('mail')}}</div>

  <p>
    password <input type="password" name="password" >
  </p>
  <div>{{$errors->first('password')}}</div>

  <p>
    password confirm <input type="password" name="password_confirmation" >
  </p>
  <div>{{$errors->first('password_confirm')}}</div>

  <p>
    bio <input type="text" name="bio" value={{$user->bio}}>
  </p>

  <p>
    icon image <input type="file" name="image">
  </p>

  <button type="submit" alt="更新ボタン">更新する</button>

</form>

@endsection
