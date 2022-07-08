<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function sharePost(Request $request){

        $content = e($request->input('postContent'));   //la e serve per evitare l'sql injection. leggeva gli apostrofi come sql
        $image = $request->input('image');  
        $url = e($request->input('url'));  
        $sharedFrom = e($request->input('user'));  

        
        if($url == "null"){
            $url = null;
        }
        

        $id = Session::get('id');

        $res = DB::insert("INSERT INTO posts (Content, Image, CreationDate, UserId, urlNewsImage, sharedFrom) VALUES ('$content', '$image', NOW(), '$id', '$url', '$sharedFrom')");

        $success = '';
        $error = '';

        if($res === true)
        $success = 'Post shared correctly';
        else
        $error = 'error';


        $output[] = array(
            'success' => $success,
            'error' => $error
        );

        return $output;

    }

    public function newPost(Request $request){

        $content = e($request->input('postContent'));   //la e serve per evitare l'sql injection. leggeva gli apostrofi come sql
        $file = $request->file('imageSelector');
        $success = '';
        $error = '';

        $id = Session::get('id');
        $url = $request->input('urlImage');


        if($request->hasFile('imageSelector')){     //picture

            $allowedExt = array('jpg', 'jpeg', 'png');

    
    	    if(in_array($file->getClientOriginalExtension(), $allowedExt)){ //confronta estensione

         
                $fileNameNew = uniqid('',true).".".$file->getClientOriginalExtension();
                

                $success = 'Image loaded correctly';
            
            }else{
                $error = 'You cannot upload files of this type.';
            }


            $blobFile = addslashes(file_get_contents($file->getRealPath()));  //aggiunge \ prima di '

            DB::insert("INSERT INTO posts (Content, Image, CreationDate, UserId, urlNewsImage) VALUES ('$content', '$blobFile', NOW(), '$id', '$url')");

           

        }else{ //no picture

            DB::insert("INSERT INTO posts (Content, Image, CreationDate, UserId, urlNewsImage) VALUES ('$content', null, NOW(), '$id', '$url')");


        }

        $output[] = array(
            'success' => $success,
            'error' => $error
        );

        return $output;
        
    }

    public function deletePost(){

        $request = request();
        $post_id = $request['id_post'];
        DB::table('likes')->where('Post_id', $post_id)->delete();
        DB::table('comments')->where('id_post', $post_id)->delete();
        DB::table('posts')->where('Post_id', $post_id)->delete();

    }

    public function getPosts(){

        
        if(!Session::get('id')){
            return 0;
        }

        $request = request();
        $id = $request['id_user'];
        $userId = Session::get('id');

        if($id == -1){  //nella home
            
            $result = DB::select("SELECT  Content, Image, CreationDate, num_likes, num_comments, Username, posts.Post_id as Post_id, likes.User_id as Liked, users.Id, Colour, Profile_picture, urlNewsImage, idFollower, idFollowed, sharedFrom FROM (posts join users on (users.Id = posts.UserId) left join likes on (User_id = '$userId' and likes.Post_Id = posts.Post_id)) left join follows on (idFollower = '$userId' and idFollowed = Id) WHERE idFollower = '$userId' or Id = '$userId' ORDER BY CreationDate DESC");
            //mostra solo post delle persone seguite

        }else{  //nei profili

            $result = DB::select("SELECT  Content,Image, CreationDate, num_likes, num_comments, Username, posts.Post_id as Post_id, likes.User_id as Liked, users.Id, Colour, Profile_picture, urlNewsImage, sharedFrom FROM (posts join users on (users.Id = posts.UserId) left join likes on (User_id = '$userId' and likes.Post_Id = posts.Post_id)) WHERE users.Id = '$id'  ORDER BY CreationDate DESC");

        }

        if(sizeof($result)>0){
        for($i = 0; $i<sizeof($result); $i++){

            $owner = false;

            if($result[$i]->Id == $userId){
                $owner = true;
            }



            if($result[$i]->sharedFrom !== null){   // se è stato condiviso, l'immagine è già codificata
                $image = $result[$i]->Image;
            }else{
                $image = mb_convert_encoding(base64_encode($result[$i]->Image), 'UTF-8', 'UTF-8');

            }
            

            $output[] = array(

                'content' => $result[$i]->Content,
                'image' => $image,
                'creationdate' => $result[$i]->CreationDate,
                'num_likes' => $result[$i]->num_likes,
                'num_comments' => $result[$i]->num_comments,
                'username' => $result[$i]->Username,
                'postId' => $result[$i]->Post_id,
                'liked' => $result[$i]->Liked,
                'owner' => $owner,
                'colour' => $result[$i]->Colour,
                'urlNewsImage' => $result[$i]->urlNewsImage,
                'pro_pic' => mb_convert_encoding(base64_encode($result[$i]->Profile_picture), 'UTF-8', 'UTF-8'),
                'sharedFrom' => $result[$i]->sharedFrom
                
                );
        }
        }else{

            $output = array(

                'error' => 'no posts'

            );

        }

        return $output;


    }

    public function putLike(){

        $request = request();
        $postId = $request['id_post'];

        $userId = Session::get('id');

        $result = DB::select("SELECT * FROM likes WHERE Post_id = '$postId' AND User_id = '$userId'");

        if(sizeof($result)>0){ //already liked

            //dislike
            DB::table('likes')->where('Post_id', $postId)->where('User_id', $userId)->delete();
            $action = 'dislike';

        }else{
            //like
            DB::insert("INSERT INTO likes(User_id, Post_id) VALUES($userId,$postId)");
            $action = 'like';

        }

        $result = DB::select("SELECT num_likes FROM posts WHERE Post_id = $postId"); //get new number of likes

        if(sizeof($result)>0){

            $number = $result[0]->num_likes;
        }

        $output = array(

            'number' => $number,
            'action' => $action,
            'postId' => $postId
        );


        return $output;

    }

}

?>