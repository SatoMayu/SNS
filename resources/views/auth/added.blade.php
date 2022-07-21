@extends('layouts.logout')

@section('content')

<div section="clear">
  <div class = "inner">
    <p>{{ Session::get('name') }}さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
  </div>
  <div class = "inner">
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>
  </div>
  <div>
    <p><a href="/login" class="btn btn-danger">ログイン画面へ</a></p>
  </div>
</div>

@endsection
