<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    public function addTagIds(int $blog_id, array $tag_ids)
    {
        // 组合批量插入的数据
        $data = array_map(function ($tag) use ($blog_id) {
            return [
                'blog_id' => $blog_id,
                'tag_id'  => $tag,
            ];
        }, $tag_ids);

        return $this->insert($data);
    }
}
