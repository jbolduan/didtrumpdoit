<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    protected $fillable = ['name', 'fa_icon', 'color'];

    protected $table = 'statuses';

    protected $primaryKey = 'id';

    public function statement()
    {
        return $this->hasOne('App\Models\Statement');
    }
}
