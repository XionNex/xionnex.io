
<?php
include('dbconnection1.php');
session_start(); 

if (isset($_SESSION['UserName']))
{
    $UserName = $_SESSION['UserName'];

}
else if(isset($_SESSION['StuID'])){

   $StuID = $_SESSION['StuID'];
}

else{
  echo "<script type = \"text/javascript\">
  window.location = ();
  </script>";

}

// $expiry = 1800 ;//session expiry required after 30 mins
// if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > $expiry)) {

//     session_unset();
//     session_destroy();
//     echo "<script type = \"text/javascript\">
//           window.location = (\"../index.php\");
//           </script>";

// }
// $_SESSION['LAST'] = time();
    
?>