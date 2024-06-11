<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bomba extends Model
{
    use HasFactory;

    protected $table = 'bombas';

    protected $fillable = [
        'localizacao',
        'id_combustivel'
    ];

    public function combustivel()
    {
        return $this->belongsTo(Combustivel::class, 'id_combustivel');
    }
}
