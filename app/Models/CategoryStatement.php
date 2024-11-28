<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryStatement extends Model
{
    protected $fillable = ['statement_id', 'category_id'];

    protected $table = 'category_statement';

    protected $primaryKey = null;

    public $incrementing = false;

    public function statement()
    {
        return $this->hasMany('App\Models\Statement');
    }

    public function category()
    {
        return $this->hasMany('App\Models\Category');
    }
}
