<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableInfor extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name','status','reservation_date','order_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'dtb_infor_table';
    public function getStatus(){
        return $this->BelongsTo(TableStatus::class,'status','id');
    }
}
