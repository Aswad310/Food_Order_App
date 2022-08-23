<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>

        <br/><br/>

        <?php 
        // Failure message if admin is not updated
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']); 
            }
        
        ?>

        <?php 
            // 1. Get ID 
            $id= $_GET['id'];

            // 2. SQL query
            $sql= "SELECT *FROM tbl_admin WHERE id= $id ";

            // 3. execute query
            $res= mysqli_query($conn, $sql) or die("error in query ".mysqli_error($conn));

            // 4. check whether the query is executed or not
            
            if($res==true){
                $count= mysqli_num_rows($res);

                if($count==1){
                    // show message that Admin Available
                    echo "Admin Available";

                    $rows= mysqli_fetch_assoc($res);

                    $full_name= $rows['full_name'];
                    $username= $rows['username'];
                } else{
                    // if there is no admin then redirect to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }   
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
            <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>"> 
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php

    // set the value if submit button is clicked
    if(isset($_POST['submit'])){
        // 1. get Data from form
        $id= $_POST['id'];
        $full_name= $_POST['full_name'];
        $username= $_POST['username'];

        // 2. sql Query
        $sql= "UPDATE  tbl_admin SET 
                full_name= '$full_name', 
                username= '$username' 
                WHERE id= $id
                ";

        
        // 3. execute query 
        $res= mysqli_query($conn, $sql) or die('error in query '.mysqli_error($conn));

        // 4. check whether the query is executed or not
        if($res==true){
            $_SESSION['update']= "<div class='success'>Admin Updated Successfully!</div>";

            header('location:'.SITEURL.'admin/manage-admin.php');
        } else{
            $_SESSION['update']= "<div class='failure'>Admin Not updated!</div>";

            header('location:'.SITEURL.'admin/update-admin.php');
        }
    } 

?>