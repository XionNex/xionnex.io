<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
 $stuid=$_POST['stuid'];
 $cname=$_POST['cname'];
 $clname=$_POST['clname'];
 $sname=$_POST['sname'];
 $s2=$_POST['s2'];
 $s3=$_POST['s3'];
 $eid=$_GET['editid'];

$sql="UPDATE tblsemester set CourseName=:cname,StuID=:stuid,ClassName=:clname,s2=:s2, s3=:s3 where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
$query->bindParam(':cname',$cname,PDO::PARAM_STR);
$query->bindParam(':clname',$clname,PDO::PARAM_STR);
$query->bindParam(':sname',$sname,PDO::PARAM_STR);
$query->bindParam(':s2',$s2,PDO::PARAM_STR);
$query->bindParam(':s3',$s3,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Form has been updated")</script>';
  echo "<script>window.location.href = 'manage-semester.php'</script>";
}

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Management System|| Manage Semester</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Manage Semester </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Manage Semester</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Update Semester</h4>
                   
                    <form class="forms-sample" method="post">
                      <?php
$eid=$_GET['editid'];
$sql="SELECT * from  tblsemester where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>    
<div class="form-group">
  <label for="exampleInputEmail3">Programme Name</label>
  <select  name="cname" class="form-control" required='true'>
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
</div>
<div class="form-group">
                        <label for="exampleInputEmail3">Class Name</label>
                        <select  name="clname" class="form-control" required='true'>
                          <option value="">Select Class</option>
                         <?php 

$sql2 = "SELECT * from    tblclass ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->ClassName);?> || <?php echo htmlentities($row1->Section);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      <h3>Subject Detail's</h3>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Subject 1</label>
                        <select  name="sname" class="form-control" required='true'>
                          <option value="">Select Subject</option>
                         <?php 

$sql2 = "SELECT * from    tblsubject ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->SCode);?> || <?php echo htmlentities($row1->SubjectName);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Subject 2</label>
                        <select  name="s2" class="form-control" required='true'>
                          <option value="">Select Subject</option>
                         <?php 

$sql2 = "SELECT * from    tblsubject ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->SCode);?> || <?php echo htmlentities($row1->SubjectName);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Subject 3</label>
                        <select  name="s3" class="form-control" required='true'>
                          <option value="">Select Subject</option>
                         <?php 

$sql2 = "SELECT * from    tblsubject ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->SCode);?> || <?php echo htmlentities($row1->SubjectName);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      
                      <?php $cnt=$cnt+1;}} ?>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                     
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php }
  ?>