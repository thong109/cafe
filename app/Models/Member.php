<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'login_id','password','authority_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'dtb_member';
}
