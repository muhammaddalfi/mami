<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidents extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function basecamp()
    {
        return $this->belongsTo(Basecamps::class, 'basecamp_id');
    }

    public function mitra()
    {
        return $this->belongsTo(Perusahaans::class, 'mitra_id');
    }

    public function material()
    {
        return $this->belongsTo(Materials::class, 'material_id');
    }
}
