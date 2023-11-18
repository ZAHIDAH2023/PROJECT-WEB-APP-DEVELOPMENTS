<?php 
     include('../config/constant.php'); 

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to delete

        //1. Get ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image available
        if($image_name != "")
        {
            //It has image and need to remove from folder
            //get image path
            $path = "../pic/items/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //Check whether the image remove or not
            if($remove == false)
            {
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to remove File.</div>";
                //Redirect to manage item
                header('location:'.SITEURL.'admin/manageitem.php');
                //stop the process of deleting item
                die();

            }


        }

        //3. Delete item from database
        $sql = "DELETE FROM items WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check the query executed or not and set the session message
        //4. Redirect to manage item with session message
        if($res==true)
        {
            //item deleted
            $_SESSION['delete'] = "<div class='success'>Items Deleted Succesfully.</div>";
            header('location:'.SITEURL.'admin/manageitem.php');
        }
        else{
            //failed to delete
            $_SESSION['delete'] = "<div class='error'>Failed to Deleted.</div>";
            header('location:'.SITEURL.'admin/manageitem.php');
        }

        //4. Redirect to manage item with session message

    }
    else
    {
        //Redirect to manage item page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manageitem.php');
    }

?>