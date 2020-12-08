<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaApm extends Model
{
    use HasFactory;
    protected $table = "area_apms";
    public $timestamps = false;
    protected $primaryKey = "id_area";
    protected $fillable = [
        'nama_area'
    ];
}
