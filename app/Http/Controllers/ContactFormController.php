<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactForm; //storeメソッドで使用するモデルのインポート
use App\Services\CheckFormService; // 自作のフォームチェック用の
use App\Http\Requests\StoreContactRequest; //自作リクエストのインポート

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DBから情報を取得 モデル名::select(カラム名)->get()でDBから指定したカラムをすべて取得
        $contacts = ContactForm::select('id', 'name', 'title', 'gender', 'created_at')->get();
        // contactsフォルダ内のindex.blade.phpを返す
        // viewメソッドの第二引数で変数を指定するとview側に変数を渡すことができる
        // 変数を渡すときにはcompact()でまとめて渡すことができる
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //　contactsフォルダ内のcreate.blade.phpを返す
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        //フォームから送られてきたデータの確認
        // dd($request);
        //DBに以下の情報をまとめて登録する処理
        ContactForm::create([
            'name' => $request->name,
            'title' => $request->title,
            'email' => $request->email,
            'url' => $request->url,
            'gender' => $request->gender,
            'age' => $request->age,
            'contact' => $request->contact,
        ]);
        // indexページにリダイレクト
        return to_route('contacts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //find　⇒　1件データを取得。データが存在しない場合エラー
        //findOrFail ⇒　1件データを取得。データが存在しない場合は404
        $contact = ContactForm::findOrFail($id);

        //性別の表記処理
        // if ($contact->gender === 0) {
        //     $gender = '男性';
        // } else {
        //     $gender = '女性';
        // }
        $gender = CheckFormService::checkGender($contact);

        return view("contacts.show", compact('contact', 'gender'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $contact = ContactForm::findOrFail($id);

        // if ($contact->gender === 0) {
        //     $gender = '男性';
        // } else {
        //     $gender = '女性';
        // }
        $gender = CheckFormService::checkGender($contact);

        return view("contacts.edit", compact('contact', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //現在の情報をＤＢから取得
        $before_contact = ContactForm::findOrFail($id);
        //　フォームで送信されたデータ($request)で現在の情報を上書き
        // 現在の名前にフォームで送信された名前を代入
        $before_contact->name = $request->name;
        $before_contact->title = $request->title;
        $before_contact->email = $request->email;
        $before_contact->url = $request->url;
        $before_contact->gender = $request->gender;
        $before_contact->age = $request->age;
        $before_contact->contact = $request->contact;
        $before_contact->save();

        return to_route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $contact = ContactForm::findOrFail($id);
        $contact->delete();

        return to_route('contacts.index');
    }
}
