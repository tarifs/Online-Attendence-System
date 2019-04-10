<?php 
session_start();
if($_SESSION['id'] == NULL){
  header('Location:login.php');
}
include'inc/header.php';
include'lib/Student.php';
include'lib/Login.php';

if (isset($_GET['logout'])) {

  $logout = new Login();
  $logout->logout();
  
}
?>
<?php 
$stu = new Student();
$cur_date = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $attend = $_POST['attend'];
  
  $insertattend = $stu->insertAttendance( $cur_date ,$attend);

}

?>

<?php 
if (isset($insertattend)) {
 echo $insertattend;
}

?>

<div class="container-fluid">
  <div class="panel panel-default">

   <div class="panel-heading">
     
     <h2>
      <a class="btn btn-success " href="add.php">Add Student</a>
      <a class="btn btn-info pull-right" href="index.php">Take Attendance</a>
      <a class="btn btn-danger pull-right" href="?logout=true">Logout</a>

    </h2>
  </div>


  <div class="panel-body">
   <div class="well text-center" style="font-size: 20px">
    <strong>Date:</strong><?php echo $cur_date; ?>
  </div>


  <form action="" method="post">
   <table class="table table-striped">
    <tr>
     <th width="30%">Serial</th>
     <th width="50%">Attendance Date</th>
     <th width="20%">Action</th>
     

   </tr>

   <?php 
   $stu = new Student();

   $get_date = $stu->getDateList();

   if (  $get_date) {
     $i= 0;
     while ($value = $get_date->fetch_assoc()) {
       $i++;  
       

       ?>

       <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $value['att_time']; ?></td>
         <td>
           <a href="student_view.php?dt=<?php  echo $value['att_time'];?>">View</a>

         </td>

       </tr>
       <?php } } ?>

       
       
     </table>
   </form>   	
 </div>


</div>



</div>
</body>
</html>