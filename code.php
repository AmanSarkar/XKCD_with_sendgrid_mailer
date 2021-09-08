<?php
session_start();
include('db.php');
include('mail.php');



if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $psw = mysqli_real_escape_string($con, $_POST['psw']);
  $active = md5(rand());

  //checking email existence
   
  $check_email_query = "SELECT email FROM testcase where email='$email' LIMIT 1";
  $check_email_query_run = mysqli_query($con, $check_email_query);
  $existence_check =mysqli_num_rows($check_email_query_run);

  if((!empty($email)) && (!empty($name)) && (!empty($psw))  ){


  if ($existence_check <1) {
    $query = "INSERT INTO testcase (name,email,password,active) VALUES ('$name','$email','$psw',' $active')";
    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {

      // sendemail_verify("$name", " $email", " $active");
      // $_SESSION['status'] = "Registration Successful! please verify the link sent to your email";
      // header("Location: register.php");
    } else {
      $_SESSION['status'] = "Registration Failed";
      header("Location: register.php");
    }
  } else {
   
    $_SESSION['status'] = "Email id already exist";
    header("Location: login.php");
  }
  }else{
    echo "fill all the fields";
  }
}


?>
