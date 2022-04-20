@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-10">
            <a class="text-secondary" href="/home">
                <h2 class=''>商品一覧</h2>
            </a>

            <div class="row">
                <!-- 検索バー -->
                <div class="col-sm">
                    <form id="js-form" method="GET" action="{{ route('search') }}">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">商品名</label>
                            <!--入力-->
                            <div class="col-sm-5">
                                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" id="search_keyword">
                            </div>
                            
                        </div>
                        <!--プルダウンカテゴリ選択-->
                        <div class="form-group row">
                            <label class="col-sm-2">メーカー名</label>
                            <div class="col-sm-3">
                                <select name="company_id" class="form-control" value="">
                                    <option value="">未選択</option>

                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-auto">   
                            <button type="submit" class="btn btn-primary " id="search_button">検索</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-md-10 justify-content-center">

    
    
    <a  class="btn btn-secondary mt-3 mb-3" href="{{ route('showCreate') }}">新規商品登録</a>
    

    <table class="table table-striped append" id="product_table">
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>値段</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($products as $product)
        <tr class='product_table' id="product_table">
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset('/storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->image }}" width="200" height="200"></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
            
            <td><button type="button" class="btn btn-primary" onclick=" location.href='{{ route('showDetail', $product->id) }}' ">詳細</button></td>
            <td>
                <form action="{{ route('delete') }}" method='post' onsubmit="return checkSubmit('削除してよろしいですか？')">
                    @csrf
                    <input type="hidden" name=product_id value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <table id="append"></table>
</div>
</div>
</div>


@endsection
</div>
