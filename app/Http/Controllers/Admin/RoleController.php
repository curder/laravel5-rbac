<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 用户组列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = new Role;
        $data = $role->paginate(2);

        return view('admin.role.index',compact('data'));
    }

    /**
     * 新增角色
     * @param RoleRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(RoleRequest $request)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token']);

            $res = Role::insert($input);
            if($res){
                return redirect(route('role.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }
        return view('admin.role.create',compact(''));
    }

    /**
     * 编辑角色
     * @param RoleRequest $request
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(RoleRequest $request,Role $role)
    {
        if($request->isMethod('post')){
            $input = $request->except('_token');
            $res = Role::where('id',$role->id)->update($input);
            if($res){
                return redirect(route('role.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }
        return view('admin.role.edit',compact('role'));
    }
}
