<!DOCTYPE html>
<html>
    <header>
        <meta charset="utf-8"/>
        <title>Registration</title>
        <link rel="stylesheet" href="css/styles.css"/>
    </header>
<body>

<?php
session_start();
error_reporting(0);
require('includes/dbconnection.php');
//when form submitted, insert values into the db
if(isset($_POST['submit']))
{
$aname=$_POST['aname'];
$username=$_POST['username'];
$email=$_POST['email'];
$pnum=$_POST['pnum'];
$password=$_POST['password'];
$sql="insert into tbladmin(AdminName,UserName,Email,MobileNumber,Password)values(:aname,:username,:email,:pnum,:password)";
$query=$dbh->prepare($sql);
$query->bindParam(':aname',$aname,PDO::PARAM_STR);
$query->bindParam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':pnum',$pnum,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0){
   echo '<script>alert("You are Registered Successfully.")</script>';
   echo "<script>window.location.href ='login.php'</script>";
     }
     else
       {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
       }
   }
     ?>

    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="aname" placeholder="Name" required='true'/>
        <input type="text" class="login-input" name="username" placeholder="Username" required='true'/>
        <input type="text" class="login-input" name="email" placeholder="Email" required='true'/>
        <input type="text" class="login-input" name="pnum" placeholder="Phone Number" required='true'/>
        <input type="text" class="login-input" name="password" placeholder="Password" required='true'/>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to login</a></p>
    </form>
</body>
</html>