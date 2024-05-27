<?php include 'includes/timeoutable.php' ?>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    //  header('Location: panel.php');
} else { //IF NO USER LOGGED IN
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
?>


<?php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <style>
    .main-wrapper {
      background-color: rgba(100, 100, 100, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 90vh;
      padding: 20px;
      margin-top: 30px;
    }

    .top-bar {
      margin-top: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px
    }

    .name-bar {
      margin-top: 20px;
      padding: 10px;
    }

    .details-div {
      background-color: white;
      padding: 20px 10px;
      box-shadow: 0px 0px 2px;
      flex-grow: 1;
      border-radius: 12px;
    }

    .details-div>p {
      margin-bottom: 0px;
    }

    .acct-details>.acct-num>.act-num {
      margin-bottom: 0px;
    }

    .act-num {
      font-weight: 600;
    }

    th {
      background-color: aqua;
    }


    @media (max-width: 500px) {
      .acct-num-container {
        display: none;
      }
    }

    @media (min-width: 600px) {
      .acct-num-container {
        left: 60px;
      }

    }
  </style>
</head>

<body>

  <!--format the "available balance" currency-->
  <?php
   $my_sql3 = "SELECT * FROM users WHERE id = '$_SESSION[id]' ORDER BY id DESC";
$run_sql3 = mysqli_query($conn, $my_sql3);
while($rows = mysqli_fetch_assoc($run_sql3)) {
    if($rows["currency"] == "$") {
        $curr = "USD";
    } elseif ($rows["currency"] == "£") {
        $curr = "GBP";
    } else {
        $curr = "EURO";
    }
}
?>

  <!-- summed up the total transaction amount in the user dashboard -->
  <?php
$sql = "SELECT SUM(amount) FROM transaction WHERE user_id = '$_SESSION[id]'";
$sql_query = mysqli_query($conn, $sql);
if(mysqli_num_rows($sql_query) > 0) {
    while($rows = mysqli_fetch_array($sql_query)) {
        $total_t_volume = $_SESSION['currency'].number_format($rows['SUM(amount)'], 2);
        
    }
}
//summed up the total pending transaction amount in the user dashboard
$sql2 = "SELECT SUM(amount) FROM transaction WHERE (user_id = '$_SESSION[id]' AND Status = 'pending')";
$sql_query2 = mysqli_query($conn, $sql2);
if(mysqli_num_rows($sql_query2) > 0) {
    while($rows = mysqli_fetch_array($sql_query2)) {
        $total_t_pending = $_SESSION['currency'].number_format($rows['SUM(amount)'], 2);
    }
}
?>
  <?php include("header2.php") ?>
  <div style="height:23px;"></div>
  <div class="main-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php
                      if(isset($_GET['imf_correct'])) {
                          echo '<div class="alert alert-success text-center alert-dismissable" style="margin-top: 25px">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     <strong>Payment sent!</strong><br> Thank you for chosing <b>HSBC</b></div>';
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
                style="margin-top: 10px; border-radius: 18px; padding: 5px 16px"><svg xmlns="http://www.w3.org/2000/svg"
                  width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                  <path
                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                </svg> Cash
                Top
                Up</button>
              <button class="btn btn-sm btn-primary"
                style="margin-top: 10px; border-radius: 18px; padding: 5px 16px; margin-bottom: 0px;"
                onclick="handleShow()">Pay & Transfer</button>
              <div id="trans" style="display: none; position: absolute; bottom: -37px; right: 15px;">
                <a href="intrabank.php"><button class="btn btn-sm btn-primary">Local</button></a>
                <a href="pay-and-transfer.php"><button class="btn btn-sm btn-primary">Non-HSBC</button></a>
              </div>
            </div>
          </div>
          <div class="price-container rounded-3 btn-primary"
            style="border-radius: 13px; padding: 10px; position: relative; margin-top: 15px;">
            <div class=" avatar rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
              <?php
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$_SESSION[id]'") or die('query failed');
if(mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
    ?><?php
    if($fetch['image'] == '') {
        echo '<img src="./images/client2.png" class="img-fluid" style="width: 40px; height: 40px;">';
    } else {
        echo '<img src="uploaded_img/'.$fetch['image'].'" alt="profile pic" class="img-fluid" style="width: 40px; height: 40px;">';
    }
}?>

            </div>
            <div class="price text-center" style="margin-bottom: 40px">
              <p class="" style="font-weight: 600;">Available Balance</p>
              <h4><?php
                                 $my_sql = "SELECT * FROM users WHERE id = '$_SESSION[id]' ORDER BY id DESC";
$run_sql = mysqli_query($conn, $my_sql);
while($rows = mysqli_fetch_assoc($run_sql)) {
    echo '<h4 class="balance" style="color: white; font-size: 20px; font-weight: bold">'.$rows['currency'].'
                              '.number_format($rows['amount'], 2).' '.$curr.'</h4>
  ';
}
?></h4>
            </div>
            <div class="acct-num-container"
              style="background-color: white;border-radius: 13px; padding: 10px; position: absolute; bottom: -40px; right: 60px; margin-left: auto; margin-right: auto;">
              <div class="panell" style="display: flex; align-items: center; justify-content: space-between; ">

                <div class="acct-details"
                  style="color: black; display: flex; align-items: center; justify-content: center; gap: 4px;">

                  <div> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                      class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                      <path
                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                    </svg></div>
                  <div class="acct-num" style="display:flex; justify-content: center; flex-direction: column;">
                    <p class="act-num o">Your Account Number</p>
                    <?php
                                 $my_sql = "SELECT * FROM users WHERE id = '$_SESSION[id]' ORDER BY id DESC";
$run_sql = mysqli_query($conn, $my_sql);
while($rows = mysqli_fetch_assoc($run_sql)) {
    echo '<p class="o">'.$rows['act_no'].'</p>
  ';
}
?></p>
                  </div>
                </div>
                <div style="display: flex; align-items: center; justify-content: end"><a
                    href="all-transactions.php"><button class="btn btn-sm bg-primary"
                      style="margin-right: 3px;">Transactions</button></a><button class="btn btn-sm bg-primary">Live
                    chat</button></div>
              </div>
            </div>
          </div>
          <div class="dashboard-details"
            style="margin-top: 60px; display: flex; align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap">
            <div class="details-div limit">
              <p>
                Transaction Limit
              </p>
              <p style="font-size: 11px">Your current transaction limit</p>
              <p style="font-size: 17px; font-weight: bold">$500,000.00</p>
            </div>
            <div class="details-div pending">
              <p>
                Pending Transaction
              </p>
              <p style="font-size: 11px">Your pending transaction</p>
              <p style="font-size: 17px; font-weight: bold">
                <?php echo $total_t_pending;  ?>
              </p>
            </div>
            <div class="details-div volume">
              <p>
                Transaction Volume
              </p>
              <p style="font-size: 11px">Total volume of transaction made</p>
              <p style="font-size: 17px; font-weight: bold">
                <?php echo $total_t_volume?>
              </p>
            </div>
          </div>
          <div class="transaction-container" style="background-color: white; border-radius: 10px; margin-top: 30px;">
            <table class="table">
              <thead>
                <tr>
                  <th>NO</th>
                  <th style="font-weight: normal;"> Transaction:</th>
                  <th style="font-weight: normal;">Amount:</th>
                  <th style="font-weight: normal;">Date:</th>
                  <th style="font-weight: normal;">Status:</th>
              </thead>
              <tbody style="color: rgba(100,100,100, 1)">
                <?php
              $i = 1;
$my_sql = "SELECT * FROM transaction WHERE user_id = '$_SESSION[id]' ORDER BY id DESC LIMIT 10";
$run_sql = mysqli_query($conn, $my_sql);
while($rows = mysqli_fetch_assoc($run_sql)) {
    $sql = "SELECT * FROM users where id = '$_SESSION[id]'";
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
                  <?php echo $rows['created_at']; ?>
                </td>
                <?php if($rows['Status'] == 'Successful') {
                    echo '<td style="color: green; font-weight: 600;" class="">';
                } else {
                    echo '<td class="text-warning" style="font-weight: normal" class="">';
                } ?> <?php echo $rows['Status'];
        $i++;
    }
}
?></td><br>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("footer.php") ?>
</body>

</html>