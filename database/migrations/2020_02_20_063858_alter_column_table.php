<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnTable extends Migration
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
            $table->dropColumn(['created_time', 'updated_time']);
            $table->timestamp('created_at')
                  ->default(DB::raw('CURRENT_TIMESTAMP'))
                  ->command('创建时间')
                  ->change();
            $table->timestamp('updated_at')
                  ->default(DB::raw('CURRENT_TIMESTAMP'))
                  ->command('修改时间')
                  ->change();
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
