<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }

        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="New Password">
                </td>
                </tr>
                
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    //Check whether the submit buttom is clicked or not
    if(isset($_POST['submit']))
    {
        //echo"Clicked";

        //1. Get the data from form 
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2. Check whether the user with current ID and current Password or not
        $sql = "SELECT * FROM admin1 WHERE id=$id AND password='$current_password'";

        //Execute the query 
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Check whether data is avalable or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //User exist and Password can be changed 
                //echo "User Found";

                //Check whether the new password and confirm match or not
                if($new_password==$confirm_password)
                {
                    // Update the password
                    //echo "password match";
                    $sql2 = "UPDATE admin1 SET
                        password='$new_password'
                        WHERE id=$id
                    ";
                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        //Dusplay success message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        header('location:'.SITEURL.'admin/manageadmin.php');
                    }
                    else
                    {
                        //displayy Error message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed change Password.</div>";
                        header('location:'.SITEURL.'admin/manageadmin.php');
                    }
                }
                else
                {
                    //redirect to manage admin with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match.</div>";
                    header('location:'.SITEURL.'admin/manageadmin.php');
                }
            }
            else
            {
                //User does not exist set message and redirect 
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
                header('location:'.SITEURL.'admin/manageadmin.php');
            }
        }
        //3. Check whether the new password and confirm passsword match or not

        //4. Change password if all above is true
    }

?>

<?php include('partials/footer.php'); ?>