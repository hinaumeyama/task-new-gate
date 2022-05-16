<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //検索機能の非同期処理
    public function exeAjaxSearch($search_keyword) {
        
        //入力される値nameの定義
        $keyword = Product::with('Company')->where('product_name', 'LIKE', "%$search_keyword%")->get(); //商品名
        // $company_name = $request->input('company_name'); //メーカー名

        error_log(var_export($keyword, true), 3, "./debug.txt");

        return response()->json($keyword);

        // $product_name = Product::where('product_name', 'LIKE', "%{$keyword}%");
    }
}