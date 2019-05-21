<?php
    //REST api access through HTTP that's why header is need

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect(); //function connect in ../../config/Database.php

    // Instantiate category object
    //not POST request
    $category = new Category($db);

    // Category read query
    $result = $category->read();
    //Get row count
    $num = $result->rowCount();

    // Check if any categories
    if($num > 0){
        // (Cat)egory array
        $cats_arr = array(); //as JSON
        $cats_arr['data'] = array(); //actual data not JSON in array

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row); //extract into variable and use like of as $title instead of $row['title'] and $body instead of $row['body']
            
            $cat_item = array(
                'id' => $id,
                'name' => $name,
            ); //cat item for each cat

            // Push from $post_item into $posts_arr['data']
            array_push($cats_arr['data'], $cat_item);
        }

        // Turn to JSON from php array & output
        echo json_encode($cats_arr);

    }else {
        // No Categories found
        echo json_encode(
            array('message' => 'No Categories Found')
        );
    }

?>