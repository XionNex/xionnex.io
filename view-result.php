<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
 
?>
<div class="container-fluid" id="printable">
	<table width="100%">
	<?php
$vid=$_GET['viewid'];
//$sql="SELECT tblresult.ID,tblresult.StuID,tblresult.ClassID,tblresult.CourseCode,tblresult.score,tblresult.scoreGradePoint, tblstudent.StuID,tblstudent.StudentName,tblstudent.gender, tblclass.ID,tblclass.ClassName,tblclass.Section, tblsubject.ID,tblsubject.SubjectName,tblsubject.SCode
 //from tblresult inner join tblstudent on tblstudent.StuID=tblresult.StuID inner join tblclass on tblclass.ID=tblresult.ClassID inner join tblsubject on tblsubject.ID=tblresult.CoourseCode where ID=:vid";
$sql="SELECT tblstudent.StuID,tblresult.ID,tblresult.StuID,tblresult.CourseCode,tblresult.score1,tblresult.score2,tblresult.gradeaverage, tblstudent.StuID,tblstudent.StudentName,tblstudent.gender, tblsubject.ID,tblsubject.SubjectName,tblsubject.SCode
  from tblresult
  inner join tblstudent on tblstudent.ID=tblresult.StuID
  inner join tblsubject on tblsubject.ID=tblresult.CourseCode where vid=ID" ;
$query = $dbh -> prepare($sql);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
		<tr>
			<td width="50%">Student ID #: <b><?php echo htmlentities($row->StuID) ?></b></td>
			<td width="50%">Class: <b><?php echo htmlentities($row->ClassID) ?></b></td>
		</tr>
		<tr>
			<td width="50%">Student Name: <b><?php echo ucwords($name)?></td>
			<td width="50%">Gender: <b><?php echo ucwords($gender)?></td>
		</tr>
	</table>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Subject Code</th>
				<th>Subject</th>
				<th>Score</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$tblresult=$conn->query("SELECT tblresult.ID,tblresult.StuID,tblresult.ClassID,tblresult.CourseCode,tblresult.score,tblsubject.SubjectName,tblsubject.SCode,tblclass.ClassName,tblclass.Section from tblresult inner join tblclass on tblclass.ID=tblresult.ClassID inner join tblcourse on tblcsubject.ID=tblresult.CourseCode where tblresul.ID = $id order by tblsubject.SCode asc");
			while($row = $tblresult->fetch_assoc()):
			?>
			<tr>
				<td><?php echo $row['SCode'] ?></td>
				<td><?php echo ucwords($row['SubjectName']) ?></td>
				<td class="text-center"><?php echo number_format($row['score']) ?></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">Average</th>
				<th class="text-center"><?php echo number_format($scoreGradePoint,2)?></th>
			</tr>
		</tfoot>
		<?php $cnt=$cnt+1;}} ?>
	</table>
</div>
<div class="modal-footer display p-0 m-0">
	<button type="button" class="btn btn-success" id="print"><i class="fa fa-print"></i>Print</button>
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<noscript>
	<style> 
	table.table{
			width:100%;
			border-collapse: collapse;
		}
		table.table tr,table.table th, table.table td{
			border:1px solid;
		}
		.text-cnter{
			text-align: center;
		}
	</style>
	<h3 class="text-center"><b>Student Result</b></h3>
</noscript>
<script>
	$('#print').click(function(){
		start_load()
		var ns = $('noscript').clone()
		var content = $('#printable').clone()
		ns.append(content)
		var nw = window.open('','','height=700,width=900')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)

	})
</script>