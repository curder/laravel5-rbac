<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeCloumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->char('real_name',10)->comment('用户真实姓名')->after('name');
            $table->tinyInteger('status')->default('1')->comment('用户状态 -1禁用 0删除 1正常')->after('email');
            $table->tinyInteger('gender')->default('1')->comment('用户性别 0不限 1男 2女')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('real_name');
            $table->dropColumn('status');
            $table->dropColumn('gender');
        });
    }
}
