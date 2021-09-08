<?php
include('db.php');


if (isset($_GET['token'])) {

  $token = $_GET['token'];
  $varify_query = "SELECT activationcode, status FROM testdata WHERE activationcode ='$token' LIMIT 1";
  $varify_query_run = mysqli_query($con, $varify_query);
  $result =mysqli_num_rows($varify_query_run);

  if ($result >0) {
    $fetch_data = mysqli_fetch_array( $varify_query_run);
    if ($fetch_data['status'] == "0") {

      $clicked_token =$fetch_data['activationcode'];
      $update_query = " UPDATE testdata SET status = '1' WHERE activationcode='$clicked_token' LIMIT 1";
      $update_query_run = mysqli_query($con, $update_query);

      if ($update_query_run) {
          
        echo "You have verified sucessfully. You will start recieving mails Soon.";
       // xkcd_mail("$name", " $email", "$email_template");
       // header("Location: https://rtcampprojectaman.000webhostapp.com/theloop.php");
       // exit(0);
      } else {
        echo "Verification failed! ";
       // header("Location: login.php");
       // exit(0);
      }
    }
  } else {

    echo "This token doesnot exist";
   // header("Location: login.php");
  }
} else {

 echo "Not allowed";
 // header("Location: login.php");
}
?>