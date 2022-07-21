@extends('layouts.login')

@section('content')

<div class = "profile-wrap">



<img src="{{asset('storage/'.Auth::user()->images)}}" alt="プロフィール画像">
<div class = "profile-inner">

  <form action="/profile/update" method="POST" enctype="multipart/form-data">
    @csrf
    <table>
      <tr>
        <th><label>user name</label></th>
        <td><input type="text" name="name" value={{$user->username}}><span class = "attention">{{$errors->first('name')}}</span></td>
      </tr>

      <tr>
        <th><label>mail address</label></th>
        <td><input type="address" name="mail" value={{$user->mail}}><span class = "attention">{{$errors->first('mail')}}</span></td>
      </tr>

      <tr>
        <th><label>password</label></th>
        <td><input type="password" name="password" ><span class = "attention">{{$errors->first('password')}}</span></td>
      </tr>

      <tr>
        <th><label>password confirm</label></th>
        <td><input type="password" name="password_confirmation" ><span class = "attention">{{$errors->first('password_confirm')}}</span></td>
      </tr>

      <tr>
        <th><label>bio</label></th>
        <td><input type="text" name="bio" value={{$user->bio}}></td>
      </tr>

      <tr>
        <th><label>icon image</label></th>
        <td><input type="file" name="image"></td>
      </tr>
      <tr><input type="hidden" value="{{$user->id}}" name="id"></tr>
    </table>
    <button type="submit" class = "btn btn-danger update-btn" alt="更新ボタン">更新</button>

  </form>
</div>

</div>
@endsection
