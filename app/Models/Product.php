<?php

namespace App\Models;

//3/25
// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    //3/25
    // use HasFactory;

    protected $table = 'products';


    public function getProducts($keyword, $company_id) {
        //queryビルダ
        $query = Product::query();

        //キーワード検索機能
        if (!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        //プルダウン検索機能
        if (isset($company_id)) {
            $query->where('company_id', $company_id);
        }
        return $query->get();
    }


    //可変項目
    protected $fillable = [
        'product_name',
        'company_id',
        'price',
        'stock',
        'comment',
        'image',

    ];

    // Companiesテーブルと関連付ける
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
}