<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'hour',
        'duration',
        'user_id',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Etat(){
        return $this->belongsTo(Etat::class);
    }
}
