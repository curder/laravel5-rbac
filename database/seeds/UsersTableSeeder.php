<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'  => 1,
            'name'=> 'admin',
            'real_name'=> '管理员',
            'email'=> 'admin@admin.com',
            'status'=> 1,
            'gender'=> 1,
            'password'=> Hash::make('aaaaaa'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]); // 写入超级管理员
        DB::table('users')->insert([
            'id'  => 2,
            'name'=> 'test',
            'real_name'=> '测试帐号',
            'email'=> 'test@admin.com',
            'status'=> 1,
            'gender'=> 1,
            'password'=> Hash::make('aaaaaa'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]); // 写入测试用户
    }
}
