<?php  
    //Include constant.php file here
    include('../config/constant.php');

    //1. get the ID Admin to be delected
    $id = $_GET['id'];

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM admin1 WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);
    
    //Check whether the query executed sucessfully or not
    if($res==true)
    {
        //Query Executed Sucessfully and Admin Deleted
        //echo"admin deleted";
        //Create Session variable to display message
        $_SESSION['delete'] = "<div class= 'success'>Admin Deleted Suceesfully.</div>";
        //Redirect to manage Admin Page
        header('location:'.SITEURL.'admin/manageadmin.php');
    }
    else
    {
        //Failed to delete admin
        //echo" Failed to deleted";
        $_SESSION['delete'] = "<div class = 'error'>Failed to  Delete Admin.Try again later</div>";
        header('location:'.SITEURL.'admin/manageadmin.php');

    }

    //3. Redirect to Manage admin page with message


?>