<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
   
    protected $table = 'users'; //la mia tabella rispetta già gli standards di Eloquent, potrei anche non metterlo
    public $timestamps = false; //perchè Eloquent si aspetta le colonne created_at e updated_at, che nel mio database non esistono

    public function posts(){    //relazione con i post (1-N)

        return $this->hasMany('App/Models/Post');   //un utente può creare più post

    }

    public function likedPosts() {  //relazione (N-N)
        return $this->belongsToMany('App\Models\Post', 'likes');
    }

    public function comments() {    //relazione con i commenti (1-N)
        return $this->hasMany('App\Models\Comment');
    }

}


?>