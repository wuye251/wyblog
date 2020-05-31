<?php

namespace App\Models;


class Category extends Base
{
    /**
     * @param int  id    		主键
     * @param str  name  		分类名称
     * @param str  description 	简述
     * @param int  sort         排序
     */
    protected $table = 'categories';

    protected $primaryKey = 'id';
    	
    	protected $fillable = [
      'name', 'description'
      ];

    // 一对多 关联博客
    public function blogs()
    {
     return $this->hasMany(Blog::class);   
    }
}
