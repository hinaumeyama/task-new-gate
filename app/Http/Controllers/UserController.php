<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    // -----------------------------------------------

    /**
     * ユーザー登録画面を表示する処理
     * 
     * @return view
     */
    public function showSignup_form() {
        return view('user.signup_form');
    }

    // -----------------------------------------------

    // ユーザー登録をする処理
    public function exeStore(UserRegisterRequest $request) {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        \Session::flash('success_msg', '登録完了しました!');
        return redirect('/');
    }

}