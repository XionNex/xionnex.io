<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('edit-function-result.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
$score1=$_POST['score1'];
$score2=$_POST['score2'];
$scode=$_POST['scode'];
$eid=$_GET['editid'];

$sql="UPDATE tblresult set score1=:score1,score2=:score2,CourseCode=:scode where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':score1',$score1,PDO::PARAM_STR);
$query->bindParam(':score2',$score2,PDO::PARAM_STR);
$query->bindParam(':scode',$scode,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Result has been updated")</script>';
  echo "<script>window.location.href = 'manage-result.php'</script>";
}

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Management System|| Manage Result</title>
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
              <h3 class="page-title"> Manage Result </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Update Result</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Update Result</h4>
                   
                    <form class="forms-sample" method="post">
                      <?php
$eid=$_GET['editid'];
$sql="SELECT * from  tblresult where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>  
                      <div class="form-group">
                        <label for="exampleInputName1">Subject</label>
                        <input type="text" name="scode" value="<?php  echo htmlentities($row->CourseCode);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1"> 1st</label>
                        <input type="text" name="score1" value="<?php  echo htmlentities($row->score1);?>" class="form-control" required='true'>
                      </div>    
                      <div class="form-group">
                        <label for="exampleInputName1"> 2nd</label>
                        <input type="text" name="score2" value="<?php  echo htmlentities($row->score2);?>" class="form-control" required='true'>
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