<?php

    // Authorization - Access Control
    // Check whether the user is logged in or not
    if(!isset($_SESSION['user'])){
        // user is not login
        // redirect with a error message
        $_SESSION['no-login-message']= "<div class='failure text-center'>Please! login to access Admin Panel</div>";
        // Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }

?>