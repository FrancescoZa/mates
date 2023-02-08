<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{


    public function newComment(){

        $request = request();
        $post_id = $request['id_post'];

        
        $comment = new Comment;
        $comment->content = $request['content'];
        $comment->creationDateComment = NOW();
        $comment->id_user = Session::get('id');
        $comment->id_post = $post_id;

        $comment->save();
        
        //select number of comments

        $result = DB::select("SELECT num_comments FROM posts WHERE Post_id = $post_id");

        $number = $result[0]->num_comments;

        $output = array(

            'number_comments' => $number,
            "postId" => $post_id
        );

        return $output;

    }

    public function getComments(){

        $request = request();

        $post_id = $request['id_post'];


        $result = DB::select("SELECT * FROM comments join users on (users.Id = id_user and id_post = $post_id)");
        if(sizeof($result)>0){

         for($i = 0; $i<sizeof($result); $i++){

            $output[] = array(
                'content' => $result[$i]->content,
                'creationdateComment' => $result[$i]->creationDateComment,
                'Username' => $result[$i]->Username,
                'id_post' => $result[$i]->id_post
            );

          }

        }else{

            $output = array(

                'message' => 'there are no comments',
                
        
            );
        }
        return $output;
        
    }

}


?>