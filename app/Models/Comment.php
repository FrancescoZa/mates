<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{

    protected $table = 'comments'; //la mia tabella rispetta già gli standards di Eloquent, potrei anche non metterlo
    public $timestamps = false; //perchè Eloquent si aspetta le colonne created_at e updated_at, che nel mio database non esistono


    public function user() { //relazione (1-N)
        return $this->belongsTo("App\Models\User");
    }

    public function post() { //relazione (1-N)
        return $this->belongsTo("App\Models\Post");
    }

}

?>