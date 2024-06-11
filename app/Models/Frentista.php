<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frentista extends Model
{
    use HasFactory;

    protected $table = 'frentistas';

    protected $fillable = [
        'nome',
        'cpf',
        'status'
    ];
}
