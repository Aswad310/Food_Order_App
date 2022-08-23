<?php include("partials/menu.php") ?>


<div class="main-content">
    <div class="wrapper">
        <h2>Add Food</h2>
        
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>

        <!-- Add Food starts here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>

                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>

                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>

                    <td>
                        <input type="number" name="price" placeholder="e.g. 10">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>

                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>

                    <td>
                        <select name="category">
                            <?php 
                                $sql= "SELECT *FROM tbl_category WHERE active= 'Yes' ";

                                // Executing query
                                $res= mysqli_query($conn, $sql) or die("error".mysqli_error(($conn)));
                                
                                // count rows to check whether we have categories or not
                                $count= mysqli_num_rows($res);

                                // if count greater than 0 we have category else we have no category
                                if($count>0){
                                    // we have categories   
                                    while($row= mysqli_fetch_assoc($res)){
                                        // get the details of cetegories    
                                        $id= $row['$id'];
                                        $title= $row['title'];

                                        ?>
                                        <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                        <?php
                                    }

                                } else{
                                    // we dont have categories
                                    ?>
                                        <option value="1">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>

                    <td>
                        <input type="radio" name="featured" id="featured-yes" value="Yes"> 
                        <label for="featured-yes">Yes</label>
                        <input type="radio" name="featured" id="featured-no" value="No">
                        <label for="featured-no">No</label>
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>

                    <td>
                        <input type="radio" name="active" id="active-yes" value="yes"> 
                        <label for="active-yes">Yes</label>
                        <input type="radio" name="active" id="active-no" value="no">
                        <label for="active-no">No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div> 
</div>

<?php include("partials/footer.php") ?>


<?php
    if(isset($_POST['submit'])){

        // 1. get data from form
        $title= $_POST['title'];
        $description= $_POST['description'];
        $price= $_POST['price'];
        $category= $_POST['category'];

        // for radio button we have to check button is clicked or not
        if(isset($_POST['featured'])){
            $featured= $_POST['featured'];
        } else{
            $featured= "No";
        }

        if(isset($_POST['active'])){
            $active= $_POST['active'];
        } else{
            $active= "No";
        }

        //2. Upload the Image if selected
        // check whether the image is selected or not and set the value for image name accordingly
        if(isset($_FILES['image']['name'])){
            // image upload 
            $image_name= $_FILES['image']['name'];

            if($image_name != ""){
                // Auto rename our image
                // get the extension of our image (jpg, png, gif, etc) e.g. "specialfood.jpg"
                $ext= end(explode('.', $image_name)); // end is used to get value after the '.'

                //A.  Rename the image
                $image_name= "Food_Name_".$title."_".rand(000, 999).".".$ext; // e.g: Food_Category455.jpg

                //B.  Upload the image
                $source_path= $_FILES['image']['tmp_name'];

                $destination_path= "../images/food/".$image_name;

                // finally upload the image
                $upload= move_uploaded_file($source_path, $destination_path);

                // check whether the image is upload or not
                // and if the image is not upload then we will stop the process and redirect with error message
                if($upload==false){
                    // set message 
                    $_SESSION['upload']= "<div class='failure'>Failed to Upload Image!</div>";
                    // redirect to add category page
                    header('location:'.SITEURL.'admin/add-food.php');
                    // stop the process 
                    die();
                }
            }   
        } 
        else
        {
            // Don't upload image and set the image_name value to blank 
            $image_name= "";
        }

    //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2) or die("error".mysqli_error(($conn)));   

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

    }
?>
