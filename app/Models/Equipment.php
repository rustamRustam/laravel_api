<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id_type','serial_number', 'desc'];

    public function equipmentType()
    {
        return $this->hasOne(EquipmentType::class,'id','id_type');
    }
}
