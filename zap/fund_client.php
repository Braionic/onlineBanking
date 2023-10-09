<?php include '../includes/timeoutable.php' ?>

    <body>
        <?php include '../includes/db.php'; ?>
            <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
      //  header('Location: login.php?login_error=wrong');
    }
?>
                <?php include 'header.php';  ?>
                    <?php 
    ini_set("date.timezone", "Europe/London");
                $date = date('Y-m-d H:i:s'); 
                    //MATCH SUBMIT
               if (isset($_POST['fund_client'])){
                    $role = "admin";
                   $amount = $_POST['amount'];
                   $details = $_POST['details'];
                   $user_id = $_POST['user_id'];
                    if (!empty($_POST['amount'])){
                        
                    }else{
                        $amount = ".";
                    }
                    //select
                          $sel_sql = "SELECT * FROM users WHERE id = '$_POST[user_id]'";
                            $sql = mysqli_query($conn,$sel_sql);
                            while($rows = mysqli_fetch_assoc($sql)){
                                //so get the user details you want to save here
                                $name = $rows['name'];
                                $d_amount = $rows['amount'];
                                $amount2 = $d_amount+=$amount;
                                $email = $rows['email'];
                                $currency = $rows['currency'];
                                $date2 = $rows['am_updated'];
                                $act_no = $rows['act_no'];
                                $newact = substr_replace($act_no, '*****', 6, 4);
                                $account = $rows['account'];
                                //etc etc etc.......
                            }
                   $sel_sql1 = "SELECT * FROM transaction WHERE id = '$_POST[user_id]'";
                            $sql1 = mysqli_query($conn,$sel_sql1);
                   if(mysqli_num_rows($sql1) >= 0){
                       $ins_sql = "INSERT INTO transaction (name, transaction, amount, description, user_id, created_at, status) VALUES ('$name', 'Credit', '$currency $amount', '$details', '$_POST[user_id]', '$date', 'Successful')";
                    $run_sql = mysqli_query($conn,$ins_sql);
                   }
                   if($d_amount >= 0){
                  // INSERT INTO INVENTOR DATABASE
                    $upd_sql = "UPDATE users SET  amount='$amount2', am_updated= '$date' WHERE id = '$_POST[user_id]'";
                    $run_sql = mysqli_query($conn,$upd_sql);
                      $to = $email; // this is your Email address
                $from = "no-reply@mycdfb.com"; // this is the sender's Email address
                $first_name = $name;
           
                $subject2 = "[Credit: ".$currency . $amount . "]";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset= ISO-8859-1' . "\r\n";
                $message = '<html><body>';
                    $message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/pK6BfqV/CDFBank-Logo-Original-5000x5000-2-3.png" alt="cDFB" class="logo">';
                       $message .= '<div  style="background-color: #f3f3f3;">';
                       $message .= '<h3 style="text-align: left;">Dear '.$first_name.'</h3>';
                       $message .= "<h4 style='color:#071d49;'>Your account has been credited with</4>";
                       $message .= '<h1 style="color:#080;font-size:18px;"> '.$currency .$amount.'.00</h1>';
                       $message .= '<h3>Transaction Summary</h3>';
                       //$message .= '<p><b>IBAN:</b> '.$newact.' <br><b>Account type:</b> '.$account.'<br></p>';
                       $message .= '<p><b>Account Name:</b> '. $name .'<br><b>Transaction Branch:</b> Head Office<br><b>Transaction Date:</b> ' .$date.'<br></p>';
                      $message .= '<p><b>Transaction Amount:</b> '.$currency .$amount.'.00<br><b>Available Balance:</b> ' .$currency . $amount2 .'.00</p>';
                       $message .= '<h4>Your balance at the time of this transaction is <strong>' .$currency . $amount2 .'.00</strong> Thank you for chosing CDFBank</h4>';
                       $message .= '<div style="background-color: #007eae; color: white;"><a href="https://www.mycdfb.com">CDFBank!</a> Always giving you extra. Get a little extra help from the <a href="https://www.mycdfb.com">CDFBank</a>.</div>';
$message .= '</div></div></body></html>';
                      $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
                mail($to,$subject2,$message,$headers); 
                    echo '<div class="success alert-success text-center">
                    Customer account has been updated <strong>successfully</strong>
                  </div'; 
                    
                }
               }
        ?>
       <?php
                      if(isset($_GET['deleted'])) {
                     echo '<div class="alert alert-danger text-center alert-dismissable">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     <strong>User ballance has been cleared successfully!</strong></div>';
                        }
                        ?>
                        <h2 class="text-center">Fund Client</h2>
                        <div ng-app="">
                            <form method="POST" action="fund_client.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                <div class="form-group">
                                    <label for="user_id"><p>Customer ID</p>
                                    </label>
                                    <input type="text" name="user_id" id="user_id" placeholder="Enter Receiver" required>
                                    
                          
                                </div>
                                <div class="form-group">
                                    <label for="amount"><P>Amount</P>
                                    </label>
                                    <input type="text" name="amount" id="amount" placeholder="enter amount"required>
                                   
                                
                                </div>
                                <div class="form-group">
                                    <label for="amount"><P>Description</P>
                                    </label>
                                    <textarea id="details" name="details" rows="4" cols="50">
                                        </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="match_amount">
                                    </label>
                                    <input type="submit" name="fund_client" id="fund_client" value="Fund" style= "background-color: #007eae; color: white;" class="btn cc" class="col-sm-6 col-xs-6">
                                </div>
                            </form>
                        </div>
                        
<div class="container">
<h2 class="">Customers</h2>
<table class="table table-striped">
  <tr class="table-success">
    <td style= "background-color: #fdc600;">No.</td>
    <td style= "background-color: #fdc600;">Profile</td>
    <td style= "background-color: #fdc600;">Full Name</td>
      <td style= "background-color: #fdc600;">Email</td>
      <td style= "background-color: #fdc600;">Password</td>
      <td style= "background-color: #fdc600;">Account Type</td>
    <td style= "background-color: #fdc600;">Amount</td>
    <td style= "background-color: #fdc600;">Last Updated</td>
      <td style= "background-color: #fdc600;">Customer ID</td>
  </tr>

<?php


$records = mysqli_query($conn,"Select * from users ORDER BY am_updated DESC"); // fetch data from database
$i = 1;
while($data = mysqli_fetch_array($records))
{ $i++;
?>
  <tr>
      
    <td><?php echo $i; ?></td>
    <?php
    if($data['image'] == ''){
                    echo '<td><img src="https://i.ibb.co/18PZkVk/tymebank-thumbnail-05-1080x1080-1.jpg" class="jarallax-img" alt="profile pic" style="max-width: 40px; max-height: 40px;"></td>';
                 }else{
                    echo '<td><img src="../uploaded_img/'.$data['image'].'" alt="profile pic" style="max-width: 40px; max-height: 40px;"></td>';
                 }
                 ?>
    <td><?php echo $data['name']; ?></td>
      <td><?php echo $data['email']; ?></td>
      <td><?php echo $data['password']; ?></td>
      <td><?php echo $data['account']; ?></td>
    <td><?php echo $data['currency']. $data['amount']; ?></td>
    <td><?php echo $data['am_updated']; ?></td>
      
    <td><?php echo $data['id']; ?></td>
  </tr>	
<?php
}
?>
</table>
</div>

                        <?php include 'footer.php' ?>
    </body>