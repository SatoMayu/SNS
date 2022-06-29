@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

  <h3>AtlasSNSへようこそ</h3>

  <div class="section">

    {{ Form::label('e-mail') }}
    {{ Form::text('mail',null,['class' => 'input']) }}
    {{ Form::label('password') }}
    {{ Form::password('password',['class' => 'input']) }}

  </div>
  {{ Form::submit('ログイン') }}

  <p><a href="/register-form">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}


@endsection
