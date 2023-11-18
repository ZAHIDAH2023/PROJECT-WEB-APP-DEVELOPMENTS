<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage-Item</h1>

        <br /><br />

                <!-- Button to Add admin -->
                <a href="<?php echo SITEURL; ?>admin/add-item.php" class="btn-primary">Add Item</a>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                
                
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>

                    </tr>
                    <?php  
                        //Create SQL query to get all items
                        $sql = "SELECT * FROM items";

                        //Execute query
                        $res = mysqli_query($conn, $sql);

                        //Count rows to check whether we have item or not
                        $count = mysqli_num_rows($res);

                        $sn=1;

                        if($count>0)
                        {
                            //Have items in Database
                            //get fitems from database and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // get the values from individual column
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $title; ?></td>
                                        <td>RM <?php echo $price; ?></td>
                                        <td>
                                            <?php 
                                                //Check whether we have image or not
                                                if($image_name=="")
                                                {
                                                    //we do not have image, display error image
                                                    echo "<div class='error'>Image not Added.</div>";
                                                }
                                                else
                                                {
                                                    //we have image,display image
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>pic/items/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                }
                                            
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-item.php?id=<?php echo $id; ?>" class="btn-secondary">Update Items</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Items</a>
                                        </td>
                                    </tr>
        
                                <?php
                            }
                        }
                        else
                        {
                            // Item not added in database
                            echo "<tr><td colspan='5' class='error'>Item not Added Yet.<td></tr>";
                        }
                    
                    ?>
                    
                </table>
    </div>
</div>

<?php include('partials/footer.php') ?>