<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'category_name', 'category_slug'
    ];
    protected $primaryKey = 'id';
    protected $table = 'dtb_category';
}
