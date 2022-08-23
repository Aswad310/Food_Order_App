<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Admin</h2>   
        <br/><br/>
        
        <?php  
            if(isset($_SESSION['add'])){ // Checking wheather the SESSION is set or not  
                echo $_SESSION['add']; // Displaying Session Message
                unset($_SESSION['add']); // Removing Session Message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Password">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
// Process the value from form and save it in Database

// check whether the submit button is clicked or not    

    if(isset($_POST['submit'])){
        // 1. Get data from form
        $full_name= $_POST['full_name'];
        $username= $_POST['username'];
        $password= md5($_POST['password']); // PASSWORD encryption with md5

        // 2. SQL query to save data in database 
        $sql= "INSERT INTO tbl_admin SET 
                full_name= '$full_name',
                username= '$username',
                password= '$password' 
                ";

        // 3. Execute query and save data into a Database
        $res= mysqli_query($conn, $sql) or die('error'. mysqli_error($conn));

        // 4. Check whether the (Query is executed) data is inserted or not and diaplay appropiate message
        if($res==true){
            // Create a session variable to Display Message 
            $_SESSION['add']= "<div class='success'>Admin Added Successfully</div>";
            //Redirect Page to Manage Admin  
            header("location:".SITEURL.'admin/manage-admin.php');
        } else{
            // Create a session variable to Display Message 
            $_SESSION['add']= "<div class='failure'>No Admin is Added</div>";
            //Redirect Page to Add Admin Admin  
            header("location:".SITEURL.'admin/add-admin.php');
        }   
    }
?>