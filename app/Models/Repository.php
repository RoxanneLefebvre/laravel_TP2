<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'user_id',
        'title',
        'title_fr',
        
    ];

    public function repoHasUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
