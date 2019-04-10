<?php
session_start();
if($_SESSION['id'] == NULL){
  header('Location:login.php');
} 
include'inc/header.php';
include'lib/Student.php';
include'lib/Login.php';


$id = $_GET['id'];
$student = new Student;
$result = $student->getStudentInfoById($id);
$student=mysqli_fetch_assoc($result);


if(isset($_POST['btn'])){
 $student = new Student;
 $student->updateStudentInfo();
}


?>



<div class="panel panel-default">

	<div class="panel-heading">
   
   <h2>
    <!-- <a class="btn btn-success " href="add.php">Add Student</a> -->
    <a class="btn btn-info pull-right" href="index.php">Back</a>

  </h2>
  <h3>Update Student Info</h3>
</div>

<div class="panel-body">
  <form action="" method="post">
   <div class="form-group">
    <label for="name">Student Name:</label>
    <input type="text" class="form-control col-md-5" name="name"  value="<?php echo $student['name']?>">
    <input type="hidden" name="id" value="<?php echo $student['id']?>">
    
  </div>

  <div class="form-group">
    <label for="roll">   Student Roll:</label>
    <input type="text" class="form-control col-md-5" name="roll" value="<?php echo $student['roll']?>"  >
    
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="btn" value="Update Student">
    
  </div>
  
</form>

</div>








</div>