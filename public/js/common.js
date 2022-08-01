
function checkSubmit(message){
    return window.confirm(message);
}

$(function () {
    
    $('#ajax_search').on('click', function () {
        $("#product_table").empty();
        
       

        let product_name = $('#product_name').val(); 
        let company_id = $('#company_id').val(); 
       
        console.log(product_name);

        
       

        $.ajax({
            type: 'GET',
            url: '/ajaxsearch',
            datatype: 'json', 
            data: {
                product_name: product_name,
                company_id: company_id,
            }
   
        }).done(function (data) {
            console.log(data);

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
                        <td>${id}</td>
                        <td><img src="/storage/${img}" class="img-fluid" width="200" height="200"></td>
                        <td>${product_name}</td>
                        <td>${price}</td>
                        <td>${stock}</td>
                        <td>${company_name}</td>
                        <td><button type="button" class="btn btn-primary" onclick=" location.href='/product/${id}' ">詳細</button></td>
                        <td><button type="submit" class="btn btn-primary">削除</button></td>
                    </tr>
                `;
                $('#product_table').append(html);

            })
            

        })
    })
});