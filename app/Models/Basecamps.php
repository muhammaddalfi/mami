<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basecamps extends Model
{
    use HasFactory;

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaans::class, 'mitra_id');
    }

}
