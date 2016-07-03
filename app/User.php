<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    /**
     * 查询新增列 配合getfieldasttribute方法使用
     * @var array
     */
    protected $appends = ['status_str'];

    /**
     * 处理用户状态显示
     * @return string
     */
    public function getstatusstrattribute(){
        switch($this->status){
            case  1;
                $status = 'success';
                $typestr = '正常';
                break;
            case 0 ;
                $status = 'error';
                $typestr = '禁用';
                break;
        }
        return sprintf('<label class="label label-%s">%s</label>',$status,$typestr);
    }

    // 定义用户组和角色的多对多关系
    public function roles(){
        //        return $this->belongstomany(role::class,'role_user','user_id','role_id');
        return $this->belongstomany(role::class);
    }
}
