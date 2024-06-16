<?php 

include '../Welcome-content/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


function generateCode($user_id){
  $code = rand(100000, 999999);
  return $code;
}

function persistCode($user_id, $code){

  global $conn;

  // CHECK FOR EXISTING CODE
  $check_code = $conn->query("SELECT * FROM verification_codes WHERE user_id = $user_id");
  if($check_code->num_rows == 0){
    $query = "INSERT INTO verification_codes (user_id, code) VALUES ('$user_id', '$code')";
  } else {
    $query = "UPDATE verification_codes SET code = '$code' WHERE user_id = '$user_id'";
  }

  $conn->query($query) or die($conn->error);
  
  return $code;
  
}

function sendVerificationCode($user_id, $email){

  $code = generateCode($user_id);
  $code = persistCode($user_id, $code);

  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = '8212543@ntc.edu.ph';
  $mail->Password = 'qjwayzvccecktszk';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;

  $mail->setFrom('8212543@ntc.edu.ph');

  $mail->addAddress($email);

  $mail->isHTML(true);

  $mail->Subject = 'Sage Email Verification';
  $mail->Body = 'Your verification code is: ' . $code;

  $mail->send();

  echo '
  <script>
    alert("Verification code sent to your email");
    window.location.href = "verify-email.php?is_verifying=true";
  </script>
  ';


  
}



?>