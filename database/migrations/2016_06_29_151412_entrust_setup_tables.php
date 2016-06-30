<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->comment('角色ID');
            $table->string('name',20)->unique()->comment('角色英文名称');
            $table->char('display_name',20)->nullable()->comment('角色中文名称');
            $table->string('description',180)->nullable()->comment('角色简要描述');
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->comment('用户id，关联users表');
            $table->integer('role_id')->unsigned()->comment('角色id，关联roles表');

            $table->foreign('user_id')->references('id')->on('')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id')->comment('权限id');
            $table->string('name')->unique()->comment('权限英文名称');
            $table->integer('parent_id')->nullable()->index()->comment('上级分类');
            $table->tinyInteger('is_menu')->default(0)->unsigned()->comment('是否为菜单');
            $table->smallInteger('sort')->default(0)->unsigned()->comment('排序');
            $table->string('display_name')->default('')->comment('权限中文名称');
            $table->string('description')->default('')->comment('权限相关描述');
            $table->integer('left')->nullable()->index()->comment('左索引');
            $table->integer('right')->nullable()->index()->comment('右索引');
            $table->integer('depth')->nullable()->comment('深度值');
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned()->comment('权限id');
            $table->integer('role_id')->unsigned()->comment('角色id');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
