<?php
    //REST api access through HTTP that's why header is need

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect(); //function connect in ../../config/Database.php

    // Instantiate blog post object
    //not POST request
    $post = new Post($db);

    // Get ID from URL using super global $_GET
    //ex. a_website.com?id=3
    //turnary of if isset ? ifTrue : ifFalse;
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get (a single) post
    $post->read_single();

    // Create array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name,
    );

    // Make JSON
    //print array
    print_r(json_encode($post_arr));
?>