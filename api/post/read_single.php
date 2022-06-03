<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);

    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $post->read_single();

    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $post_arr = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'body' => html_entity_decode($row['body']),
            'author' => $row['author'],
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name'],
            'created_at' => $row['created_at']
        );
    
        print_r(json_encode($post_arr));
    } else {
        print_r(json_encode(array('message' => 'No posts found')));
    }
