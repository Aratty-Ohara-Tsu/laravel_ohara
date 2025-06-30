<?php

//use文。このファイル内で扱うクラスをインポートするための機能。
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

//テスト用ルーティング
// ルートには名前を付けることができる。名前を付けておくと、リンクを張るときに便利。
Route::get('tests/test', [TestController::class, 'index'])->name('test.index');


//ルーティングの定義　Route::通信方法(post or get)(アドレス,処理)
// ex. 「/」というURLにアクセスしたら return view('welcome')という処理を行う
// viewでビューファイルを表示。自動的にresources/viewsの中身を参照し、welcome.blade.phpのファイル名の実で指定できる。
Route::get('/', function () {
    return view('welcome');
});


//middleware(auth)⇒認証機能。ログインしているユーザーでなければdashboardにはアクセスできない。
//ログインしていないユーザーがアクセスするとログイン画面にリダイレクトがかかる。
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
