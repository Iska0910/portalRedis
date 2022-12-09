<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tbl_category';

    public function getParent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

}
