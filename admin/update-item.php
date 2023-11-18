<?php include('partials/menu.php'); ?>

<?php
    //Check whether set or not
    if(isset($_GET['id']))
    {
        //get all the details
        $id = $_GET['id'];

        //SQL Query to get selected items
        $sql2 = "SELECT * FROM items WHERE id=$id";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the individual value of selected items
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
    }
    else
    {
        //Redirect to manage item
        header('location:'.SITEURL.'admin/manageitem.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update-Item</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description"  cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                //image not available
                                echo "<div class= 'error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image Available
                                ?>
                                    <img src="<?php echo SITEURL; ?>pic/items/<?php echo $current_image; ?>" width="100px">

                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Item" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //1. Get all the details from the form 
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $row['current_image'];

                //2. Upload the image if selected 
                //Check whether upload button clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload button clicked
                    $image_name = $_FILES['image']['name'];//New image name

                    //check whether file available or not
                    if($image_name != "")
                    {
                        //image is available
                        //rename the image
                        $ext = end(explode('.', $image_name));//get extension of the image
                        $image_name = "Item-Name-".rand(0000, 9999).'.'.$ext;//image will be renamed

                        //get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];//source path
                        $dest_path = "../pic/items/".$image_name;//Destination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //Check whether the image is uploaded or not 
                        if($upload == false)
                        {
                         //Failed upload
                         $_SESSION['upload'] = "<div class='error'>Failed to Upload The image.</div>";
                         //Redirect to manage item
                         header('location:'.SITEURL.'admin/manageitem.php');
                         die();//stop the process
                        }
                        //3. Remove the image if new image uploaded and current image exist
                        //B. remove current image if Available
                        if($current_image != "")
                        {
                            //Current image is Available
                            //Remove the image
                            $remove_path = "../pic/items/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is remove or not
                            if($remove==false)
                            {
                                //Failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                //redirect
                                header('location:'.SITEURL.'admin/manageitem.php');
                                die();
                            }

                        }
                    }
                    else
                    {
                        $image_name = $current_image;// Default image when is not selected 
                    }
                }
                else
                {
                    $image_name = $current_image;// Default image when button not clicked
                }

                //4. Update the item in Database
                $sql3 = "UPDATE items SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name'
                    WHERE id=$id
                ";

                //Execute the SQL query
                $res3 = mysqli_query($conn, $sql3);

                //Check query executed or not
                if($res3==true)
                {
                    //item updated
                    $_SESSION['update'] = "<div class='success'>Item Updated.</div>";
                    header('location:'.SITEURL.'admin/manageitem.php');

                }
                else
                {
                    //Failed to update item
                    $_SESSION['update'] = "<div class='error'>Item failed to Updated.</div>";
                    header('location:'.SITEURL.'admin/manageitem.php');
                }

                //Redirect to manage item with Session Message
            }
            else
            {

            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>