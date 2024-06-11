<?php

include "../Welcome-content/db.php";

function incrementItemCart($cart_id)
{
  global $conn;
  $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE id=$cart_id");
}

function decrementItemCart($cart_id)
{
  global $conn;
  $cart_product = $conn->query("SELECT * FROM cart WHERE id=$cart_id")->fetch_array(MYSQLI_ASSOC);
  if ($cart_product['quantity'] > 1) {
    $conn->query("UPDATE cart SET quantity = quantity - 1 WHERE id=$cart_id");
  }
}

function deleteItemCart($cart_id){
  global $conn;
  $conn->query("DELETE FROM cart WHERE id=$cart_id");
}

?>