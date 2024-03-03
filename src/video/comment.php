<?php 
    $comments = array();

    require_once("../models/comment.php");
    require_once("../models/database.php");
    require_once("../services/video.service.php");
    require_once("../services/video.service.php");
    require_once("../common/date_converter.php");
    
    if(!isset($_GET["id"])) {
        print(json_encode($comments));
        die();
    }

    $db = new db_connection();
    $comments = null; 
    
    //try to connect to the database
    try {
        $video_service = new video_service($db);
        $video_id = $_GET["id"];
        $comments = $video_service->get_video_comments($video_id);
    }
    catch (mysqli_sql_exception $e) {
        die(change_location("error/400.php"));
    }

    $all_comments = array();

    foreach($comments as $comment) {
        array_push($all_comments, array(
            "author" => array(
                "id" => $comment->get_author()->get_id(),
                "first_name" => $comment->get_author()->get_first_name(),
                "last_name" => $comment->get_author()->get_last_name(),
                "profile_pic" => array(
                    "id" => $comment->get_author()->get_profile_pic()->get_id(),
                    "name" => $comment->get_author()->get_profile_pic()->get_name(),
                    "extension" => $comment->get_author()->get_profile_pic()->get_extension()
                )
            ),
            "text" => $comment->get_text(),
            "elapsed_time" => date_converter::get_elapsed_time($comment->get_created_at())
        ));
    }

    print(json_encode($all_comments));
    
?>