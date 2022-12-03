<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'tbl_blog';

    public function viewsDetail()
    {
        return $this->hasOne(Blog_View::class);
    }
}
