<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $category->read_single();

    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $category_arr = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'created_at' => $row['created_at']
        );
    
        print_r(json_encode($category_arr));
    } else {
        print_r(json_encode(array('message' => 'No categories found')));
    }
