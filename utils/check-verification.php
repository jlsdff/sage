<?php

function checkVerification($user_id)
{
  global $conn;
  $res = $conn->query("SELECT * FROM users WHERE id = $user_id");
  $user = $res->fetch_array();

  $is_verified = $user['is_verified'];

  if ($is_verified == 0) {
    header('Location: /sage/account/verify-email.php');
  }

}


?>