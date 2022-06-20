<?php
  session_start();
  include_once('db_connection.php');
  if(strcmp($_SESSION['employee_role'],"super admin")!=0){
      header("Location:home_attendance.php");
  }
  else {
    if(isset($_POST['update'])){
      $con = connectDB();
      $complaintnumber=$_GET['cid'];
      $status=$_POST['status'];
      $remark=$_POST['remark'];
      $query=mysqli_query($con,"insert into complaint_remark(complaintNumber,status,remark) values('$complaintnumber','$status','$remark')");
      $sql=mysqli_query($con,"update complaints set status='$status' where complaintNumber='$complaintnumber'");
      echo "<script>alert('Complaint details updated successfully');</script>";
    }
 ?>
<script language="javascript" type="text/javascript">
  function f2(){
    window.close();
  }
  function f3(){
    window.print(); 
  }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Court</title>
</head>
<body>

<div style="margin-left:50px;">
  <form name="updateticket" id="updatecomplaint" method="post"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr height="50">
      <td><b>Complaint Number</b></td>
      <td><?php echo htmlentities($_GET['cid']); ?></td>
    </tr>
    <tr height="50">
      <td><b>Status</b></td>
      <td><select name="status" required="required">
      <option value="">Select Status</option>
      <option value="in process">In Process</option>
      <option value="closed">Closed</option>
      </select></td>
    </tr>
      <tr height="50">
      <td><b>Remark</b></td>
      <td><textarea name="remark" cols="50" rows="10" required="required"></textarea></td>
    </tr>
      <tr height="50">
      <td>&nbsp;</td>
      <td><input type="submit" name="update" value="Submit"></td>
    </tr>
      <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
  <td></td>
      <td >   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this window " onClick="return f2();" style="cursor: pointer;"  /></td>
    </tr>
</table>
 </form>
</div>

</body>
</html>

<?php } ?>