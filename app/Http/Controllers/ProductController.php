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
        
        
        
        $path = null;
        // 画像がアップロードされていれば、storageに保存
        if ($request->hasFile('image')) {
            $image = $request->file('image');
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
            $path = explode('/', $path)[1];
        } else {
            $path = null;
        }

        //商品情報を更新
        $product = Product::find($inputs['id']);
        if (is_null($path )) {
            $product->fill([
                'company_id' => $inputs['company_id'],
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
            ]);
        }else {
            $product->fill([
                'company_id' => $inputs['company_id'],
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'image' => $path,
            ]);
        }
       
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

