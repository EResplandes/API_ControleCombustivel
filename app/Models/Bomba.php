<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bomba extends Model
{
    use HasFactory;

    protected $fillable = [
        'local',
        'numero_bomba'
    ];

    public function abastecimentos()
    {
        return $this->hasMany(Abastecimento::class, 'uid_bomba', 'id');
    }


}
