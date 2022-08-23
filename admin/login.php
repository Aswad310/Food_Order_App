<?php include('../config/constants.php') ?>

<html>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <!-- Login form starts here -->
                <form action="" method="POST">
                    <label for="username">Username:</label> <br>
                    <input type="text" name="username"> <br>    

                    <label for="password">Password:</label> <br>
                    <input type="password" name="password"> <br>

                    <input type="submit" name="submit" value="Login" class="btn-primary"> <br> <br>

                    <?php 
                        if(isset($_SESSION['login'])){  
                            echo $_SESSION['login'];
                            unset($_SESSION['login']); 
                        } 

                        if(isset($_SESSION['no-login-message'])){  
                            echo $_SESSION['no-login-message'];
                            unset($_SESSION['no-login-message']); 
                        } 
                    ?>
                </form>
            <!-- Login form ends here  -->
            
            <br>
            
            <p class="text-center">Created By - <a href="www.facebook.com">Aswad Ali</a> </p>

            
        </div>
    </body>
</html>

<?php

    // check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // process for login

        // 1. get data from login form
        $username= $_POST['username'];
        $password= md5($_POST['password']);

        // 2. sql query 
        $sql= "SELECT *FROM tbl_admin WHERE username= '$username' AND password= '$password' ";

        // 3. Execute query
        $res= mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

        // 4. Check whether the (Query is executed)
        $count= mysqli_num_rows($res);

            if($count==1){
                // Success msg
                $_SESSION['login']= "<div class='success'>Login Successfull!</div>";
                $_SESSION['user']= $username; //to check whether the user is logged in or not and logout will unset it

                // Redirect to Manage admin page
                header('location:'.SITEURL.'admin/index.php');
            } else{
                // Failure msg
                $_SESSION['login']= "<div class='failure text-center'>Login Failed!</div>";
                // Redirect to Login page
                header('location:'.SITEURL.'admin/login.php');
            }
    }
?>