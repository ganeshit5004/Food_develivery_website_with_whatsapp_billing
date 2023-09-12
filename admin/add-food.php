<?php include('partials/menu.php') ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['add']))
            {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
            }
           
    
            ?>
            
            <br><br>
            <form action="" method='POST' enctype="multipart/form-data">
                <table class='tbl-30'>
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="enter your title"></td>

                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea name="description" id="" cols="30" rows="5" placeholder="decription of the food"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name='price' placeholder="enter the price"></td>
                    </tr>
                    <tr>
                        <td>Select image:</td>
                        <td><input type="file" name='image'></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><select name="category" id="">
                            <?php 
                                $sql="SELECT * FROM tbl_category WHERE active='yes'";
                                $res=mysqli_query($conn,$sql);

                                $count=mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id=$row['id'];
                                        $title=$row['title'];

                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title;?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <option value="#">No Category Found</option>

                                    <?php
                                }
                            ?>
                            
                               
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name='featured' value='yes'>Yes
                            <input type="radio" name='featured' value='no'>No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name='active' value='yes'>Yes
                            <input type="radio" name='active' value='no'>No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name='submit' value="Add food" class="btn-secondary"></td>
                    </tr>
                </table>
              
            </form>
            <?Php 
                    if(isset($_POST['submit']))
                    {
                      
                        $title=$_POST['title'];
                        $description=$_POST['description'];
                        $price=$_POST['price'];
                        $category=$_POST['category'];
                        
                        if(isset($_POST['featured']))
                        {
                            $featured=$_POST['featured'];

                        }
                        else
                        {
                            $featured='no';
                        }
                        if(isset($_POST['active']))
                        {
                            $active=$_POST['active'];
                        }
                        else{
                            $active='no';
                        }
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
                                    header("location:".SITEURL."/admin/add-food.php");
                                    die();
                                }
                            }
                        
                        }
                        else
                        {
                            $image_name='';
                        }
                        $sql2="INSERT INTO tbl_food  SET
                                title='$title',
                                description='$description',
                                price=$price,
                                image_name='$image_name',
                                category_id=$category,
                                featured='$featured',
                                active='$active'";
                        $res2=mysqli_query($conn,$sql2);

                        if($res2==true)
                        {
                            
                            $_SESSION['add']="<div class='success'>Food add successfully.</div>";
                            header("location:".SITEURL."admin/manage-food.php");
                        }
                        else
                        {
                           
                            $_SESSION['add']="<div class='error'>Failed to add food.</div>";
                            header("location:".SITEURL."admin/manage-food.php");
                        }

                    }
            
            ?>
        </div>
    </div>


<?php include('partials/footer.php') ?>
