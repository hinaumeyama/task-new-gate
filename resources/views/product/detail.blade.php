@extends('layouts.app')

@section('title', '商品詳細')
@section('content')
<div class="row justify-content-center">
<div class="col-md-11">
    <h2>商品詳細</h2>
    <table class="table table-striped">
        <tr>
            <th>商品情報ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>メーカー</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>コメント</th>
            <th></th>
        </tr>
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset('/storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->image }}" width="200" height="200"></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->company->company_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->comment }}</td>
            <td><button type="button" class="btn btn-primary" onclick="location.href='{{ route('showEdit', $product->id) }}'">編集</button></td>
        </tr>
    </table>
    </div>
</div>
@endsection