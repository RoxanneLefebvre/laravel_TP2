<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;



    protected $fillable = [ //les champ dans la base de donner quon veux modifier, ne pas mettre les auto ecrement
        'title',
        'title_fr',
        'body',
        'body_fr',
        'user_id',
        'categories_id'
    ];

    public function blogHasUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function blogHasCategorie(){
        return $this->hasOne('App\Models\Categorie', 'id', 'categories_id');
    }
}
