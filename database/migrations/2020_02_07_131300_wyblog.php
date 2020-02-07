<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Wyblog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBlog', function (Blueprint $table) {
            $table->bigIncrements('id')
                  ->comment('主键ID');
            $table->string('title')
                  ->default('')
                  ->comment('标题');
            $table->string('content')
                  ->default('')
                  ->comment('文章内容');
            $table->tinyInteger('status')
                  ->default(0)
                  ->comment('文章状态 0未发布 1已发布 2已删除');
            $table->timestamp('create_time')
                  // ->default(0)
                  ->comment('创建时间');
            $table->timestamp('update_time')
                  // ->default(0)
                  ->comment('修改时间');
            $table->string('author')
                  ->default('')
                  ->comment('作者');
            $table->primary('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblBlog');
    }
}
