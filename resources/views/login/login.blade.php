@extends('layouts.master_auth')

@section('title', 'ログイン画面')

@section('content')
<div class="container">
    @if (session('success_msg'))
        <div class="alert alert-success">
            {{ session('success_msg') }}
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST" style="margin-top: 50px;">
        @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <div class="col-sm-5">
                    <input type="email" name="email" class="form-control" id="email" placeholder="メールアドレス">
                    @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>
            </div>
            <!--/form-group-->

            <div class="form-group">
                <label for="password">パスワード</label>
                <div class="col-sm-5">
                    <input type="password" name="password" class="form-control" id="password" placeholder="パスワード">
                    @if ($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                </div>
            </div>
            <!--/form-group-->

            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </div>
            </div>
            <!--/form-group-->
        </form>
    <a class="col-sm-12" href="{{ route('signup' )}}">新規登録はこちら</a>
</div>
@endsection