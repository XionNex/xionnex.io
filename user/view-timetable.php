<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('location:logout.php');
  } else{
   
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Management System|| View Notice</title>
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
              <h3 class="page-title"> View TimeTable </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> View TimeTable</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <table border="1" class="table table-bordered mg-b-0">
                      <?php
$stuclass=$_SESSION['stuclass'];
//$sql="SELECT tblclass.ID, tblclass.ClassName,tblclass.Section,tblsemester.NoticeTitle,tblnotice.CreationDate,tblnotice.ClassId,tblnotice.NoticeMsg,tblsemester.ID as nid from tblsemester join tblclass on tblclass.ID=tblsemester.ClassID where tblsemester.ClassID=:stuclass";
//$sql="SELECT tblclass.ID,tblclass.ClassName,tblclass.Section,tbltimetable.stime,tbltimetable.etime,tblcourse.ID,tblcourse.CourseName,tblcourse.Code,tblesubject.ID,tblsubject.SubjectName,
//tblsubject.SCode,tbltimetable.TID as nid from tbltimetable join tblcourse on tblcourse.ID=tbltimetable.CID join tblclass on tblclass.ID=tbltimetable.ClassID join tblsubject.ID=tbltimetable.SID where tbltimetable.ClassID=:stuclass";
$sql="SELECT tblclass.ID,tblclass.ClassName,tbltimetable.stime,tbltimetable.etime,tblsubject.SubjectName,tblsubject.SCode,tblclass.Section,tblcourse.CourseName,tblcourse.Code,tbltimetable.ClassId,tbltimetable.TID as nid from tbltimetable join tblclass on tblclass.ID=tbltimetable.ClassId join tblcourse on tblcourse.ID=tbltimetable.CID join tblsubject on tblsubject.ID=tbltimetable.SID where tbltimetable.ClassID=tbltimetable.ClassID";
$query = $dbh -> prepare($sql);
$query->bindParam(':stuclass',$stuclass,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
 <tr align="center" class="table-warning">
<th>Time/Day</th>
<th>Monday</th>
<th>Tuesday</th>
<th>Wednesday</th>
<th>Thursday</th>
<th>Friday</th>
</tr>
<tr align="center" class="table-info">
    <th>1</th>
    <td>
    <?php
	  $sql="SELECT * from tbltimetable where day = 'Monday' and stime='9:00 am' and etime='11:00 am'";
		$query=$dbh->prepare($sql);
		echo $row->SCode;
		 echo '<br>';
		echo $row->stime; 
    echo $row->etime;
	  ?>
    </td>
    <td>
    <?php
	  $sql="SELECT * from tbltimetable where day = 'TUESDAY' and stime='9:00' and etime='11:00'";
		$query=$dbh->prepare($sql);
		echo $row->SCode;
		 echo '<br>';
		echo $row->stime; 
    echo $row->etime;
	  ?><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
  </tr>
    <tr align="center" class="table-info">
    <th>2</th>
    <td><?php  echo $row->etime;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>3</th>
    <td><?php  echo $row->stime;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
    <td><?php  echo $row->SCode;?><br>
    <?php echo $row->stime;?>-<?php echo $row->etime;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>4</th>
    <td><?php  echo $row->stime;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>5</th>
    <td><?php  echo $row->stime;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>6</th>
    <td><?php  echo $row->stime;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>7</th>
    <td><?php  echo $row->stime;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>8</th>
    <td><?php  echo $row->stime;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>9</th>
    <td><?php  echo $row->stime;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
  </tr>
  <tr align="center" class="table-info">
     <th>10</th>
    <td><?php  echo $row->stime;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
    <td><?php  echo $row->SCode;?></td>
  </tr>
  
  <?php $cnt=$cnt+1;}} else { ?>
<tr>
  <th colspan="2" style="color:red;">No Notice Found</th>
</tr>
  <?php } ?>
</table>
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