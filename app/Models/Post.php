<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
   
    protected $table = 'posts'; //la mia tabella rispetta già gli standards di Eloquent, potrei anche non metterlo

    public function user(){    //relazione con user (1-N)

        return $this->belongsTo('App/Models/User'); //un post appartiene ad un solo utente
        
    }


    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes() {
        return $this->belongsToMany('App\Models\User', 'likes');
    }

}


?>