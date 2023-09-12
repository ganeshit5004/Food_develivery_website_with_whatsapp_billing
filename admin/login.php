<?php  include('../config/constants.php');?>

<html>
<head>
    <title>Login-food order system</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/login-style.css">
</head>
<body>
    <div class=" font login">
        <h1 class="text-center">Login</h1><br> 
        <?php 
        if (isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset( $_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset( $_SESSION['no-login-message']);
        }
        
        ?>
        
        <br>
            <form action="" method="POST" class="text-center" >
                 
                <input type="text" name='username' placeholder="enter your username"><br><br>
              
                <input type="password" name='password' placeholder="enter your password"><br><br>
                <input type="submit" name='submit' value="Login" class='btn-primary ' >

            </form>


        <p class='text-center'>Created by - <a href="#">Admin</a></p>
    </div>
</body>

</html>

<?php

    if (isset($_POST['submit']))
    {
         $username=$_POST['username'];
         $password=md5($_POST['password']);

         $sql="SELECT * FROM tbl_admin WHERE username='$username' and password='$password'";

         $res=mysqli_query($conn,$sql);

         $count=mysqli_num_rows($res);
         echo $count;

         if ($count==1)
         {
                $_SESSION['login']="<div class='success' >Login successfully</div>";

                $_SESSION['user']=$username;

                header("location:".SITEURL."admin/index.php");
         }
         else
         {
            $_SESSION['login']="<div class='error text-center' >username and password is not found.</div>";
            header("location:".SITEURL."admin/login.php");
         }

    }

?>