<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaApm extends Model
{
    use HasFactory;
    protected $table = "kriteria_apms";
    public $timestamps = false;
    protected $primaryKey = "id_kriteria";
    protected $fillable = [
        'nama_kriteria'
    ];
}
