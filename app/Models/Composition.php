<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    protected $table = 'tbl_compositions';

    public function viewsDetail()
    {
        return $this->hasOne(Composition_View::class);
    }
}
