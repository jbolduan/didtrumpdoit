<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    /** The attributes that are mass assignable */
    protected $fillable = ['name', 'fa_icon'];

    protected $table = 'categories';

    protected $primaryKey = 'id';
}
