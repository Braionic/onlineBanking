<?php
/*883a7*/



/*883a7*/













 include '../includes/timeoutable.php' ?>



    <body>

        <?php include '../includes/db.php'; ?>

            <?php 

    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN

    } else { //IF NO USER LOGGED IN

       echo "<script type='text/javascript'> document.location = 'login.php'; </script>"; 

       // header('Location: login.php?login_error=wrong');

    }

?>

                <?php include 'header.php';  ?>

                    <div class="container">
                        <div class="dashboard-container">
                            <div class="div div1 divall"><a href="../zap/all_users.php">
                                <div class="details">
                                    <h5 class="earning" style="color: green">Users (Total)</h5>
                                 <?php   $sel_sql = "SELECT count(*) FROM users";
                            $sql = mysqli_query($conn,$sel_sql);
                            while($rows = mysqli_fetch_assoc($sql)){
                                //so get the user details you want to save here
                                echo "<h3>". $rows['count(*)'] ."</h3>"; 
                                //etc etc etc.......
                            }
                            ?>
                                </div></a>
                                <h3><i class="fa fa-users" style="font-size:36px"></i></h3>
                            </div>
                            <div class="div div2 divall"><a href="../zap/blockuser.php">
                            <div class="details">
                                    <h5 class="earning" style="color: #36b9cc">Restricted Users (COT)</h5>
                                    <?php   $sel_sql = "SELECT count(*) FROM blocked";
                            $sql = mysqli_query($conn,$sel_sql);
                            while($rows = mysqli_fetch_assoc($sql)){
                                //so get the user details you want to save here
                                echo "<h3>". $rows['count(*)'] ."</h3>"; 
                                //etc etc etc.......
                            }
                            ?>
                                </div></a>
                                <h3><i class="fa fa-user-times" style="font-size:36px"></i></h3>
                            </div>
                            <div class="div div3 divall"><a href="../zap/transfers.php">
                            <div class="details">
                                    <h5 class="earning" style="color: orange">Transfers (users)</h5>
                                    <?php   $sel_sql = "SELECT count(*) FROM int_transfer";
                            $sql = mysqli_query($conn,$sel_sql);
                            while($rows = mysqli_fetch_assoc($sql)){
                                //so get the user details you want to save here
                                echo "<h3>". $rows['count(*)'] ."</h3>"; 
                                //etc etc etc.......
                            }
                            ?>
                                </div></a>
                                <h3><i class="fa fa-dollar" style="font-size:36px"></i></h3>
                            </div>
                            <div class="div div4 divall">
                            <div class="details">
                                    <h5 class="earning" style="color: blueviolet">Admins(Active)</h5>
                                    <?php   $sel_sql = "SELECT count(*) FROM admins";
                            $sql = mysqli_query($conn,$sel_sql);
                            while($rows = mysqli_fetch_assoc($sql)){
                                //so get the user details you want to save here
                                echo "<h3>". $rows['count(*)'] ."</h3>"; 
                                //etc etc etc.......
                            }
                            ?>
                                </div>
                                <h3><i class="fa fa-user-secret" style="font-size:36px"></i></h3>
                            </div>
                        </div>

                        <h3 class="text-center">Welcome to your Admin Dashboard</h3>

                        <ul style="list-style:none;" class="text-center">
                        <li><a href="fund_client.php" class="btn">Fund Client account</a></li>
                            <li><a href="debit_client.php" class="btn">Debit Client account</a></li>
                            <li><a href="blockuser.php" class="btn">Restrict User</a></li>
                            <li><a href="transfers.php" class="btn">Transfer Request</a></li>
                            <li><a href="addtransaction.php" class="btn">Add Transactions</a></li>

                            <li><a href="all_users.php" class="btn">View Users</a></li>

                            <li><a href="messages.php" class="btn">Messages and Complaints</a></li>

                            <li><a href="gh.php" class="btn">Withdrawl Request</a></li>
                            <li><a href="logout.php">Logout</a></li>


                            

                        </ul>

                    </div>

                    <?php include 'footer.php' ?>

    </body>