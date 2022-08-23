<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Category</h2>   
        
        <br>

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        
        <br>

        <!-- Add category starts here -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" id="featured_yes" value="Yes"> 
                            <label for="featured_yes">Yes</label>

                            <input type="radio" name="featured" id="featured_no" value="No"> 
                            <label for="featured_no">No</label>
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" id="active_yes" value="Yes"> 
                            <label for="active_yes">Yes</label>

                            <input type="radio" name="active" id="active_no" value="No"> 
                            <label for="active_no">No</label>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        <!-- Add category ends here -->

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
// Process the value from form and save it in Database

// check whether the submit button is clicked or not   

    if(isset($_POST['submit'])){
        // 1. get value from category form
        $title= $_POST['title'];

        // for radio button we have to check button is clicked or not
        if(isset($_POST['featured'])){
            // get value from form
            $featured= $_POST['featured'];
        } else{
            //default value 
            $featured= "No";
        }

        // for radio button we have to check button is clicked or not
        if(isset($_POST['active'])){
            // get value from form
            $active= $_POST['active'];
        } else{
            //default value 
            $active= "No";
        }

        // check whether the image is selected or not and set the value for image name accordingly
        //print_r($_FILES['image']);
        //die(); //break the code here

/************************************************************************************** 
 *                                                                                    *                                    
 *                                  UPLOAD IMAGE SCRIPT                               * 
 *                                                                                    *  
 **************************************************************************************/

        // check whether the image is selected or not and set the value for image name accordingly
            if(isset($_FILES['image']['name'])){
                // image upload 
                $image_name= $_FILES['image']['name'];

                if($image_name != ""){
                    // Auto rename our image
                    // get the extension of our image (jpg, png, gif, etc) e.g. "specialfood.jpg"
                    $ext= end(explode('.', $image_name)); // end is used to get value after the '.'

                    // Rename the image
                    $image_name= "Food_Category_".$title."_".rand(0, 999).".".$ext; // e.g: Food_Category455.jpg

                    $source_path= $_FILES['image']['tmp_name'];

                    $destination_path= "../images/category/".$image_name;

                    // finally upload the image
                    $upload= move_uploaded_file($source_path, $destination_path);

                    // check whether the image is upload or not
                    // and if the image is not upload then we will stop the process and redirect with error message
                    if($upload==false){
                        // set message 
                        $_SESSION['upload']= "<div class='failure'>Failed to Upload Image!</div>";
                        // redirect to add category page
                        header('location:'.SITEURL.'admin/add-category.php');
                        // stop the process 
                        die();
                    }
                }   
            } else{
                // Don't upload image and set the image_name value to blank 
                $image_name= "";
            }

        // 2. SQL query to save data in database 
        $sql= "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";
        
        // 3. Execute query and save data in database
        $res= mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));


        // 4. Check whether the (Query is executed) data is inserted or not and diaplay appropiate message
        if($res==true){
            // Query executed and Category added
            $_SESSION['add']= "<div class='success'>Category added successfully!</div>";
            // redirect to manage-category page
            header('location:'.SITEURL.'admin/manage-category.php');
        } else{
            // failure msg
            $_SESSION['add']= "<div class='failure'>Failure!</div>";
            // redirect to manage-category page
            header('location:'.SITEURL.'admin/add-category.php');
        }
    }

?>