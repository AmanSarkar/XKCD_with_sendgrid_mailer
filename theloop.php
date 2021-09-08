<?php
include('db.php');


$CID = rand(100, 1000);
require_once('xkcd.php');
$xkcd = new xkcd();
$comic = $xkcd->get($CID); 

require 'vendor/autoload.php'; 

$Api_key= "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";


  
    $mail = new \SendGrid\Mail\Mail(); 
    $mail->setFrom("rtcamp.test.project@gmail.com", "Xkcd Comic");
    $mail->setSubject(" Xkcd Coimc");
    $sendgrid = new \SendGrid($Api_key);

$query = "SELECT * FROM testdata WHERE status='1' AND unsubscribe='1'";
$query_run = mysqli_query($con, $query);
while($row = mysqli_fetch_array($query_run)){
 $email= $row['email1'];
 $name= $row['name1'];
 $token= $row['activationcode'];
 
  $mail->addTo("$email", "$name");
  $email_template="
    '<h1>'.$comic->safe_title.' </h1>'<br> <br>
    <img src={$comic->img} title={$comic->alt}/><br><br><br>
    '<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>'<br><br><br>
   <h2>Full version</h2><a href=\{$comic->url}\>{$comic->url}</a>;<br><br><br><br><br><br>
   <a href='http://q-bot.in/unsubscribe.php?token=$token'>Click to unsubscribe Subscribe</a>";

  $mail->addContent("text/html/img", "$email_template");
$conf_loop = $sendgrid->send($mail);
}
// if($conf_loop){
//     $sleep = sleep(300);}
//     if($sleep){
//      header("Location: https://rtcampprojectaman.000webhostapp.com/theloop.php");
//      exit();
//     }else{
//         echo "Unable to work";
//          //header("Location: https://rtcampprojectaman.000webhostapp.com/theloop.php");
//     }
?>