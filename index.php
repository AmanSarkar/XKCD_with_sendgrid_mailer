<?php
include('db.php');
$Api_key= "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";


if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $psw = mysqli_real_escape_string($con, $_POST['psw']);
  $active = md5(rand());

  if((!empty($email)) && (!empty($name)) && (!empty($psw))  ){
      //checking email existence
       $check_email_query = "SELECT * FROM testdata where email1='$email' ";
       $check_email_query_run = mysqli_query($con, $check_email_query);

if(mysqli_num_rows($check_email_query_run) <1){
    $query_k = "INSERT INTO testdata (name1,email1,password,activationcode) VALUES ('$name','$email',' $psw','$active')";
    $query_run = mysqli_query($con, $query_k);
    
    if ($query_run) {
        
        require 'vendor/autoload.php'; 
        $email_template = "
       <h2>Email verification</h2>
      <br></br>
       <a href='http://q-bot.in/Verify_email.php?token=$active'>Click this link to verify</a> ";

$mail = new \SendGrid\Mail\Mail(); 
$mail->setFrom("rtcamp.test.project@gmail.com", "$name");
$mail->setSubject("Verification mail");
$mail->addTo("$email","$name");
$mail->addContent("text/html","$email_template");


         $sendgrid = new \SendGrid($Api_key);
         $done = $sendgrid->send($mail);
       if($done){
           
        echo "Mail sent. Verify mail to start recieving XKCD comics!";
       
              //header('Location: https://rtcampprojectaman.000webhostapp.com/');
              // exit;
    }else{
          
     // header('Location: https://rtcampprojectaman.000webhostapp.com/');
   echo "Mail could not be sent";
       exit;
      }
      
  } else {
  echo "There were some unknow errors. Please try again !";
  // header('Location: https://rtcampprojectaman.000webhostapp.com/');
 exit;
 header('Location: login.php');
   }
   }else{
   echo "Email Already exists";
  //header('Location: https://rtcampprojectaman.000webhostapp.com/');
  exit;
  }
  }else{
      echo "All fields are mandetory";
     //header('Location: https://rtcampprojectaman.000webhostapp.com/');
      exit;
 }
}
?>