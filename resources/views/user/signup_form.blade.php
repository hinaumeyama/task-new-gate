@extends('layouts.master_auth')

@section('title', '新規登録画面')

@section('content')
<div class="container">
        <form action="{{ route('store') }}" method="post"  style="margin-top: 50px;" onsubmit="return checkSubmit()">
        @csrf
            <div class="form-group">
                <label for="user_name">ユーザー名</label>
                <div class="col-sm-5">
                    <input type="text" name="user_name" class="form-control" id="user_name" placeholder="ユーザー名">
                </div>
                @if ($errors->has('user_name'))
                    <div class="text-danger">
                        {{ $errors->first('user_name') }}
                    </div>
                @endif
            </div>
            <!--/form-group-->

            <div class="form-group">
                <label  for="email">メールアドレス</label>
                <div class="col-sm-5">
                    <input type="email" name="email" class="form-control" id="email" placeholder="メールアドレス">
                </div>
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <!--/form-group-->

            <div class="form-group">
                <label for="password">パスワード</label>
                <div class="col-sm-5">
                    <input type="password" name="password" class="form-control" id="password" placeholder="パスワード">
                </div>
                @if ($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <!--/form-group-->

            <div class="form-group">
                <label for="password_confirmation">確認用パスワード</label>
                <div class="col-sm-5">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="確認用パスワード">
                </div>
                @if ($errors->has('password_confirmation'))
                    <div class="text-danger">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif
            </div>
            <!--/form-group-->

            <div class="form-group">
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-primary">新規登録</button>
                </div>
            </div>
            <!--/form-group-->
        </form>
        <div class="col-sm-5">
            <a class="btn btn-secondary" href="/">戻る</a>
        </div>
</div>
@endsection