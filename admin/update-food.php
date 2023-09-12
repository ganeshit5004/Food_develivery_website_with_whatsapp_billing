<?php include('partials/menu.php');?>

    <div class='main-content'>
        <div class="wrapper">
            <h1>Update Food</h1><br> <br>
            <?php
                if(isset($_GET['id']))
                {
                        $id=$_GET['id'];
                        $sql="SELECT * FROM tbl_food WHERE id=$id";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);
                        if ($count==1)
                        {
                                $row=mysqli_fetch_assoc($res);
                                $title=$row['title'];
                                $description=$row['description'];
                                $price=$row['price'];
                                $current_image=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];

                        }
                        else{
                            $_SESSION['no-category-found']="<div class='error'>category not found</div>";
                            header("location:".SITEURL.'admin/manage-category.php');
                        }
                }
                else
                {
                    header("location:".SITEURL.'admin/manage-category.php');
                }
            
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class='tbl-30'>
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name='title' value='<?php echo $title; ?>'></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><input type="text" name='description' value="<?php echo $description; ?>"></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="text" name='price' value='<?php echo $price; ?>'></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php 
                                    if($current_image != "")
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image;?>" width="150px" alt="">
                                        <?php
                                    }
                                    else{
                                        echo "<div class='error'>Image not to be Added.</div>";
                                    }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image:</td>
                        <td><input type="file" name='image'></td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td><input <?php if($featured=="yes"){ echo 'checked';} ?> type="radio" name='featured' value='yes'>Yes
                        <input <?php if($featured=="no"){ echo 'checked';} ?>  type="radio" name='featured' value='no'>No
                      </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td><input <?php if($active=="yes"){ echo 'checked';} ?>  type="radio" name='active' value='yes'>Yes
                        <input <?php if($active=="no"){ echo 'checked';} ?> type="radio" name='active' value='no'>No
                      </td>
                    </tr>
                    <tr>
                        <input type="hidden" name='current_image' value="<?php echo $current_image; ?>">
                        <input type="hidden" name='id' value='<?php echo $id; ?>'>
                        <td colspan="2"><input type="submit" name='submit' value="update category" class='btn-secondary'></td>
                    </tr>
                </table>
            </form>
          <?php
                if(isset($_POST['submit']))
                {
                    $title=$_POST['title'];
                    $id=$_POST['id'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $current_image=$_POST['current_image'];
                   $featured=$_POST['featured'];
                    $active=$_POST['active'];
                    
                    if(isset($_FILES['image']['name']))
                    {       
                            $image_name=$_FILES['image']['name'];
                            if($image_name !='')
                            {
                                $ext=end(explode('.',$image_name));
                                $image_name="Food_Name_".rand(00000,99999).'.'.$ext;

                                $source_path=$_FILES['image']['tmp_name'];
                                $destination_path="../images/food/".$image_name;

                                $upload=move_uploaded_file($source_path,$destination_path);

                             if ($upload==False)
                             {
                                 $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                                 header("location:".SITEURL."admin/manage-food.php");
                                 die();
                            }
                            if ($current_image !='')
                            {
                                $remove_path="../images/food/".$current_image;

                                $remove=unlink($remove_path);
    
                                if($remove==false)
                                {
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove the current image.</div>";
                                    header("location:".SITEURL."admin/manage-food.php");
                                }
                            }
                           

                        }
                     else{
                        $image_name=$current_image;
                    }
                }
                 else
                   {
                            $image_name=$current_image;
                    }

                    $sql2="UPDATE tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id";
            
                
                $res2=mysqli_query($conn,$sql2);
                if ($res2==true)
                {
                    $_SESSION['update']="<div class='success'>update successfully.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
                else
                {
                    $_SESSION['update']="<div class='error'>Failed to update category.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }

             }
            
          ?>
            
        </div>
    </div>


<?php include('partials/footer.php'); ?>