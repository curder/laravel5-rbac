<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\EditPermissionRequest;
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
     * @param CreatePermissionRequest $request
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(CreatePermissionRequest $request,Permission $permission)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token']);
            if($input['parent_id'] == "") unset($input['parent_id']);
            $res = Permission::create($input);
            if($res){
                return redirect(route('permission.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }

        $permissions = Permission::getNestedList('display_name','id','└') ; // 所有权限

        return view('admin.permission.create',compact('permissions','permission'));
    }

    /**
     * 编辑权限
     * @param EditPermissionRequest $request
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EditPermissionRequest $request,Permission $permission)
    {
        if($request->isMethod('post')){ // 编辑操作
            $input = $request->except('_token');

            if($input['parent_id']){ // 放入子分类
                $res = $permission->makeChildOf($input['parent_id']);
            }else{ // 放入顶级分类
                unset($input['parent_id']);
                $res = $permission::where('id',$permission->id)->update($input);

                $permission->parent_id = null;
                if($res) $res = $permission->save();
            }

            if($res){
                return redirect(route('permission.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }

        $permissionsTree = Permission::getNestedList('display_name','id','└'); // 获取所有节点树

        if(!is_null($permission->parent_id)){ // 如果不是顶级分类
            $disabledIds = $permission->getSiblingsAndSelf(['id'])->toArray(); // 当前分类的父类的所有子类,禁用
            $disabledIdsArr = array_flatten($disabledIds);
        }else{
            $pid = $permission->id;
            $disabledIds = $permission->getDescendants(['id'])->toArray();
            array_unshift( $disabledIds ,['id'=>$pid] );
            $disabledIdsArr = array_flatten($disabledIds);
        }

        return view('admin.permission.edit',compact('permission','permissionsTree','disabledIdsArr'));
    }

}
