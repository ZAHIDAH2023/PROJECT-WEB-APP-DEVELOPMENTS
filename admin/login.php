<?php include('../config/constant.php'); ?>

<html>
    <head>
        <title>Login - ON</title>
        <link rel="stylesheet" href="styleadminpanel.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>
            <br><br>
            <!----Login form starts Here --->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
    
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>


            <!----Login form ends Here --->


            <p class="text-center">Created By - <a href="Zahidah Az-Zahra">Zahidah Az-Zahra</a></p>
        </div>
    </body>
</html>

<?php 
    //Check whether submit button function or not
    if(isset($_POST['submit']))
    {
        //Process for login
        //1. Get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exist or not
        $sql = "SELECT * FROM admin1 WHERE username='$username' AND password='$password'";

        //3. Exxecute the query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whther user exist or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User Available and Login success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not will unset it
            //Redirect to Home page /dashboard
            header('location:'.SITEURL.'admin/adminpanel.php');
        }
        else
        {
            //User not Available and login failed
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to Home page /dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>