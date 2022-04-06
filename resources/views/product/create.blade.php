@extends('layouts.app')
@section('title', '商品登録')
@section('content')
<div class="row ml-5">
    <div class="mb-5 col-md-6 col-md-offset-2">
        <h2>商品登録フォーム</h2>
        <form method="POST" action="{{ route('productStore') }}"  onSubmit="return checkSubmit()" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">
                    商品名
                </label>
                <input
                    id="product_name"
                    name="product_name"
                    class="form-control col-md-6"
                    value="{{ old('product_name') }}"
                    type="text"
                >
                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="company_name">
                    メーカー
                </label>
                <br>
                <select class="form-control col-md-3" name="company_id">
                    <option selected disabled></option>
                @foreach($products as $product)
                    <option id="company_id" name="company_id" value="{{ $product->id }}">{{ $product->company_name }}</option>
                @endforeach
                </select>
                @if ($errors->has('company_name'))
                    <div class="text-danger">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
            <label for="price">
                    価格
                </label>
                <input
                    id="price"
                    name="price"
                    class="form-control col-md-3"
                    value="{{ old('price') }}"
                    type="text"
                >
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
            <label for="stock">
                    在庫数
                </label>
                <input
                    id="stock"
                    name="stock"
                    class="form-control col-md-3"
                    value="{{ old('stock') }}"
                    type="text"
                >
                @if ($errors->has('stock'))
                    <div class="text-danger">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="comment">
                    コメント
                </label>
                <textarea
                    id="comment"
                    name="comment"
                    class="form-control"
                    rows="4"
                >{{ old('comment') }}</textarea>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="image">商品画像登録</label>
                <input type="file" class="form-control-file" name='image' id="image">
            </div>

            <div class="mt-5">

                <a class="btn btn-secondary" href="home">
                    キャンセル
                </a>

                <button type="submit" class="btn btn-primary">
                    登録する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection