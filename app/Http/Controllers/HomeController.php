<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProductRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    //----------------------------------------------------------------------
    
    /**
     * Show the application dashboard.
     * ホーム画面を表示
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showHome(Request $request) {
        $products = Product::with('company')->get();
        $companies = Company::all();


        return view('product.home', ['products' => $products, 'companies' => $companies, ]);        
    }

    //----------------------------------------------------------------------

    /**
     * 商品詳細画面を表示
     * @param int $id
     * 
     * @return view
     */
    public function showDetail($id) {
        $product = Product::with('company')->find($id);
        // dd($product);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect(route('home'));
        }

        return view('product.detail', ['product' => $product]);
    }

    //----------------------------------------------------------------------

    /**
     * 商品登録画面を表示
     *
     * @return view
     */
    public function showCreate() {
        $products = Company::all();
        return view('product.create', ['products' => $products]);
    }

    //----------------------------------------------------------------------

    /**
     * 編集画面を表示
     * @param int $id
     * 
     * @return view
     */
    public function showEdit($id) {
        $company_names = Company::all();
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect(route('edit'));
        }

        return view('product.edit', ['product' => $product, 'company_names' => $company_names]);
    }

    //----------------------------------------------------------------------

    //検索機能
    public function exeSearch(Request $request) {
        // dd($request);
        $companies = Company::all();

        //入力される値nameの定義
        $keyword = $request->input('keyword'); //商品名
        $company_id = $request->input('company_id'); //メーカー名

        $product_model = new Product;
        $products = $product_model->getProducts($keyword, $company_id);



        return view('product.home', [
            'companies' => $companies, 
            'products' => $products, 
            'company_id' => $company_id, 
            'keyword' => $keyword,

        ]);
    }

    //----------------------------------------------------------------------

}