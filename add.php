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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $roll = $_POST['roll'];
  $insertdata = $stu->insertStudent( $name,$roll);

}

?>

<?php 
if (isset( $insertdata)) {
 echo $insertdata;
}

?>
<div class="container-fluid">
  <div class="panel panel-default">

   <div class="panel-heading">
     
     <h2>
      <a class="btn btn-success " href="add.php">Add Student</a>
      <a class="btn btn-info pull-right" href="index.php">Back</a>
      <a class="btn btn-danger pull-right" href="?logout=true">Logout</a>

    </h2>
  </div>

  <div class="panel-body">
    <form action="" method="post">
     <div class="form-group">
      <label for="name">Student Name:</label>
      <input type="text" class="form-control col-md-5" name="name" id="name" >
      
    </div>

    <div class="form-group">
      <label for="roll">   Student Roll:</label>
      <input type="text" class="form-control col-md-5" name="roll" id="roll" >
      
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="submit" value="Add Student">
      
    </div>
    
  </form>

</div>

</div>
</div>
