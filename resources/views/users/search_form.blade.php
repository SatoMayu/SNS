@extends('layouts.login')

@section('content')

<form action="http://127.0.0.1:8000/search" method="POST">
  @csrf
  <p><input type="text" name="keyword_name" placeholder="ユーザー名"></p>
  <P><input type="submit" value="検索"></p>
</form>

@if(!empty($keyword_name))
  <p>検索ワード：{{$keyword_name}}</p>
@endif



<table>
  @foreach ($users as $users)
  @if($users->id != Auth::id())
    <tr>
      <td><img src="{{asset('storage/'.$users->images)}}"></td>
      <td>{{$users->username}}</td>
      <td>
        @if (auth()->user()->isFollowing($users->id))

        <form action="{{route('unfollow',['id'=>$users->id])}}" method="POST">
          {{csrf_field()}}
          {{method_field('DELETE')}}

          <button type="submit" >フォロー解除</button>
        </form>

        @else

        <form action="{{route('follow',['id'=>$users->id])}}" method="POST">
          {{csrf_field()}}
          <button type="submit" >フォローする</button>
        </form>
        @endif
      </td>
    </tr>
    @endif
    @endforeach
</table>




@endsection
