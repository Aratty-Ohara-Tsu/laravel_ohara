<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //tableメソッドはカラムの追加を行うメソッド。
        //nameカラムの後にtitleカラムを追加
        Schema::table('contact_forms', function (Blueprint $table) {
            //
            $table->string('title', 50)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            //titleカラムを削除する処理
            $table->dropColumn('title');
        });
    }
};
