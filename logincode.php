
 <?Php

 include('db.php');

$data_seeking_query = mysqli_query($con, "SELECT * FROM testcase");
$row= mysqli_fetch_array($data_seeking_query);

if(isset($_POST['loginbtn'])){

 $email_id = $_POST['email'];
 $password_id = $_POST['psw'];
 
$email_id = mysqli_real_escape_string($con, $email_id);
$password_id = mysqli_real_escape_string($con, $password_id);

$password_db =  $row['email'];
$email_db = $row['password'];




if(($password_db != $email_id) && ($email_db != $password_id)){

Echo "wrong credentials";
}else{
  header("Location: Dashboard.php");
}






}
 

// $con= mysqli_connect("localhost","root","","userdata");

// if(isset($_POST['loginbtn'])){

//  if((!empty($email = $_POST['email'])) && (!empty($psw = $_POST['psw']))){

//   $email = mysqli_real_escape_string($con, $_POST['email']);
//   $psw = mysqli_real_escape_string($con, $_POST['psw']);

//     $login_query = " SELECT * FROM testcase where email='$email' password='$psw' ";
//     $login_query_run = mysqli_query($con, $login_query);
//     $check_data_existance =  $login_query_run->num_rows;
    
   
    

//    if ( $check_data_existance>0 ){

//       $row = mysqli_fetch_array($login_query_run);
        
//       if($row['verify_status'] == '1'){

//         header("Location: dashboard.php");  

//       }else{

//         echo "Verify email before login!";
//       }

//     }else{

//      echo "Invalid email or password!";

//     }

// }
// else{
//   echo "All fields are mandetory";

// }
// }
 
?>