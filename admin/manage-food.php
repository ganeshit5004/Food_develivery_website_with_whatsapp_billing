<?php include('partials/menu.php'); ?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage food</h1><br>
                <a href="<?php echo SITEURL ?>admin/add-food.php" class='btn-primary'>Add food</a><br><br>
                <?php
                 if(isset($_SESSION['add']))
                 {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                 }
                 if (isset($_SESSION['delete']))
                 {
                     echo $_SESSION['delete'];
                     unset($_SESSION['delete']);
                 }
                 if (isset($_SESSION['update']))
                 {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
                 }
                 if (isset($_SESSION['failed-remove']))
                 {
                     echo $_SESSION['failed-remove'];
                     unset($_SESSION['failed-remove']);
                 }
                 
                ?>
                <br><br><br>
                <table class='tbl-full'>
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                      
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql="SELECT * FROM tbl_food";
                        $res=mysqli_query($conn,$sql);
                        if ($res==true)
                        {
                            $count=mysqli_num_rows($res);
                            $sn=1;
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    $description=$rows['description'];
                                    $price=$rows['price'];
                                    $image_name=$rows['image_name'];
                                    $featured=$rows['featured'];
                                    $active=$rows['active'];
                                    ?>
                                    <tr>
                                       <td><?php echo $sn;?></td>
                                       <td><?php echo $title; ?></td>
                                       <td><?php echo $description; ?></td>
                                       <td><?php echo $price; ?></td>
                                        <td><?php 
                                        if ($image_name !='')
                                        {
                                               ?>
                                                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="" width='100px'>
                                               <?php
                                        }
                                        else
                                        {
                                           echo "<div class='error'>image is not added</div>";
                                        }
                                        
                                        ?></td>
                                        
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active;?></td>
                                        <td> <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class='btn-secondary'> update food</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>& image_name=<?php echo $image_name;?>" class='btn-danger'> delete food </a>
                                       </td>
                                        </tr>
                   
                                  <?php
                                  $sn =$sn +1;
                                }
                            }
                        }
                        

                    ?>
                   
                </table>
            </div>
        </div>
<?php include('partials/footer.php'); ?>