<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'number','number_infor'
    ];
    protected $primaryKey = 'id';
    protected $table = 'dtb_table';
    // public function getTableInfor(){
    //     return $this->hasOne(TableInfor::class,'id','table_id');
    // }
}
