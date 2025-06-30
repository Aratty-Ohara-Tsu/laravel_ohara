<?php
//use文。Migration,Blueprint,Schemaのクラスを使用するためにインポート。
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //up method DBへの変更を記述
    public function up(): void
    {
        //Eloquent　Schema::メソッドでDBに対する操作が可能
        //Schema::create('テーブル名',カラム)でテーブルを作成。
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->String('text'); //追記
            $table->timestamps(); //created_at (作成日時) とupdate_at(更新日時)を自動作成
        });
    }

    /**
     * Reverse the migrations.
     */
    //down method　ロールバック用の処理を記述。
    public function down(): void
    {
        //testsテーブルが存在したら削除する
        Schema::dropIfExists('tests');
    }
};
