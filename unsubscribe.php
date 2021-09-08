<?php
include('db.php');
$Api_key= "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";

if (isset($_GET['token'])) {

  $token = $_GET['token'];
  $varify_query = "SELECT * FROM testdata WHERE activationcode ='$token' LIMIT 1";
  $varify_query_run = mysqli_query($con, $varify_query);
  $result =mysqli_num_rows($varify_query_run);

  if ($result >0) {
    $fetch_data = mysqli_fetch_array( $varify_query_run);
    if ($fetch_data['unsubscribe'] == "1") {

      $clicked_token =$fetch_data['activationcode'];
      $name =$fetch_data['name1'];
      $email =$fetch_data['email1'];
      $update_query = " UPDATE testdata SET unsubscribe = '0' WHERE activationcode='$clicked_token' LIMIT 1";
      $update_query_run = mysqli_query($con, $update_query);

      if ($update_query_run) {
          
        echo "You have Unsubscribed sucessfully  :'( if you miss the comics... check your mail to start again :)";
       
        require 'vendor/autoload.php'; 
        $email_template = "
       <h2>Subscribe back</h2>
      <br></br>
       <a href='http://q-bot.in/subback.php?token=$clicked_token'>Click here to start receiving mails again</a> ";

$mail = new \SendGrid\Mail\Mail(); 
$mail->setFrom("rtcamp.test.project@gmail.com", "$name");
$mail->setSubject("Subscribe again to XKCD comic");
$mail->addTo("$email","$name");
$mail->addContent("text/html","$email_template");


         $sendgrid = new \SendGrid($Api_key);
         $sendgrid->send($mail);
      } else {
        echo "Could not unsubscribe";
      }
          
     }else {
        echo "You have already opted for not to reach you!";
         
     }
  }else {
        echo "The link has expired, try from the most recent mail. ";
      
  }
    
}
  ?>