<?php

include '../includes/timeoutable.php' ?>



<body style="background-color: rgba(100, 100, 100, 0.1);">

    <?php include '../includes/db.php'; ?>
    <style>
        .top-bar {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
        }

        .main-wrapper {
            background-color: rgba(100, 100, 100, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 90vh;
            padding: 20px;
            margin-top: 30px;
        }
    </style>

    <?php

   if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN

   } else { //IF NO USER LOGGED IN

       echo "<script type='text/javascript'> document.location = 'login.php'; </script>";

       // header('Location: login.php?login_error=wrong');

   }

?>

    <?php include 'header.php';  ?>
    <div class="main-wrapper">
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
                    <button class="btn btn-xs btn-danger"
                        style="margin-top: 10px; border-radius: 18px; padding: 5px 16px; margin-bottom: 0px;"
                        onclick="handleShow()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                            <path
                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                        </svg> Fund or Debit</button>

                    <div id="trans" style="display: none; position: absolute; bottom: -37px; left: 10px;">
                        <a href="fund_client.php"><button class="btn btn-sm btn-primary">Fund Client</button></a>
                        <a href="debit_client.php"><button class="btn btn-sm btn-primary">Debit Client</button></a>
                    </div>
                    <a href="create_account.php"><button class="btn btn-sm btn-danger"
                            style="margin-top: 10px; border-radius: 18px; padding: 5px 16px"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            </svg> Create Customer</button></a>
                </div>
            </div>
            <div class="dashboard-container" style="background-color: rgba(100, 100, 100, 0.0);">

                <div class="div div1 divall" style="background-color: red;"><a href="../zap/all_users.php">
                        <div class="details">
                            <h5 class="earning" style="color: white;">Users (Total)</h5>
                            <?php   $sel_sql = "SELECT count(*) FROM users";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3 style='color: white'>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                        </div>
                    </a>
                    <h3><i class="fa fa-users" style="font-size:36px"></i></h3>
                </div>
                <div class="div div2 divall" style="background-color: red;"><a href="../zap/blockuser.php">
                        <div class="details">
                            <h5 class="earning" style="color: white">Restricted Users (COT)</h5>
                            <?php   $sel_sql = "SELECT count(*) FROM blocked";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3 style='color: white'>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                        </div>
                    </a>
                    <h3><i class="fa fa-user-times" style="font-size:36px"></i></h3>
                </div>
                <div class="div div3 divall" style="background-color: red;"><a href="../zap/transfers.php">
                        <div class="details">
                            <h5 class="earning" style="color: white">Transfers (users)</h5>
                            <?php   $sel_sql = "SELECT count(*) FROM int_transfer";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3 style='color: white'>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                        </div>
                    </a>
                    <h3><i class="fa fa-dollar" style="font-size:36px"></i></h3>
                </div>
                <div class="div div4 divall" style="background-color: red;">
                    <div class="details">
                        <h5 class="earning" style="color: white">Admins(Active)</h5>
                        <?php   $sel_sql = "SELECT count(*) FROM admins";
$sql = mysqli_query($conn, $sel_sql);
while($rows = mysqli_fetch_assoc($sql)) {
    //so get the user details you want to save here
    echo "<h3 style='color: white'>". $rows['count(*)'] ."</h3>";
    //etc etc etc.......
}
?>
                    </div>
                    <h3><i class="fa fa-user-secret" style="font-size:36px"></i></h3>
                </div>
            </div>
            <h4 class="text-center">Customers Transactions</h4>
            <div class="transaction-container" style="background-color: white; border-radius: 10px; margin-top: 30px;">
                <table class="table" style="table-layout: fixed; width: 100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th style="font-weight: normal;"> User:</th>
                            <th style="font-weight: normal;">Amount:</th>
                            <th style="font-weight: normal;">TXN:</th>
                            <th style="font-weight: normal;">Date:</th>
                            <th style="font-weight: normal;">Action:</th>
                            <th style="font-weight: normal;">Status:</th>
                    </thead>
                    <tbody style="color: rgba(100,100,100, 1);">
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
                        <td style="font-size: 15px;">
                            <?php echo $rows['name']; ?>
                        </td>
                        <td style="">
                            <?php echo $rows2['currency'].number_format($rows['amount']); ?>
                        </td>

                        <?php if($rows['transaction'] == 'Credit') {
                            echo '<td style="color: green; font-weight: 600; font-size: 15px" class="text-center">';
                        } else {
                            echo '<td class="text-danger text-center" style="font-weight: normal; font-size: 15px" class="">';
                        } ?> <?php echo $rows['transaction'];
        
        ?>

                        </td>
                        <td style="font-size: 14px">
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
                                        class="btn btn-xs btn-success" style="margin: 3px;">Accept</button></a><a
                                    href='reject_transaction.php?id=<?php echo $rows["id"] ?>'><button
                                        onclick="return confirm('reject transaction?')"
                                        class="btn btn-xs btn-danger">Reject</button></a>
                            </div>
                            <?php
                               } else {
                                   echo"<div style='font-size: 14px; color: green; border-radius: 10%; width: 90px;'><p>Finalised</p></div>";
                               }

        ?>
                        </td>
                        <?php if($rows['Status'] == 'Success') {
                            echo '<td class="text-right txt" style="color: green; font-weight: 600;">';
                        } else {
                            echo '<td class="text-warning text-right txt" style="font-weight: normal">';
                        } ?> <?php echo $rows['Status'] == "reversed"? "rvsd": "succ";
        $i++;
    }
}
?></td>
                        <br>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

</body>