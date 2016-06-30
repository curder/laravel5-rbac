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
}
