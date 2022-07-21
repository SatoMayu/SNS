@extends('layouts.login')

@section('content')
<div class = "first_content">
  <div class="first_content_wrap">
    <div>
      <form action="http://127.0.0.1:8000/search" method="POST">
        @csrf
        <div class = "search-form_inner_left">
          <p><input type="text" name="keyword_name" placeholder="ユーザー名"></p>
          <P><input type="submit" value="検索"></p>
        </div>
      </form>
    </div>
    <div class = "search-form_inner_right">
      @if(!empty($keyword_name))
      <p>検索ワード：{{$keyword_name}}</p>
      @endif
    </div>
  </div>
</div>

<div class = "second_content">
  @foreach ($users as $users)
    <div class = "result-list">
      @if($users->id != Auth::id())
        <div class = "tweet-list_left">
          <td><img src="{{asset('storage/'.$users->images)}}"></td>
          <div class ="tweet-list_left_inner">
            <td>{{$users->username}}</td>
          </div>
        </div>
        <div class ="tweet-list_right">
          <td>
            @if (auth()->user()->isFollowing($users->id))

            <form action="{{route('unfollow',['id'=>$users->id])}}" method="POST">
              {{csrf_field()}}
              {{method_field('DELETE')}}

              <button type="submit" class = "btn btn-danger remove-btn">フォロー解除</button>
            </form>

            @else

            <form action="{{route('follow',['id'=>$users->id])}}" method="POST">
              {{csrf_field()}}
              <button type="submit"  class = "btn btn-primary following-btn">フォローする</button>
            </form>
            @endif
          </td>
        </div>
      @endif

      </div>
    @endforeach
</div>



@endsection
