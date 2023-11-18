<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add-Item</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Name of the Item">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of Item"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Item" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
            <?php

                if(isset($_POST['submit']))
                {
                    //Add the Item in Database
                    //1.Get the data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST ['price'];

                    //2. Upload the image if selected
                    //Check whether the select image is clicked or not 
                    if(isset($_FILES['image']['name']))
                    {
                        //Get the details of the selected image
                        $image_name = $_FILES['image']['name'];

                        //Check whether image selected or not and upload image if selected
                        if($image_name!= "")
                        {
                            //image is selected
                            //A. rename the image
                            //give extension of selected image like jpg,png,gif,etc
                            $ext = end(explode('.',$image_name));

                            //Create new name for image
                            $image_name = "Item-Name-".rand(0000,9999).".".$ext; //New image name 

                            //Upload the image
                            //Get the source path and destination path

                            //Source path is current location of the image 
                            $src = $_FILES['image']['tmp_name'];

                            //Destination Path for the image to be uploaded
                            $dst = "../pic/items/".$image_name;

                            //Finally upload image 
                            $upload = move_uploaded_file($src,$dst);
                            //Check image uploade or not
                            if($upload==false)
                            {
                                //Failed to upload image
                                //redirect to add item page with error message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                header('location:'.SITEURL.'admin/add-item.php');
                                die();

                                //stop the process
                            }
                        }
                    }
                    else
                    {
                        $image_name = "";//setting default value as blank
                    }

                    //3. insert into database

                    //Create SQL query to save or add item
                    //for numericl no need to pass value inside quotes only string
                    $sql2 = "INSERT INTO items SET
                        title='$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name'

                    ";
                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        //Data succesfull inserted 
                        $_SESSION['add'] = "<div class='success'>Item Added Succesfully.</div>";
                        header('location:'.SITEURL.'admin/manageitem.php');

                    }
                    else
                    {
                        //failed to insert data
                        $_SESSION['add'] = "<div class='error'>Failed Added.</div>";
                        header('location:'.SITEURL.'admin/manageitem.php');
                    }
                    //4. Redirect with message to manage item
                }




            ?>





    </div>
</div>


<?php include('partials/footer.php') ?>

