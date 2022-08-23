<?php
    // include constants,php file here
    include('../config/constants.php');

    // Failure message if admin is not deleted
    if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset ($_SESSION['delete']);
    }

    // 1. Get the Id of the admin to be deleted
    echo $id= $_GET['id'];

    // 2. create SQL query to delete the admin
    $sql= "DELETE FROM tbl_admin WHERE id= $id ";

    // 3. execute the query
    $res= mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

    // 4. Check whether the Query is executed or not 
    if($res==true){
        // Query executed successfully and admin Deleted

        // create session variable to display delete admin message
        $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully</div>";
        // redirect 
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else{
        // Falied to delete admin 

        // create session variable to display delete admin message
        $_SESSION['delete']= "<div class='failure'>Fail to delete Admin. Try again Later</div>";
        // redirect 
        header('location:'.SITEURL.'admin/delete-admin.php');
    }
?>