@extends('layouts.login')

@section('content')
<!-- ↓↓投稿フォーム開始↓↓ -->
<div>
  <form action="http://127.0.0.1:8000/posts/create" method="post">
    @csrf
    <textarea name="newPost" placeholder="投稿内容を入力してください"></textarea>
    <button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="投稿ボタン"></button>
  </form>

</div>

<!-- ↑↑投稿フォーム終了↑↑ -->

<h2>機能を実装していきましょう。</h2>

<table>
  @foreach($list as $list)
    <tr>
      <td>{{$list->user->images}}</td>
      <td>{{$list->user->username}}</td>
      <td>{{$list->post}}</td>
      <td>{{$list->created_at}}</td>

      @if($list->user->id == auth()->user()->id)

      <!-- Button trigger modal -->
      <!-- <td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" post="{{ $list->post }}" post_id="{{ $list->id }}">
          編集
        </button>
      </td> -->

      <td>
        <a class="js-modal-open btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$list->id}}" href="" >
        編集
        </a>
      </td>


      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                <input type="text" name="" class="modal_post" value="{{$list->post}}"></input>

                <input type="hidden" name="" class="modal_id" value="">
                <input type="submit" value="更新">

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
      <td><a class="btn btn-danger" href="/posts/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
      @endif
    </tr>

  @endforeach
</table>


@endsection
