@extends('layouts.login')

@section('content')
<!-- ↓↓投稿フォーム開始↓↓ -->
<div class = "first_content">
  <div class="post-form">
    <form action="http://127.0.0.1:8000/posts/create" method="post">
      <img src="{{asset('storage/'.Auth::user()->images)}}" class="icon">
      @csrf
      <textarea type="text" name="newPost" placeholder="投稿内容を入力してください" class="post-form_area"></textarea>
      <button type="submit"><img src="images/post.png" alt="投稿ボタン"></button>
    </form>
    <div>{{$errors->first('newPost')}}</div>
  </div>
</div>
<!-- ↑↑投稿フォーム終了↑↑ -->

<!-- ↓↓ツイート一覧開始↓↓ -->
<div class = "second_content">
  @foreach($list as $list)
    <div class = "tweet-list">
      <div class = "tweet-list_left">
        <td><img src="{{asset('storage/'.$list->user->images)}}" class="tweet-list_icon"></td>
        <div class ="tweet-list_left_inner">
          <p>{{$list->user->username}}</p>
          <p>{{$list->post}}</p>
        </div>
      </div>
      <div class ="tweet-list_right">
        <td>{{$list->created_at}}</td>

        @if($list->user->id == auth()->user()->id)

        <div class = "tweet-list_right_buttons">

          <!-- Button trigger modal -->
          <td>
            <div class = "edit_button">
              <a class="js-modal-open btn" data-toggle="modal" data-target="#exampleModalCenter{{$list->id}}" href="" >
                <img src="images/edit.png" alt="編集ボタン">
              </a>
            </div>
          </td>

          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-test modal-test-centered modal-dialog modal-dialog-centered " role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- 投稿編集フォーム開始 -->
                <div class="modal-body">
                  <form action="/posts/{{$list->id}}/update" method="POST">
                    @csrf
                    <!-- 変更した投稿内容の受け渡し -->
                    <input type="text" name="upPost" class="modal_post" value="{{$list->post}}"></input>
                    <!-- 変更した投稿のidの受け渡し -->
                    <input type="hidden" name="post_id" class="modal_id" placeholder="aiu"value="{{$list->id}}"></input>
                    <div class = "post-update-btn">
                      <button type="submit"><img src="images/edit.png" alt="投稿ボタン"></button>
                    </div>
                    </form>
                </div>
                <!-- 投稿編集フォーム終了 -->
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
              </div>
            </div>
          </div>


          <!-- 削除ボタン -->
          <td>
            <div class = "delete_button">
              <a href="/posts/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash.png" alt="削除ボタン"></a>
            </div>
          </td>

        </div>
        @endif
      </div>
    </div>
  @endforeach
</div>

    @endsection
