<?php

namespace App\Models;


/**
 * Class Blog
 *
 * @property int    $id          文章表主键
 * @property string $title       标题
 * @property string $content     内容
 * @property string $author      作者
 *
 */
class Blog extends Base
{
	//指定表名
	protected $table = 'tblblog';

	//指定主键
	protected $primaryKey = 'id';

	// //软删除
	// use SoftDeletes;

	const CREATE_AT = 'create_time';
	const UPDATE_AT = 'update_time';

	/**
     *  模型的默认属性值。
     *
     * @var array
     */
	// protected $attributes = [
        // 'deleted' => 0,
    // ];

	public function category()
	{
		/* 将blog category_id字段 和 category表的id关联 */
		return $this->belongsTo(Category::class, 'category_id');
	}

}