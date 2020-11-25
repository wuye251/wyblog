<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id')
                  ->comment('主键ID');
            $table->string('title')
                  ->default('')
                  ->comment('标题');
            $table->text('summary')
                  ->comment('摘要');
            $table->text('markdown')
                  ->comment('markdown文章内容');
            $table->text('html')
                  ->comment('html文章内容');  
            $table->tinyInteger('status')
                  ->default(0)
                  ->comment('文章状态 0未发布 1已发布');
            $table->string('author')
                  ->default('')
                  ->comment('作者');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
