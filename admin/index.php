<?php include('partials/menu.php');?>
        <div class="main-content">
            <div class="wrapper">
                    <h1>DASHBOARD</h1><br><br>
                    <?php 
                             if (isset($_SESSION['login']))
                              {
                                    echo $_SESSION['login'];
                                    unset( $_SESSION['login']);
                             }
        
                    ?>
                    <div class="col-4 text-center">
                        <?php 
                            $sql='SELECT * FROM tbl_category';
                            $res=mysqli_query($conn,$sql);
                            $count=mysqli_num_rows($res);
                        
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <br>
                        category
                    </div>
                    <div class="col-4 text-center">
                        <?php 
                            $sql2='SELECT * FROM tbl_food';
                            $res2=mysqli_query($conn,$sql2);
                            $count2=mysqli_num_rows($res2);
                        ?>
                        <h1><?php echo $count2; ?></h1>
                        <br>
                        Foods
                    </div>
                    <div class="col-4 text-center">
                    <?php 
                            $sql3='SELECT * FROM tbl_order';
                            $res3=mysqli_query($conn,$sql3);
                            $count3=mysqli_num_rows($res3);
                        ?>
                        <h1><?php echo $count3; ?></h1>
                        <br>
                        Total Orders
                    </div>
                    <div class="col-4 text-center">
                    <?php 
                            $sql4="SELECT sum(total) as total FROM tbl_order WHERE status='delivered'";
                            $res4=mysqli_query($conn,$sql4);
                            $row=mysqli_fetch_assoc($res4);
                            
                        ?>
                        <h1>₹<?php echo $row['total'] ; ?></h1>
                        <br>
                        Revenue Generated
                    </div>
                    <div class="clear-fix"></div>
            </div>
        </div>
       
        
   <?php include('partials/footer.php'); ?>