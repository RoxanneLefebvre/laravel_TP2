<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categorie extends Model
{
    use HasFactory;

    static public function selectCategorie(){
        $lang=session()->get('localeDB');

        $query = Categorie::select('id',
        DB::raw("(case when categorie$lang is null then categorie else categorie$lang end) as categorie")
        )
        ->orderby('categorie')
        ->get();
        return $query;
    }

    //SELECT id, (case when categorie_fr is null then category else categorie_fr end) as categorie from categorie
}
