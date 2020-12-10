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
    public function apm()
    {
        return $this->hasMany('App\Models\Apm', 'id_kriteria','id_kriteria');
    }
}
