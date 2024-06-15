<?php


function add_to_likes($product_id, $user_id)
{

  global $conn;

  $product_id = intval($product_id);
  $user_id = intval($user_id);

  $is_liked = $conn->query("SELECT * FROM likes WHERE product_id = $product_id AND user_id = $user_id");
  if($is_liked->num_rows > 0) {
    return; 
  }

  $query = "INSERT INTO likes (product_id, user_id, date_added) VALUES ({$product_id}, {$user_id}, NOW())";

  $conn->query($query);

  if ($conn->error) {
    return $conn->error;
  } else {
    return 1;
  }

}



?>