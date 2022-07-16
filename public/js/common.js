
function checkSubmit(message){
    return window.confirm(message);
}

$(function () {
    
    $('#ajax_search').on('click', function () {
        $("#product_table").empty();
        
       

        var search_keyword = $('#search_keyword').val(); 
       
        console.log(search_keyword);

        var urls = [
            '/task/public/home?' + search_keyword,
        ];
       

        $.ajax({
            type: 'GET',
            url: '/ajaxsearch?' + search_keyword,
            datatype: 'json', 
            data: {
                keyword: search_keyword,
            }
   
        }).done(function (data) {
           
            let html = "";
            $.each(data, function (index, value) {
                let id = value.id;
                let product_name = value.product_name;
                let price = value.price;
                let stock = value.stock;
                let company_name = value.company_name;
                let img = value.image;
               
                // console.log(urls);
            
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

            // $('#product_table').append(html);
        })
    })
});