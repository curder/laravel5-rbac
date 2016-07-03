<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    // 定义用户组和角色的多对多关系
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }

    /**
     * 是否是超级管理员,超级管理员不受权限控制
     */
    protected static function isAdministrator($uid = null){

        $uid = is_null($uid) ? request()->user()->getAuthIdentifier() : $uid; // 当前登录者id
        return $uid && ($uid === 1);
    }
}
