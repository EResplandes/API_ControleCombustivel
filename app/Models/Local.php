<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'local';

    protected $fillable = [
        'local'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
