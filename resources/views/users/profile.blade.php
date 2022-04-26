@extends('layouts.login')

@section('content')

<p>{{$user->images}}</p>

<form action="/profile/update" method="POST">
  @csrf
  <p>
    user name <input type="text" name="newName" placeholder={{$user->username}}>
  </p>

  <p>
    mail address <input type="address" name="newMail" placeholder={{$user->mail}}>
  </p>

  <p>
    password <input type="password" name="newPass" placeholder={{$user->password}}>
  </p>

  <p>
    password comfirm <input type="password" name="newPass" placeholder={{$user->password}}>
  </p>

  <p>
    bio <input type="text" name="newBio" placeholder={{$user->bio}}>
  </p>

  <p>
    icon image <input type="file" name="newImage">
  </p>

  <button type="submit" alt="更新ボタン">更新する</button>

</form>

@endsection
