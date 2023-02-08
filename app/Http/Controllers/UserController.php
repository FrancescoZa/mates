<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{


   public function logout(){

    Session::flush();
    return redirect('login');

   }

   public function login_user(){

    $success = '';
    $invalid_credential_error = '';

    $request = request();
    $username = $request['username'];
    $password = md5($request['password']);
    $result = DB::select("SELECT Id FROM users WHERE Username = '$username' AND Password = '$password'");

    
    if(sizeof($result)){

        $success = 'success';
        Session::put('id', $result[0]->Id);

    }else{

        $invalid_credential_error = 'Invalid Credentials';

    }

    $output = array(

        'success' => $success,
        'invalid_credential_error' => $invalid_credential_error

    );
    
    return $output;

   }

   public function register_user(){

    $success = '';
    $error = '';

    $request = request();
    $username = $request['username'];

    $usersSameName = DB::select("SELECT * FROM users WHERE Username = '$username'");

    if(sizeof($usersSameName)>0){

        $error = "This username already exists.";

    }else{
    
        $colours = array('#FFCCBC', '#FFE57F', '#CFD8DC', '#C8E6C9', '#D1C4E9', '#EF9A9A', '#C5CAE9', '#D7CCC8', '#FFE0B2', '#F0F4C3');
        $colour = $colours[array_rand($colours)];

        $user = new User;
        $user->Username = $request['username'];
        $user->Password = md5($request['password']);
        $user->Colour = $colour;

        $user->save();

        $success = 'User created successfully';

    }
    

    $output = array(

        'success' => $success,
        'error' => $error

    );

    return $output;

   }

   public function searchFriend(){


    $request = request();
    $name = $request['friend'];
    if($name == "-1")   $name = '';
    $current_id = Session::get('id');

    //$friends = DB::select("SELECT Username, Profile_picture, Id, Colour FROM users WHERE Username LIKE '$name%' AND Id <> '$current_id' LIMIT 10");
    $friends = DB::select("SELECT Username, Profile_picture, Id, Colour, idFollower, idFollowed FROM users left join follows on (idFollower = '$current_id' and idFollowed = Id) WHERE Username LIKE '$name%' AND Id <> '$current_id' ORDER BY rand() LIMIT 10");

    if(sizeof($friends)>0){
        for($i = 0; $i<sizeof($friends); $i++){

        

        $output[] = array(
            'username' => $friends[$i]->Username,
            'proPic' =>  base64_encode($friends[$i]->Profile_picture),
            'id' => $friends[$i]->Id,
            'colour' => $friends[$i]->Colour,
            'followed' => $friends[$i]->idFollowed,
            'follower' => $friends[$i]->idFollower,
            
            );
        
        }
    }else{

        $output = array(

            'error' => 'no friends'
    
        );
    }

    return $output;

   }


   public function getUserInfo(){

    if(!Session::get('id')){
        return 0;
    }

    $request = request();
    $id = $request['user_id'];
    $idSessione = Session::get('id');

    $info = DB::select("SELECT Username, Profile_picture, Bio, Colour,Id,followers, following, COUNT(*) as n_posts FROM users join posts on (Id = posts.UserId)  WHERE Id = '$id'");
    $followInfo = DB::select("SELECT idFollower, idFollowed from follows where idFollower = '$idSessione' and idFollowed = '$id'");

    if(sizeof($followInfo)>0){
        $follow = true;
    }else{
        $follow = false;
    }

    $output = array(
            
        'username' => $info[0]->Username,
        'colour' => $info[0]->Colour,
        'bio' => $info[0]->Bio,
        'pro_pic' => base64_encode($info[0]->Profile_picture),
        'n_posts' => $info[0]->n_posts,
        'follow' => $follow,
        'follower' => $info[0]->followers,
        'following' => $info[0]->following
    );

    return $output;

   }

   public function saveImp(Request $request){

        $bio = e($request->input('bioContent'));   //la e serve per evitare l'sql injection. leggeva gli apostrofi come sql
        $file = $request->file('image');

        $id = Session::get('id');

        
        if($request->hasFile('image')){     //picture

            $allowedExt = array('jpg', 'jpeg', 'png');

    
    	    if(in_array($file->getClientOriginalExtension(), $allowedExt)){

         
                $fileNameNew = uniqid('',true).".".$file->getClientOriginalExtension();
                

                $success = 'Image loaded correctly';
            
            }else{
                $error = 'You cannot upload files of this type.';
            }


            $blobFile = addslashes(file_get_contents($file->getRealPath()));

            DB::update("UPDATE users SET Bio = '$bio', Profile_picture = '$blobFile' WHERE Id = '$id'");

            

        }else{ //no picture

            DB::update("UPDATE users SET Bio = '$bio' WHERE Id = '$id'");

        }


        

        $output = array(
            
            'success' => 'sucess'
        
        );

        return $output;

   }

  

}
