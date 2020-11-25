<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键');
            $table->boolean('oauth_client_id')->default(1)->comment('类型 1: github  2: QQ');
            $table->string('name')->default('')->comment('第三方昵称');
            $table->string('icon')->default('')->commetn('头像');
            $table->string('openId')->default('')->comment('第三方用户id');
            $table->string('access_token')->default('')->comment('token');
            $table->string('last_login_ip')->default('')->comment('最后一次登陆ip地址');
            $table->integer('login_times')->unsigned()->default(0)->comment('登陆次数');
            $table->string('mail')->default('')->comment('邮箱');
            $table->string('is_admin')->default(0)->comment('是否为管理员');

            $table->rememberToken();
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
        Schema::dropIfExists('oauth_users');
    }
}
