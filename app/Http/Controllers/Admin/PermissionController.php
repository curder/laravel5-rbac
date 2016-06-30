<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * 权限列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($parent_id = null)
    {
        $data = Permission::whereParentId($parent_id)->paginate(10);

        return view('admin.permission.index',compact('data'));
    }

    /**
     * 新增权限
     */
    public function create(PermissionRequest $request,Permission $permission)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token']);
            if($input['parent_id'] == 0) unset($input['parent_id']);
            $res = Permission::create($input);
            if($res){
                return redirect(route('permission.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }

        $permissions = Permission::getNestedList('display_name','id','- ') ; // 所有权限

        return view('admin.permission.create',compact('permissions','permission'));
    }

    public function edit(Permission $permission)
    {
        $permissionsTree = Permission::getNestedList('display_name','id','- '); // 获取所有节点树

        $parentId = $permission->getSiblings(['id'])->toArray(); // 当前分类的父类的所有子类
        print_r($parentId);

        return view('admin.permission.edit',compact('permission','permissionsTree'));
    }

}
