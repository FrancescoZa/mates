<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FollowController extends Controller
{

    public function follow(){

        $request = request();

        $id_friend = $request['id_friend'];
        $idUser = Session::get('id');

        $res =  DB::select("SELECT idFollower FROM follows WHERE idFollower = $idUser AND idFollowed = $id_friend");

    
        if(sizeof($res)>0){ //i already follow this user

            //unfollow
            DB::table('follows')->where('idFollower', $idUser)->where('idFollowed', $id_friend)->delete();
            $action = 'unfollow';
        }else{  //i do not follow this user

            //follow
            DB::insert("INSERT INTO follows(idFollower, idFollowed) values($idUser, $id_friend)");
            $action = 'follow';

        }

        $res = DB::select("SELECT followers, following from users WHERE Id = '$id_friend'");


        $output[] = array(

            'action' => $action,
            'friend_id' => $id_friend,
            'following' => $res[0]->following,
            'followers' => $res[0]->followers
        );

        return $output;

    }

}

?>