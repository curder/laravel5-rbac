<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
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
    public function index()
    {
        $permission = new Permission;
        $data = $permission->paginate(2);

        return view('admin.permission.index',compact('data'));
    }

    /**
     * 新增权限
     */
    public function create(PermissionRequest $request)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token']);

            $res = Permission::create($input);
            if($res){
                return redirect(route('permission.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }
        $permissions = ['顶级权限']; // 所有权限

        $permissions = array_merge($permissions , Permission::pluck('display_name','id')->toArray() );
        return view('admin.permission.create',compact('permissions'));
    }
}
