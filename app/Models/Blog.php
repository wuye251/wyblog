<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
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
	protected $table = 'blogs';

	//指定主键
	protected $primaryKey = 'id';

	//软删除 Base.php中已引入
	use SoftDeletes;
	protected $dates = ['deleted_at'];
  	protected $fillable = [
   	 'title', 'summary', 'markdown', 'html', 'status', 'author', 'category_id',
  	];
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

	public function tag()
	{
		/* 将blog category_id字段 和 category表的id关联 */
		// return $this->belongsTo(Category::class, 'category_id');

		#远程一对多
		return $this->hasManyThrough(
			Tag::class,  #最终模型类  
			BlogTag::class, #中间模型类
			'blog_id',      #中建模型的外键名
			'id',			#最终模型的本地名
			'id',			#本地键名
			'tag_id'		#最终模型的外键名
		);
	}


	#一对多  删除而用
	public function BlogTag()
	{
		return $this->hasMany(BlogTag::class);
	}

}