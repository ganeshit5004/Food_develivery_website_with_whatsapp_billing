<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <?php 
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_order WHERE id=$id ";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                $row=mysqli_fetch_assoc($res); 
                $id=$row['id'];
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['qty'];
                $total=$row['total'];
                $order_date=$row['order_date'];
                 $status=$row['status'];
                $customer_name=$row['customer_name'];
                $contact=$row['customer_contact'];
                $email=$row['customer_email'];
                $address=$row['customer_address'];
            }
            else
            { 
                $_SESSION['no-order']="<div class='error'>order not found</div>";
                 header("location:".SITEURL.'admin/manage-order.php');

            }

        }
        
        
        ?>
        <form action="" method='POST' enctype="multipart/form-data">
            <table class='tbl-30'>
                
                <tr>
                    <td>Food:</td>
                    <td><b><?php echo $food;?></b></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><b>₹<?php echo $price;?></b></td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td><input type="number" name="qty" id="" value="<?php echo $qty;?>"></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" id="" >
                            <option <?php if($status=='ordered'){echo 'selected';} ?> value="ordered">Ordered</option>
                            <option  <?php if($status=='on delivery'){echo 'selected';} ?> value="on delivery">On Delivery</option>
                            <option   <?php if($status=='delivered'){echo 'selected';} ?> value="delivered">Delivered</option>
                            <option  <?php if($status=='cancelled'){echo 'selected';} ?> value="cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name='customer_name' value="<?php echo $customer_name;?>"></td>
                </tr>
                <tr>
                    <td>Customer contact:</td>
                    <td><input type="number" name="contact" id="" value="<?php echo $contact;?>"></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><input type="text" name='email' value='<?php echo $email; ?>'></td>
                </tr>
                <tr>
                    <td>Customer address:</td>
                    <td><input type="text" name='address' value='<?php echo $address; ?>'></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <td colspan="2" > <input type="submit" value="Update order" name='submit' class="btn-secondary"></td>
                    
                </tr>
                
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price * $qty;
                $status=$_POST['status'];

                $customer_name=$_POST['customer_name'];
                $contact=$_POST['contact'];
                $email=$_POST['email'];
                $address=$_POST['address'];
                
                $sql2="UPDATE tbl_order SET 
                      qty=$qty,
                      total=$total,
                      status='$status',
                      customer_name='$customer_name',
                      customer_contact='$contact',
                      customer_email='$email',
                      customer_address='$address'
                      WHERE id=$id
                     ";

                $res2=mysqli_query($conn,$sql2);

                if($res2==true)
                {
                    $_SESSION['update']="<div class='success'>Updated successfully..</div>";
                    header("location:".SITEURL."admin/manage-order.php");
                }
                else
                {
                    $_SESSION['update']="<div class='error'>Failed to update order..</div>'";
                    header("location:".SITEURL."admin/manage-order.php");   
                }


            }
           
        ?>
    </div>
</div>


<?php include('partials/footer.php');?>