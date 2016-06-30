<?php

namespace App\Http\Controllers\Admin;

use App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * 用户管理
     */
    public function index()
    {
        $user = new User;
        $data = $user->paginate(2);
        echo Route::currentRouteName();
        return view('admin.user.index',compact('data'));
    }

    /**
     * 新增用户
     * @param CreateUserRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(CreateUserRequest $request)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token','password_confirmation']);

            $input['password'] = Hash::make($request->input('password'));

            $res = User::create($input);
            if($res){
                return redirect(route('user.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }

        return view('admin.user.create');
    }

    /**
     * 管理员修改用户密码
     * @param EditUserRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EditUserRequest $request,User $user)
    {
        if($request->isMethod('post')){
            $input = $request->except(['_token','email','name','password_confirmation']);

            $input['password'] = Hash::make($request->password);

            $res = User::where('id',$user->id)->update($input);

            if($res){
                return redirect(route('user.index'));
            }else{
                return back()->with('errors','数据提交失败，请稍后重试！');
            }
        }
        return view('admin.user.edit',compact('user'));
    }


}
