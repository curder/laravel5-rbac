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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id = null)
    {
        if($parent_id){
            $data = Permission::whereParentId($parent_id)->paginate(10);
        }else{
            $data = Permission::whereParentId(null)->paginate(10);
        }
        return view('admin.permission.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = 0)
    {
        $permissionsTree = Permission::getNestedList('display_name','id','└') ; // 所有权限

        return view('admin.permission.create',compact('permissionsTree','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request,Permission $permission)
    {
        $input = $request->except(['_token']);
        if($input['parent_id'] == "") unset($input['parent_id']);
        $res = Permission::create($input);
        if($res){
            return redirect(route('admin.permission.index'));
        }else{
            return back()->with('errors','数据提交失败，请稍后重试！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::whereId($id)->first();

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPermissionRequest $request,$id)
    {

        $input = $request->except(['_token','_method']);

        $permission = Permission::whereId($id)->first();

        if($input['parent_id']){ // 放入子分类
            $res = $permission->makeChildOf($input['parent_id']);
        }else{ // 放入顶级分类
            unset($input['parent_id']);
            $res = $permission::where('id',$permission->id)->update($input);

            $permission->parent_id = null;
            if($res) $res = $permission->save();
        }

        if($res){
            return redirect(route('admin.permission.index'));
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
