<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;
    protected $table = 'parameter';
    protected $fillable = ['id_kriteria', 'nama', 'bobot'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
