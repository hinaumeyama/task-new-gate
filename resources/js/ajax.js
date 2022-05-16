$(function () {
    //検索ボタンクリックで処理が実行
    $('#search_button').on('click', function () {
        $("#product_table").empty(); //product_tableの要素を空にする

        var search_keyword = $('#search_keyword').val(); //#search_keywordのフォームに入力された値をsearch_keywordに代入

        var urls = [
            '/home' + search_keyword,
        ];
        //ここでサーバーに対しての通信を行う。情報の指定（ここではdataに格納）、送信先、データの型（Json）等を記述
        $.ajax({
            type: 'GET',
            url: urls,
            datatype: 'json', //データをJson形式で取得
            data: {
                keyword: search_keyword,
            }
    //     // 通信成功事の処理
        }).done(function (data) {
            let html = "";
            $.each(data, function (index, value) {
                let id = value.id;
                let product_name = value.product_name;
                let price = value.price;
                let stock = value.stock;
                let company_name = value.company_name;
                let img = value.image;

            //     viewテンプレート
                html= `
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
                <tr>
                    <td>${id}</td>
                    <td><img src="${img}" class="img-fluid" width="200" height="200"></td>
                    <td>${product_name}</td>
                    <td>${price}</td>
                    <td>${stock}</td>
                    <td>${company_name}</td>
                    <td><button type="button" class="btn btn-primary" onclick=" location.href='/product/${id}' ">詳細</button></td>
                    <form action="{{ route('delete', $product->id) }}" onsubmit="return checkDelete()">
                        <td><button type="submit" class="btn btn-primary">削除</button></td>
                    </form>
                </tr>
                `
            })
            $('.append').append(html);
        })
    })
});