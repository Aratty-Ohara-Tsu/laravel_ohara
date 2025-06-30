<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test; //eloquentで使うTestモデルのインポート。


//コントローラーの本体
class TestController extends Controller
{
    //viewsの中のフォルダの中のtest.blade.phpを参照するという意味
    public function index()
    {
        //DB処理　eloquent⇒モデル名:：メソッドで様々な処理が可能
        $values = Test::all(); //allメソッドでDBの内容全件取得

        //die +var_dump　その時点で処理を止めて、中身を表示する
        // dd($values);
        //コントローラーのindexメソッドが呼び出された時の処理
        return view('tests.test', compact('values'));
    }
}
