<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 查询新增列 配合getFieldASttribute方法使用
     * @var array
     */
    protected $appends = ['status_str'];

    /**
     * 处理用户状态显示
     * @return string
     */
    public function getStatusStrAttribute(){
        switch($this->status){
            case  1;
                $status = 'success';
                $typeStr = '正常';
                break;
            case 0 ;
                $status = 'error';
                $typeStr = '禁用';
                break;
        }
        return sprintf('<label class="label label-%s">%s</label>',$status,$typeStr);
    }
}
