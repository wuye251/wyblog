<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键id');
            $table->text('content')->comment('评论内容');
            $table->integer('article_id')->comment('评论文章id');
            $table->tinyInteger('status')->default(1)->comment('状态 0未发布 1发布');
            $table->tinyInteger('deleted')->default(0)->comment('状态 0未删除 1已删除');
            $table->timestamp('create_time')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('评论时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
