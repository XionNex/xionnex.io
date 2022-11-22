<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
  $cid=$_POST['cid'];
  $classid=$_POST['classid'];
  $stime=$_POST['stime'];
  $etime=$_POST['etime'];
  $day=$_POST['day'];
  $sid=$_POST['sid'];
$sql="insert into tbltimetable(CID,ClassID,stime,etime,SID,day)values(:cid,:classid,:stime,:etime,:sid,:day)";
$query=$dbh->prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query->bindParam(':stime',$stime,PDO::PARAM_STR);
$query->bindParam(':etime',$etime,PDO::PARAM_STR);
$query->bindParam(':day',$day,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Time Table has been added.")</script>';
echo "<script>window.location.href ='add-timetable.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Management System|| Add TimeTable</title>
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
              <h3 class="page-title"> Add Time Table </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Add Time Table</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Add Time Table</h4>
                   
                    <form class="forms-sample" method="post">
                      
                      <div class="form-group">
                        <label for="exampleInputName1">Programme Name</label>
                        <select  name="cid" class="form-control" required='true'>
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
                        <select  name="classid" class="form-control" required='true'>
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
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Day</label>
                        <select  name="day" class="form-control" required='true'>
                          <option value="">Select Day</option>
                          <option value="MONDAY">MONDAY</option>
                          <option value="TUESDAY">TUESDAY</option>
                          <option value="WEDNESDAY">WEDNESDAY</option>
                          <option value="THURSDAY">THURSDAY</option>
                          <option value="FRIDAY">FRIDAY</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1"> Start Time</label>
                        <input type="time" name="stime" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1"> End Time</label>
                        <input type="time" name="etime" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Subject Name</label>
                        <select  name="sid" class="form-control" required='true'>
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
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                     
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
</html><?php }  ?>