<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Local extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'locais';

    protected $fillable = [
        'nome_local',
        'cep',
        'cidade',
        'rua',
        'numero',
    ];

}
