<?php

namespace App\Models;

use Baum\Node;
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
     * 生成权限树
     */
    public static function permissionsTree()
    {
        return self::toTree(self::all(['id','parent_id','name','dispaly_name'])->toArray());
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
