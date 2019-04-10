
<?php 

$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');

?>







<?php 


class Student
{

  private $db;

  public function __construct()
  {
   $this->db = new Database();
 }



 public function getStudents()
 {
  $query = "SELECT * FROM  tbl_student";
  $result = $this->db->select($query);
  return $result;
}


public function insertStudent( $name,$roll)
{
  $name = mysqli_real_escape_string($this->db->link,$name);
  $roll = mysqli_real_escape_string($this->db->link,$roll);

  if (empty($name) || empty($roll)) {
   $msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be Empty !</div>";
   return $msg;
 }else{
   $stu_query = "INSERT INTO tbl_student(name,roll) VALUES('$name','$roll')";
   $stu_insert = $this->db->insert( $stu_query);

   $att_query = "INSERT INTO  tbl_attendance(roll) VALUES('$roll')";
   $stu_insert = $this->db->insert( $att_query);

   if ($stu_insert) {
    $msg = "<div class='alert alert-success'><strong>Success !</strong>Student Data Inserted Successfully !</div>";
    return $msg;
  }else{
    $msg = "<div class='alert alert-danger'><strong>Error !</strong>Field ! Student Data not Inserted !</div>";
    return $msg;
  }

}
}



public function insertAttendance( $cur_date ,$attend =array() )
{
  $query = "SELECT DISTINCT att_time FROM tbl_attendance";

  $getdata  = $this->db->select($query);

  while ($result = $getdata->fetch_assoc()) {

    $db_date = $result['att_time'];

    if ($cur_date == $db_date) {

      $msg = "<div class='alert alert-danger'><strong>Error !</strong>Field ! Attendance already taken today</div>";
      return $msg;
    }
  }


  foreach ($attend as $atn_key => $atn_value) {
   if ($atn_value == "present") {

     $stu_query = "INSERT INTO tbl_attendance(roll,attend,att_time) VALUES ('$atn_key ','present','$cur_date')";
     $data_insert = $this->db->insert( $stu_query);
   }elseif($atn_value == "absent"){

    $stu_query = "INSERT INTO tbl_attendance(roll,attend,att_time) VALUES ('$atn_key ','absent','$cur_date')";
    $data_insert = $this->db->insert( $stu_query);

  }

}


if ($data_insert) {
  $msg = "<div class='alert alert-success'><strong>Success !</strong>Attendance Data Inserted Successfully !</div>";
  return $msg;
}else{
  $msg = "<div class='alert alert-danger'><strong>Error !</strong>Field ! Attendance Data not Inserted !</div>";
  return $msg;
}

}







public function getDateList()
{
  $query = "SELECT DISTINCT att_time FROM tbl_attendance";
  $result  = $this->db->select($query);
  return $result;
}



public function getAllData($dt)
{
  $query = "SELECT tbl_student.name, tbl_attendance.*
  FROM tbl_student  
  INNER JOIN tbl_attendance 
  ON tbl_student.roll = tbl_attendance.roll 
  WHERE att_time = '$dt' ";
  $result  = $this->db->select($query);
  return $result;
}




public function updateAttendance( $dt ,$attend)
{


 foreach ($attend as $atn_key => $atn_value) {
   if ($atn_value == "present") {

     $query = "UPDATE tbl_attendance
     SET attend = 'present'
     WHERE roll = '".$atn_key."' AND att_time = '".$dt."' ";
     $data_update = $this->db->update( $query);



   }elseif($atn_value == "absent"){

     $query = "UPDATE tbl_attendance
     SET attend = 'absent'
     WHERE roll = '".$atn_key."' AND att_time = '".$dt."' ";
     $data_update = $this->db->update( $query);

   }

 }


 if ($data_update) {
  $msg = "<div class='alert alert-success'><strong>Success !</strong>Attendance Data Updated Successfully !</div>";
  return $msg;
}else{
  $msg = "<div class='alert alert-danger'><strong>Error !</strong>Field ! Attendance Data not Updated !</div>";
  return $msg;
}



}
public function getStudentInfoById($id){
  $link = mysqli_connect('localhost','root','','db_sams');
  $sql = "SELECT * FROM  tbl_student WHERE id = '$id'";
  if(mysqli_query($link,$sql)){
    $result = mysqli_query($link,$sql);
    return $result;
  } else {
    die('Query Problem'.mysqli_error($link));
  }
}


public function updateStudentInfo(){
  $link = mysqli_connect('localhost','root','','db_sams');
  $sql = "UPDATE tbl_student SET name='$_POST[name]', roll='$_POST[roll]' WHERE id='$_POST[id]'";
  if(mysqli_query($link,$sql)){
    header('Location:all_student.php');
  } else {
    die('Connection Problem'.mysqli_error($link));
  }
}






public function deleteStudentInfo($id){
  $link = mysqli_connect('localhost','root','','db_sams');
  $sql = "DELETE FROM tbl_student WHERE id = '$id'";
  if(mysqli_query($link,$sql)){
    header('Location:all_student.php');
  } else{
    die('Connection Problem'.mysqli_error($link));
  }
}


}



?>