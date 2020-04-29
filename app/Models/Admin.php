<?php

namespace App\Models; // 注意要和自己定义的模型命名空间一致

use Illuminate\Foundation\Auth\User as Authenticatable; // 注意这里要和User模型一样

// 这里也要和User模型一样
class Admin extends Authenticatable 
{
  protected $fillable = [
    'name', 'password'
  ];

  
}
