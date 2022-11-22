<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        View Grade
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudGradeModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Student Grade</button>  
                                        
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 

                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                <th>School Year</th>
                                                <th>Class</th>
                                                <th>Subject</th>
                                                <th>Student</th>
                                                <th>1st</th>
                                                <th>2nd</th>
                                                <th>Average</th>
                                                <th>Remarks</th>
                                                <th style="width: 40px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "SELECT *,sg.id as sgid, CONCAT(t.lname, ', ', t.fname, ' ', t.mname)  as tname, CONCAT(s.lname, ', ', s.fname, ' ', s.mname)  as sname
                                                                        FROM tblstudentgrade sg
                                                                        LEFT JOIN tblstudentclass sc ON sg.classid = sc.classid
                                                                        AND sg.studentid = sc.studentid
                                                                        AND sg.subjectid = sc.subjectid
                                                                        LEFT JOIN tblstudent s ON sg.studentid = s.id
                                                                        LEFT JOIN tblteacheradvisory ta ON sg.classid = ta.classid
                                                                        LEFT JOIN tblteacher t ON sg.adviserid = t.id
                                                                        LEFT JOIN tblclass c ON sg.classid = c.id
                                                                        LEFT JOIN tblschoolyear sy ON sg.schoolyearid = sy.id
                                                                        LEFT JOIN tblsubjects sb on sg.subjectid = sb.id
                                                                        where sg.adviserid = '".$_SESSION['userid']."' ");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['sgid'].'" /></td>
                                                    <td>'.$row['schoolyear'].'</td>
                                                    <td>'.$row['classname'].'</td>
                                                    <td>'.$row['subjectname'].' - '.$row['description'].'</td>
                                                    <td>'.$row['sname'].'</td>
                                                    <td>'.$row['1stgrading'].'</td>
                                                    <td>'.$row['2ndgrading'].'</td>
                                                    <td><b>'.$row['gradeaverage'].'</b></td>
                                                    <td>'.($row['remarks'] == "Passed" ? "<label style='color:green'>".$row['remarks']."</label>" : (($row['remarks'] == "Failed") ? "<label style='color:red'>".$row['remarks']."</label>" : "<label style='color:black'>No Final Remarks</label>")) .'</td>
                                                    <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['sgid'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                </tr>
                                                ';
                                                include "editModal.php"; 
                                            }
                                            ?>
                                        </tbody>
                                    </table>


                                    <?php include "../deleteModal.php"; ?>
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "addmodal.php"; ?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->

        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,11 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>