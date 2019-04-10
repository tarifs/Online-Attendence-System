<?php 
  include'inc/header.php';
   include'lib/Student.php';
include'all_student.php';
$id = $_GET['id'];

$conn = mysqli_connect('localhost','root','','db_sams');

$sql = "DELETE FROM tbl_student WHERE id = $id ";
$query = mysqli_query($conn ,$result);


 ?>