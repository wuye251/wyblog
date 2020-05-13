<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @param int  id    		主键
     * @param str  name  		分类名称
     * @param str  description 	简述
     * @param int  sort         排序
     */
    protected $table = 'categories';

    
}
