<?php
    //REST api access through HTTP that's why header is need

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Header: Access-Control-Allow-Header,Content-Type,
    Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    //Authorization is not use here, but just include for education
    //X-Requested-With help with cross-site scripting attacks

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect(); //function connect in ../../config/Database.php

    // Instantiate blog post object
    //not POST request
    $post = new Post($db);

    // Get raw posted data
    //get whatever submitted
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to delete
    $post->id = $data->id;

    // Delete post
    if($post->delete()) {
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    } 
    else{
        echo json_encode(
            array('message' => 'Post Note Delete')
        );
    }
?>