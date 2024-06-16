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

function deleteItemCart($cart_id)
{
  global $conn;
  $conn->query("DELETE FROM cart WHERE id=$cart_id");
}

function getItem($product_id, $user_id)
{
  global $conn;
  return $conn->query("SELECT cart.*, products.name, products.price, products.image 
FROM cart
JOIN products ON cart.product_id = products.id
WHERE cart.user_id = $user_id AND cart.product_id = $product_id
")->fetch_array();
}

?>