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

<script type="text/javascript">
	
	$(document).ready(function () {
		$("form").submit(function () {

			var roll = true;
			$(':radio').each(function () {
				name = $(this).attr('name');
        if (roll && !$(':radio[name  = "' +name+ '"]:checked').length) {

                	// alert(name + "Roll Missing !");
                	$('.alert').show();
                	roll = false;
                }
              });
			return roll;
		});
	});
</script>

<?php 

$stu = new Student();

if(isset($_GET['status'])){
  $stu->deleteStudentInfo($_GET['id']);
}
?>


<?php 
/*
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
*/
    ?> 


    <div class='alert alert-danger' style="display: none"><strong>Field !</strong> Student Roll Missing !</div>



    <div class="container-fluid">
      <div class="panel panel-default">

       <div class="panel-heading">
         
         <h2>
          <a class="btn btn-success " href="add.php">Add Student</a>
          <a class="btn btn-info pull-right" href="date_view.php">View attendance list</a>
          <a class="btn btn-primary pull-right" href="index.php">Take Attendane</a>
          <a class="btn btn-danger pull-right" href="?logout=true">Logout</a>


        </h2>
      </div>


  <!--  <div class="panel-body">
     <div class="well text-center" style="font-size: 20px">
     	  <strong>Date:</strong><?php echo $cur_date; ?>
       </div> -->
       

       <form action="" method="post">
         <table class="table table-striped">
          <tr>
           <th width="20%">Serial</th>
           <th width="20%">Student Name</th>
           <th width="20%">Student roll</th>
           
           <th width="20%">Action</th>

         </tr>

         <?php 
         $get_student = $stu->getStudents();

         if (  $get_student) {
           $i= 0;
           while ($value = $get_student->fetch_assoc()) {
             $i++;  
             

             ?>

             <tr>
               <td><?php echo $i; ?></td>
               <td><?php echo $value['name'] ?></td>
               <td><?php echo $value['roll'] ?></td>
               
               <td>
                 <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $value['id']?>">Edit</a>
                 <a class="btn btn-xs btn-danger" href="?status=delete&id=<?php echo $value['id']; ?> " onclick ="return confirm('Are you sure to delete this data?');">Delete</a>

                 

               </td>

             </tr>
             <?php } } ?>
             
             
             
             <tr>
               <td colspan="4">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
              </td>
            </tr>
            
          </table>
        </form>   	
      </div>


    </div>

  </div>


</body>
</html>