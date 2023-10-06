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

                        <h3 class="text-center">Welcome to the Admin Dashboard</h3>

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