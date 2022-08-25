<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Food</h2>

        <br> <br>

        <?php
            // Retreive data from DB
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                // 1. Query
                $sql = "SELECT *FROM tbl_food WHERE id = $id";

                // 2. Execute Query
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

                // 3. Check whether Query executed or not
                if($res == true)
                {
                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        // show message that Food Available
                        echo "Food Available";

                        $rows = mysqli_fetch_assoc($res);

                        $id = $rows['id'];
                        $title = $rows['title'];
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $current_image = $rows['image_name'];
                        $current_category = $rows['category_id'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
                    }
                    else
                    {
                        // session to give error
                        $_SESSION["category-not-found"]= "<div class='failure'>Food not found</div>";
                        // redirect to manage food
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        ?>

    <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" ><?php echo $description ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php 
                        if($current_image != "")
                        {
                            ?> 
                            <img src="<?php echo SITEURL?>images/food/<?php echo $current_image?>" alt="" width="100px">
                            <?php 
                        } 
                        else
                        {
                            echo "<div class='failure'>Image Not Added</div>";
                        }
                            
                    ?>
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
                            // Query
                            $sql2 = "SELECT *FROM tbl_category WHERE active = 'Yes'";
                            // execute Query
                            $res = mysqli_query($conn, $sql2) or die('error'.mysqli_error($conn));
                            // check whether Query execute or not
                            if($res == true)
                            {
                                // count rows
                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    while($rows = mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $rows['title'];
                                        $category_id = $rows['id']; ?>

                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>No Category Available</option>";
                                }
                                
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured == 'Yes') echo 'checked'; ?> type="radio" name="featured" value="Yes"> Yes 
                    <input <?php if($featured == 'No') echo 'checked'; ?>type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active == 'Yes') echo 'checked'; ?> type="radio" name="active" value="Yes"> Yes 
                    <input <?php if($active == 'No') echo 'checked'; ?>type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>

        </table>

    </form> 
    </div>
</div>

<!-- Here we update the food -->
<?php
    if(isset($_POST['submit']))
    {
        // echo "Btn Clicked";

        // 1. get all the details from the form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];

        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2. Upload the image if selected
        
    }
?>

<?php include("partials/footer.php"); ?>