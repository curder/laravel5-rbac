<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\PermissionsRequest;
use App\Models\Permission;
use App\Role;
use Illuminate\Http\Request;
use Psy\Util\Json;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = new Role;
        $data = $role->paginate(20);

        return view('admin.role.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $onload[]    = sprintf("admin.highlight_subnav('%s')",route('admin.role.index')); // 默认左侧菜单高亮函数
        return view('admin.role.create',compact('onload'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token']);

            $res = Role::insert($input);
            if($res){
                return redirect(route('admin.role.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }
    }

    /**
     * Display the specified resource.
     * 查看角色组拥有的权限
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::permissionsTree(); // 获取所有存在的权限

        // 通过多对多获取当前用户组所拥有权限
        $this_role_permissions = $role->permissions()->get(['id'])->toArray();

        $thisPermissionArray = []; // 当前用户所有权限集合
        foreach($this_role_permissions as $permission){
            $thisPermissionArray[] = $permission['id'];
        }

        $thisPermissionArray = Json::encode($thisPermissionArray);

        $onload[]    = sprintf("admin.highlight_subnav('%s')",route('admin.role.index')); // 默认左侧菜单高亮函数
        return view('admin.role.show',compact('role','permissions','thisPermissionArray','onload'));
    }

    /**
     * 编辑用户组权限操作
     */
    public function editPersissionToRole(Request $request ,Role $role)
    {
        $input = $request->except('_token');

        $res = $role->perms()->sync($input['permission_id']);

        if($res){
            return redirect(route('admin.role.show',$role->id));
        }else{
            return back()->with('errors','数据提交失败，请稍后重试！');
        }

    }
    /**
     * Show the form for editing the specified resource.
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $onload[]    = sprintf("admin.highlight_subnav('%s')",route('admin.role.index')); // 默认左侧菜单高亮函数
        return view('admin.role.edit',compact('role','onload'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request,$id)
    {
        $input = $request->except(['_token','_method']);
        $res = Role::where('id',$id)->update($input);
        if($res){
            return redirect(route('admin.role.index'));
        }else{
            return back()->with('errors','数据提交失败，请稍后重试！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
