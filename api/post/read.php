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

    // Blog post query
    $result = $post->read();
    //Get row count
    $num = $result->rowCount();

    // Check if any posts
    if($num > 0){
        // Post array
        $posts_arr = array(); //as JSON
        $posts_arr['data'] = array(); //actual data not JSON in array

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row); //extract into variable and use like of as $title instead of $row['title'] and $body instead of $row['body']
            
            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            ); //post item for each post

            // Push from $post_item into $posts_arr['data']
            array_push($posts_arr['data'], $post_item);
        }

        // Turn to JSON from php array & output
        echo json_encode($posts_arr);

    }else {
        // No Posts found
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }

?>