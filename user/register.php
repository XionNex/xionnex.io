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
$sname=$_POST['sname'];
$username=$_POST['username'];
$email=$_POST['email'];
$pnum=$_POST['pnum'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$address=$_POST['address'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$stuclass=$_POST['stuclass'];
$altconnum=$_POST['altconnum'];
$password=$_POST['password'];
$stuid=$_POST['stuid'];
$cid=$_POST['cid'];
$sql="INSERT into tblstudent(FatherName,MotherName,Address,DOB,Gender,AltenateNumber,StudentClass,CourseID,StuID,StudentName,UserName,StudentEmail,ContactNumber,Password)values
(:fname,:mname,:address,:dob,:gender,:altconnum,:stuclass,:cid,:stuid,:sname,:username,:email,:pnum,:password)";
$query=$dbh->prepare($sql);
$query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
$query->bindParam(':sname',$sname,PDO::PARAM_STR);
$query->bindParam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':pnum',$pnum,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':mname',$mname,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':stuclass',$stuclass,PDO::PARAM_STR);
$query->bindParam(':altconnum',$altconnum,PDO::PARAM_STR);
$query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
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
        <input type="text" class="login-input" name="sname" placeholder="Name" required='true'/>
        <input type="text" class="login-input" name="username" placeholder="Username" required='true'/>
        <input type="text" class="login-input" name="stuid" placeholder="Student ID" required='true'/>
        <br>
        <select  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="cid"  required='true'>
                          <option value="">Select Programme</option>
                         <?php 

$sql2 = "SELECT * from    tblcourse ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->Code);?> || <?php echo htmlentities($row1->CourseName);?></option>
 <?php } ?> 
        </select>
        <br><br>
        <select  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="stuclass" required='true'>
                          <option value="">Select Class</option>
                         <?php 

$sql2 = "SELECT * from    tblclass ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->ClassName);?> <?php echo htmlentities($row1->Section);?></option>
 <?php } ?> 
        </select>
        <br><br>
        <input type="text" class="login-input" name="email" placeholder="Email" required='true'/>
        <input type="date" class="login-input" name="dob" placeholder="DOB" required='true'/>
        <input type="text" class="login-input" name="gender" placeholder="Gender" required='true'/>
        <h3>Parents details</h3>
        <input type="text" class="login-input" name="fname" placeholder="Father's Name" required='true'/>
        <input type="text" class="login-input" name="mname" placeholder="Mother's Name" required='true'/>
        <input type="text" class="login-input" name="pnum" placeholder="Contact Number" required='true'/>
        <input type="text" class="login-input" name="altconnum" placeholder="Phone Number" required='true'/>
        <input type="text" class="login-input" name="address" placeholder="Address" required='true'/>
        <input type="text" class="login-input" name="password" placeholder="Password" required='true'/>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to login</a></p>
    </form>
</body>
</html> 