<?php

namespace App\Models;

use App\Role;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model
{
    //
    use EntrustUserTrait;


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

    // 定义用户组和角色的多对多关系
    public function roles(){
//        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
        return $this->belongsToMany(Role::class);
    }
}
