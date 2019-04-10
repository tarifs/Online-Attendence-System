<?php 
/**
 * summary
 */
class Db
{
    /**
     * summary
     */
    public function dbConnection(){
        $link = mysqli_connect('localhost','root','','db_sams');
        return $link;
    }
}






 ?>