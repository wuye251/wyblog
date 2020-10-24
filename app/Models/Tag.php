<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{

	protected $fillable = [
   	 'name', 'keywords', 'description',
  	];


    public function blogs()
    {
    	return $this->belongsToMany(Blog::class, 'blog_tags', 'tag_id', 'blog_id');
    }


}
