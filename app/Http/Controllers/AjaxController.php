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
    public function exeAjaxSearch(Request $request) {
        
       
        //入力される値nameの定義
        $product_name = $request->product_name;
        $company_id = $request->company_id;

        $product_model = new Product;
        $products = $product_model->getProducts($product_name, $company_id);
        
        // $keyword = keyword::all();

            
    
        
        //  Product::with('Company')->where('product_name', 'LIKE', "%$search_keyword%")->get(); 
        
        // error_log(var_export($products, true), 3, "./debug.txt");

        return response()->json($products);

       
    }
}
