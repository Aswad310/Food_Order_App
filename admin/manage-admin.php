<?php include("partials/menu.php"); ?>

        <!-- Main Content Section starts  -->
        <section class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <br/>
                
                <?php  
                    if(isset($_SESSION['add'])){ // Checking wheather the SESSION is set or not  
                        echo $_SESSION['add']; // Displaying Session Message
                        unset($_SESSION['add']); // Removing Session Message
                    }

                    if(isset($_SESSION['delete'])){ // Checking wheather the SESSION is delete or not  
                        echo $_SESSION['delete']; // Displaying Delete Message
                        unset($_SESSION['delete']); // Removing Delete Message
                    }

                    if(isset($_SESSION['update'])){ // Checking wheather the SESSION is update or not  
                        echo $_SESSION['update']; // Displaying update Message
                        unset($_SESSION['update']); // Removing update Message
                    }
                    
                    if(isset($_SESSION['user-not-find'])){  
                        echo $_SESSION['user-not-find'];
                        unset($_SESSION['user-not-find']); 
                    }

                    if(isset($_SESSION['pwd-not-match'])){  
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']); 
                    }

                    if(isset($_SESSION['change-pwd'])){  
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']); 
                    }  
                ?>

                <br/><br/>
                
                <!-- Button to Add Admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php
                        // Query to Get all Admin
                        $sql="SELECT *FROM tbl_admin";

                        // Execute query
                        $res= mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

                        // Check whether the query is executed or not
                        if($res==true){
                            // Count rows whether we have data in database or not 
                            $count= mysqli_num_rows($res);
                            $sn= 1; //create a variable and assign a value

                            if($count>0){
                                // we have data in database
                                while($rows= mysqli_fetch_assoc($res)){
                                    // While loop runs as long we have data in database

                                    //Get individual data
                                    $id= $rows['id'];
                                    $full_name= $rows['full_name'];
                                    $username= $rows['username'];

                                    // Display the value in our Table (by Breaking PHP)
                                    ?> 
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Update Password</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                            
                                        </td>
                                    </tr>

                                    <?php
                                }
                            } else{
                                // we do no have data in database
                                ?> <!-- PHP breaks-->
                            
                                <tr>
                                    <td colspan="6" class="failure text-center">No Category Added.</td>
                                </tr>
    
                                <?php 
                                echo 'No Data';
                            }
                        }
                    ?>
                </table>
            </div>  
            <div class="clearfix"></div>
            
        </section>
        <!-- Main Content Section ends  -->

<?php include("partials/footer.php"); ?>