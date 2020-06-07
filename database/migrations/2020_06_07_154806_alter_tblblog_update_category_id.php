<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTblblogUpdateCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblblog', function (Blueprint $table) {
            //
            $table->dropColumn('deleted');
            $table->integer('category_id')->default(0)->comment('外键标签id')->after('author')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblblog', function (Blueprint $table) {
            //
        });
    }
}
