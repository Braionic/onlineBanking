<?php

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
        <?php
if(isset($_GET['message']) && $_GET['message'] ==  'transaction_reversed') {
    echo '<div class="alert alert-warning text-center alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>transaction has been reversed!</strong></div>';
}
?>


        <div class="top-bar">
            <div class="name-bar">
                Welcome <span class="fw-bold ">
                    <?php echo $_SESSION['name'] ?>,
                </span>
                <p class="" style="font-size: 11px">What would you like to do today</p>
            </div>
            <div class="right-util"
                style="display: flex; align-items: center; justify-content: end; gap: 3px; position: relative;">
                <button class="btn btn-sm btn-primary"
                    style="margin-top: 10px; border-radius: 18px; padding: 5px 16px; margin-bottom: 0px;"
                    onclick="handleShow()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                        <path
                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                    </svg> Fund or Debit Customer</button>

                <div id="trans" style="display: none; position: absolute; bottom: -37px; left: 10px;">
                    <a href="fund_client.php"><button class="btn btn-sm btn-primary">Fund Client</button></a>
                    <a href="debit_client.php"><button class="btn btn-sm btn-primary">Debit Client</button></a>
                </div>
                <a href="all_users.php"><button class="btn btn-sm btn-primary"
                        style="margin-top: 10px; border-radius: 18px; padding: 5px 16px"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                            <path
                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                        </svg> All Customers</button></a>
            </div>
        </div>
        <div class="dashboard-container">

            <div class="div div1 divall"><a href="../zap/all_users.php">
                    <div class="details">
                        <h5 class="earning" style="color: green">Users (Total)</h5>
                        <?php   $sel_sql = "SELECT count(*) FROM users";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                    </div>
                </a>
                <h3><i class="fa fa-users" style="font-size:36px"></i></h3>
            </div>
            <div class="div div2 divall"><a href="../zap/blockuser.php">
                    <div class="details">
                        <h5 class="earning" style="color: #36b9cc">Restricted Users (COT)</h5>
                        <?php   $sel_sql = "SELECT count(*) FROM blocked";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                    </div>
                </a>
                <h3><i class="fa fa-user-times" style="font-size:36px"></i></h3>
            </div>
            <div class="div div3 divall"><a href="../zap/transfers.php">
                    <div class="details">
                        <h5 class="earning" style="color: orange">Transfers (users)</h5>
                        <?php   $sel_sql = "SELECT count(*) FROM int_transfer";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                    </div>
                </a>
                <h3><i class="fa fa-dollar" style="font-size:36px"></i></h3>
            </div>
            <div class="div div4 divall">
                <div class="details">
                    <h5 class="earning" style="color: blueviolet">Admins(Active)</h5>
                    <?php   $sel_sql = "SELECT count(*) FROM admins";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                </div>
                <h3><i class="fa fa-user-secret" style="font-size:36px"></i></h3>
            </div>
        </div>
        <h3 class="text-center">Customers Transactions</h3>
        <div class="transaction-container" style="background-color: white; border-radius: 10px; margin-top: 30px;">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th style="font-weight: normal;"> Transaction:</th>
                        <th style="font-weight: normal;">Amount:</th>
                        <th style="font-weight: normal;">Customer ID:</th>
                        <th style="font-weight: normal;">Date:</th>
                        <th style="font-weight: normal;">Action:</th>
                        <th style="font-weight: normal;">Status:</th>
                </thead>
                <tbody style="color: rgba(100,100,100, 1)">
                    <?php
              $i = 1;
$my_sql = "SELECT * FROM transaction ORDER BY created_at DESC";
$run_sql = mysqli_query($conn, $my_sql);
while($rows = mysqli_fetch_assoc($run_sql)) {
    $sql = "SELECT * FROM users WHERE id='$rows[user_id]'";
    $sql_query2 = mysqli_query($conn, $sql);
    while($rows2 = mysqli_fetch_assoc($sql_query2)) {
        ?>
                    </tr>
                    <td><?php echo $i  ?></td>
                    <td style="">
                        <?php echo $rows['transaction']; ?>
                    </td>
                    <td style="">
                        <?php echo $rows2['currency'].$rows['amount']; ?>
                    </td>
                    <td style="">
                        <?php echo $rows['user_id']; ?>
                    </td>
                    <td style="">
                        <?php echo $rows['created_at']; ?>
                    </td>
                    <td style="">
                        <?php
                       if($rows['Status'] !== 'Success' && $rows['Status'] !== 'reversed') {
                           ?>
                        <div>
                            <a
                                href='accept_transaction.php?id=<?php echo $rows["id"] ?>'><button
                                    onclick=" return confirm('Do you want to accept this transaction')"
                                    class="btn btn-success" style="margin: 3px;">Accept</button></a><a
                                href='reject_transaction.php?id=<?php echo $rows["id"] ?>'><button
                                    onclick="return confirm('reject transaction?')"
                                    class="btn btn-danger">Reject</button></a>
                        </div>
                        <?php
                       } else {
                           echo"<div style='background-color: green; color: white; border-radius: 10%; width: 90px; text-align: center; padding: 0px;'><p style=''>Finalised</p></div>";
                       }

        ?>
                    </td>
                    <?php if($rows['Status'] == 'Success') {
                        echo '<td style="color: green; font-weight: 600;" class="">';
                    } else {
                        echo '<td class="text-warning" style="font-weight: normal" class="">';
                    } ?> <?php echo $rows['Status'];
        $i++;
    }
}
?></td>
                    <br>
                </tbody>
            </table>
        </div>
        <ul style="list-style:none;" class="text-center">
            <li><a href="create_account.php" class="btn">Create an Account</a></li>
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