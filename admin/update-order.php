<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <?php        
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                // 1. query
                $sql = "SELECT *FROM tbl_order WHERE id = $id";
                // 2. execute query
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                // 3. check query whether execute or not
                if($res == true)
                {
                    // count row
                    $count = mysqli_num_rows($res);
                    
                    if($count == 1)
                    {
                        // order find
                        $row = mysqli_fetch_assoc($res);
                        
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address= $row['customer_address'];
                    }
                    else
                    {
                        // order not find
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.SITEURL.'admin/manage-order.php');
            }        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <br>
                <tr>
                    <td>Food Name</td>
                    <td><strong><?php echo $food ?></strong></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b><?php echo "$".$price ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty ?>">
                    </td>    
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status == 'Ordered'){ echo "Selected"; } ?> value="Ordered">Ordered</option>
                            <option <?php if($status == 'On Delivery'){ echo "Selected"; } ?>value="On Delivery">On-Delivery</option>
                            <option <?php if($status == 'Delivered'){ echo "Selected"; } ?>value="Delivered">Delivered</option>
                            <option <?php if($status == 'Cancelled'){ echo "Selected"; } ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <b><?php echo $customer_name; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <b><?php echo $customer_contact; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <b><?php echo $customer_email; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <b><?php echo $customer_address; ?></b>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="customer_name" value="<?php echo $customer_name; ?>">
                        <input type="hidden" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        <input type="hidden" name="customer_email" value="<?php echo $customer_email; ?>">
                        <textarea hidden name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
             if(isset($_POST['submit']))
             {
                // geting data from users Input field
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty; // total 
                $status = $_POST['status'];

                //Update the Values
                $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status'
                    WHERE id = $id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2) or die('error'.mysqli_error($conn));

                //Check whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }         
        ?>

    </div>
</div>
<?php include('partials/footer.php') ?>