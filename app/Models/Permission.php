<?php

namespace App\Models;

use Baum\Node;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

// 权限无限级分类模型
class Permission extends Node
{
    protected $table = 'permissions';
    // 'parent_id' column name
    protected $parentColumn = 'parent_id';

    // 'lft' column name
    protected $leftColumn = 'left';

    // 'rgt' column name
    protected $rightColumn = 'right';

    // 'depth' column name
    protected $depthColumn = 'depth';

    //批量赋值白名单
    protected $fillable = [
        'id',
        'parent_id',
        'left',
        'right',
        'depth',
        'name',
        'display_name',
        'description',
        'is_menu',
        'sort',
    ];

    /**
     * 生成权限树 TODO缓存起来
     */
    public static function permissionsTree()
    {
        return self::toTree(self::all(['id','parent_id','name','dispaly_name'])->toArray());
    }

    /**
     * 获取菜单方法
     */
    protected function getMenu(){
        // $menus  =   session('ADMIN_MENU_LIST');

        $curr_user = request()->user(); // 当前登录用户

        $currRouteName = Route::currentRouteName(); //当前路由别名
        $path = URL::getRequest()->path();

        if(empty($menus)){
            // 获取主菜单
            $menus['main']  =   Self::whereNull('parent_id')->where('is_menu',1)->orderBy('sort','asc')->get(['id','name','display_name'])->toArray();
            $menus['child'] =   array(); //设置子节点
            foreach ($menus['main'] as $key => $item) {
                // 判断主菜单权限
                if ( !IS_ROOT && !$curr_user->can($item['name']) ) {
                    unset($menus['main'][$key]);
                    continue;//继续循环
                }

                if($path  == strtolower($item['name'])){ // 高亮主菜单
                    $menus['main'][$key]['class']='active';
                }
            }

            // 查找当前子菜单
            // \DB::connection()->enableQueryLog();
            $pid = Permission::whereNotNull('parent_id')
                ->where('name',$currRouteName)
                ->first(['parent_id']);
            // print_r(\DB::getQueryLog());

            if(isset($pid->parent_id)){
                // 查找当前主菜单
                $nav =  Permission::whereId($pid->parent_id)->first();

                if($nav->parent_id){
                    $nav    =   Permission::whereId($nav->parent_id)->first();
                }

                foreach ($menus['main'] as $key => $item) {
                    // 获取当前顶部主菜单的子菜单项
                    if($item['id'] == $nav->id){
                        $menus['main'][$key]['class']='active';
                        //生成child树
                        $groups = Permission::where('group','!=',0)->where('parent_id',$item['id'])->distinct()->pluck('group')->toArray(); // 获取二级分组菜单

                        //获取二级分类的合法url
                        $second_urls = Permission::whereParentId($item['id'])->pluck('name','id'); // 获取二级菜单数组

                        if(!IS_ROOT){
                            // 检测菜单权限
                            $to_check_urls = array();
                            foreach ($second_urls as $key=>$to_check_url) {
                                $rule = $to_check_url;
                                if($curr_user->can($rule))
                                    $to_check_urls[] = $to_check_url;
                            }

                        } else {
                            $to_check_urls =  $second_urls;
                        }

                        // 按照分组生成子菜单树
                        if(is_array($groups)){
                            foreach ($groups as $g) {
                                $map = array('group'=>$g);
                                $premission = Permission::where('group',$g);
                                if(isset($to_check_urls)){
                                    if(empty($to_check_urls)){
                                        // 没有任何权限
                                        continue;
                                    }else{
                                        $premission->whereIn('name',$to_check_urls);
                                    }
                                }
                                $map['pid']     =   $item['id'];

                                $menuList = $premission->where('parent_id',$item['id'])->orderBy('sort','asc')->get(['id','parent_id','name','display_name','description'])->toArray();

                                $menus['child'][$g] = self::toTree($menuList);
                            }
                        }
                    }
                }
            }
            // session('ADMIN_MENU_LIST',$menus);
        }
//        dd($menus);
        return $menus;
    }


    /**
     * 把返回的数据集转换成Tree
     * @param null $list 要转换的数据集
     * @param string $pk 主键
     * @param string $pid parent标记字段
     * @param string $child 子级元素
     * @return array
     */
    public static function toTree($list=null, $pk='id',$pid = 'parent_id',$child = '_child'){
        // 创建Tree
        $tree = [];
        if(null === $list) {
            // 默认直接取查询返回的结果集合
            return $tree;
        }

        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();

            foreach ($list as $key => $data) {
                $_key = is_object($data)?$data->$pk:$data[$pk];
                $refer[$_key] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = is_object($data)?$data->$pid:$data[$pid];
                $is_exist_pid = false;
                foreach($refer as $k=>$v){
                    if($parentId==$k){
                        $is_exist_pid = true;
                        break;
                    }
                }
                if ($is_exist_pid) {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                } else {
                    $tree[] =& $list[$key];
                }
            }
        }
        return $tree;
    }

}
