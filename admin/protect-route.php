<?php

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)){
  
  header('Location: login.php');

}


?>