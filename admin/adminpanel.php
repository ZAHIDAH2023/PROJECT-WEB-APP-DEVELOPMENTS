<?php include('partials/menu.php'); ?>
       

        <!-------Main Content Starts--->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                
                <div class="col-4 text-center">

                    <?php  
                        //SQL query
                        $sql3 = "SELECT * FROM admin1";
                        //Execute query      
                        $res3 = mysqli_query($conn, $sql3);
                        //Count rows
                        $count3 = mysqli_num_rows($res3);              
                    
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Admin Access
                </div>

                <div class="col-4 text-center">

                    <?php  
                        //SQL query
                        $sql = "SELECT * FROM items";
                        //Execute query      
                        $res = mysqli_query($conn, $sql);
                        //Count rows
                        $count = mysqli_num_rows($res);              
                    
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Products
                </div>

                <div class="col-4 text-center">

                    <?php  
                        //SQL query
                        $sql2 = "SELECT * FROM tbl_order";
                        //Execute query      
                        $res = mysqli_query($conn, $sql2);
                        //Count rows
                        $count2 = mysqli_num_rows($res);              
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Total Orders
                </div>

                <div class="col-4 text-center">
                    <?php
                        //Create SQL Query to get Total revenue
                        //Aggregate function
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        //Execut query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the value
                        $row4 = mysqli_fetch_assoc($res4);

                        //Get the total revenue
                        $total_revenue = $row4 ['Total'];
                    ?>

                    <h1>RM <?php echo $total_revenue; ?></h1>
                    <br>
                    Revenue Growth
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>

        <!-------Main Content Ends--->

<?php include('partials/footer.php') ?>