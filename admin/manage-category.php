<?php include("partials/menu.php"); ?>

        <!-- Main Content Section starts  -->
        <section class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>
                <br>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['category-not-found'])){
                        echo $_SESSION['category-not-found'];
                        unset($_SESSION['category-not-found']);
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['failed-remove'])){
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
                ?>
                <br/><br/>
                
                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>

                <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        // 1. sql query to retrive data from database
                        $sql= "SELECT *FROM tbl_category";

                        // 2. execute query and retrive data
                        $res= mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

                        // 3. check whether the query is executed or not
                        if($res==true){
                            $count= mysqli_num_rows($res);
                            $sn=1;

                            if($count>0){
                                // we have data in database
                                while($rows= mysqli_fetch_assoc($res)){
                                // While loop runs as long we have data in database

                                //Get individual data
                                
                                $id= $rows['id'];
                                $title= $rows['title'];
                                $image_name=$rows['image_name'];
                                $featured= $rows['featured'];
                                $active= $rows['active'];

                                // Display the value in our Table
                                ?> <!-- PHP breaks-->
                                 <tr>
                                    <td><?php echo $sn++; ?></td>   
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        
                                        <?php
                                        
                                            if($image_name!=""){
                                                //Display the image
                                                ?> <!-- PHP breaks-->

                                                <img src="<?php echo SITEURL?>images/category/<?php echo $image_name?>" alt="" width="100px">

                                                <?php
                                            } else{
                                                //Display the message
                                                echo "<div class='failure'>Image Not Added</div>";
                                            }
                                        
                                        ?>
                                
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <!-- Actions -->
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id?>&imagae_name=<?php echo $image_name?>" class="btn-danger">Delete Category</a>
                                        
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
                        } 
                    }
                    ?>
                </table>
            </div>  
            <div class="clearfix"></div>
            
        </section>
        <!-- Main Content Section ends  -->

<?php include("partials/footer.php"); ?>