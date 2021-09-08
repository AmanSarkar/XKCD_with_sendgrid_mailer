<?php
include('db.php');

if (isset($_GET['token'])) {

  $token = $_GET['token'];
  $varify_query = "SELECT * FROM testdata WHERE activationcode ='$token' LIMIT 1";
  $varify_query_run = mysqli_query($con, $varify_query);
  $result =mysqli_num_rows($varify_query_run);

  if ($result >0) {
    $fetch_data = mysqli_fetch_array( $varify_query_run);
    if ($fetch_data['unsubscribe'] == "0") {

      $clicked_token =$fetch_data['activationcode'];
    
      $update_query = " UPDATE testdata SET unsubscribe = '1' WHERE activationcode='$clicked_token' LIMIT 1";
      $update_query_run = mysqli_query($con, $update_query);

      if ($update_query_run) {
          
        echo "You have subscribed sucessfully  again :-)";
     }
        
    }else{
          echo "You are already receiving mails";
      }
      
  }
    
    
}else{
    echo "Invalid token";
}
?>