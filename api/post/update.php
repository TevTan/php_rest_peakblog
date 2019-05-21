<?php
    //REST api access through HTTP that's why header is need

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    // Set ID to update
    $post->id = $data->id;

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    // Update post
    if($post->update()) {
        echo json_encode(
            array('message' => 'Post Updated')
        );
    } 
    else{
        echo json_encode(
            array('message' => 'Post Note Update')
        );
    }
?>