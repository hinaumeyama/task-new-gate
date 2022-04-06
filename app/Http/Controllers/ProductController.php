<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProductRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller {
    public function exeStore(ProductRegisterRequest $request) {
        // 商品のデータを受け取る
        $inputs = $request->all();
        // dd($inputs);
        
        $image = $request->file('image');
    
        $path = null;
        // 画像がアップロードされていれば、storageに保存
        if ($request->hasFile('image')) {
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }
        // dd($path);
        \DB::beginTransaction();
        try {
            // 商品を登録
            Product::create([
                'company_id' => $inputs['company_id'], 
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'image' => $path[1],
                // 'image' => $path['img_path'],


            ]);
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            dd($e);
            abort(500);
        }

        \Session::flash('err_msg', '商品を登録しました。');
        return redirect(route('home'));
    }

    //---------------------------------------------------------

    /**
     * 削除処理
     */
    public function exeDelete(Request $request) {
        $id = $request->product_id;

        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect('home');
        }
        
        \DB::beginTransaction();
        try {
            Product::destroy($id);
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '削除しました');
        return redirect('home');
    }

    //---------------------------------------------------------

    /**
     * 商品情報更新処理
     * 
     * @return view
     */
    public function exeUpdate(ProductRegisterRequest $request) {
        // 商品のデータを受け取る
        $inputs = $request->all();

        $image = $request->file('image');

        // 画像がアップロードされていれば、storageに保存
        if ($request->hasFile('image')) {
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        } else {
            $path = null;
        }

        //商品情報を更新
        $product = Product::find($inputs['id']);
        $product->fill([
            'company_id' => $inputs['company_id'],
            'product_name' => $inputs['product_name'],
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'image' => $path[1],
        ]);
        $product->save();

        DB::beginTransaction();
        try {
            // 商品を登録
            $product = Product::find($inputs['id']);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', '商品を登録しました。');
        return redirect(route('home'));
    }
}

// <!-- <?php

// namespace App\Http\Controllers;

// use App\Models\Product;
// use Auth;
// use Illuminate\Http\Request;

// class ProductController extends Controller


// {
//     public function index()
//     {
//         return view('products/index');
//     }

//     public function exeStore(Request $request)
    
    
//     {
//         $newProduct = new Product;
//         $newProduct->product_name = $request->product_name;
//         $newProduct->description = $request->description;
//         $newProduct->price = $request->price;
//         $newProduct->category_id = $request->category_id;
//         $newProduct->product_status_id = $request->product_status_id;
//         $newProduct->sale_status_id = $request->sale_status_id;
//         $newProduct->user_id = Auth::user()->id;
//         $newProduct->save();

        

//         return view('welcome');
//     }
// } -->
