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
      <td><a class="btn btn-primary" href="/posts/{{$list->id}}/update-form">更新</a></td>
      <td><a class="btn btn-danger" href="/posts/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
    </tr>
  @endforeach
</table>

@endsection
