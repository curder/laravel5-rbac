<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User;
        $data = $user->paginate(20);

        echo Route::currentRouteName();
        return view('admin.user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateUserRequest $request)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token','password_confirmation']);

            $input['password'] = Hash::make($request->input('password'));

            $res = User::create($input);
            if($res){
                return redirect(route('admin.user.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }
    }

    /**
     * 将用户添加到组视图
     */
    public function getGroup(User $user)
    {
//        $permissionsTree = Permission::getNestedList('display_name','id','└') ; // 所有权限

        $allRole = Role::select(['id','name','display_name'])->get(); // 所有角色组
        $this_user_roles = $user->roles()->get(['id'])->toArray();

        $this_roles = []; // 当前用户所在用户组
        foreach($this_user_roles as $role){
            $this_roles[] = $role['id'];
        }

        return view('admin.user.group',compact('allRole','user','this_roles'));
    }

    /**
     * 将用户添加到组操作
     */
    public function postGroup(User $user)
    {
        $input = request()->except('_token');
        $user->roles()->sync( $input['id'] ); // 使用多对多关联模型将数据同步到 role_user中间表
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param EditUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(EditUserRequest $request,User $user)
    {
        $input = $request->except(['_token','_method','email','name','password_confirmation']);

        $input['password'] = Hash::make($request->password);

        $res = User::where('id',$user->id)->update($input);

        if($res){
            return redirect(route('admin.user.index'));
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
