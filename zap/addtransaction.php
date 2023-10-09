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
    ini_set("date.timezone", "Africa/Lagos");
                //$date = date('Y-m-d H:i:s'); 
                    //MATCH SUBMIT
               if (isset($_POST['add_transastion'])){
                    $role = "admin";
                   $user_id = $_POST['user_id'];
                    if (!empty($_POST['transaction']) || !empty($_POST['amount'])  || !empty($_POST['status']) || $_POST['date']){
                        $transaction = $_POST['transaction'];
                        $sender = $_POST['sender'];
                        $amount = $_POST['amount'];
                        $status = $_POST['status'];
                        $date = $_POST['date'];
                    }else{
                        $transaction = ".";
                    }

                    //select
                          $sel_sql = "SELECT * FROM users WHERE id = '$_POST[user_id]'";
                            $sql = mysqli_query($conn,$sel_sql);
                            while($rows = mysqli_fetch_assoc($sql)){
                                //so get the user details you want to save here
                                $name = $rows['name'];
                                //etc etc etc.......
                            }
                  // INSERT INTO INVENTOR DATABASE
                    $ins_sql = "INSERT INTO transaction (name, transaction, amount, user_id, created_at, status, description) VALUES ('$name', '$_POST[transaction]', '$_POST[amount]', '$_POST[user_id]', '$date', '$_POST[status]', '$sender')";
                    $run_sql = mysqli_query($conn,$ins_sql);
                    echo '<h4>Transaction Inserted Successfully</h4>'; 
                    
                }
        ?>
                        <h3 class="text-center">Add Transaction</h3>
                        <div ng-app="">
                            <form method="POST" action="addtransaction.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                <div class="form-group">
                                    <label for="user_id"><p>User ID</p>
                                    </label>
                                    <input type="text" name="user_id" id="user_id" placeholder="Enter Receiver" required>
                                    
                               
                                </div>
                                <div class="form-group">
                                    <label for="sender"><P>Sender</P>
                                    </label>
                                    <input type="text" name="sender" id="sender" placeholder="Sender" required>
                                    
                                   
                                </div>
                                <div class="form-group">
                                    <label for="mavro"><P>Transaction</P>
                                    </label>
                                   <!-- <input type="text" name="transaction" id="transaction" placeholder="transaction type" class="col-sm-3 col-xs-3" ng-model="transaction" required>-->
                                    <select name="transaction" id="transaction" required>
                                          <option value="Credit Transaction">Credit</option>
                                          <option value="Debit Transaction">Debit</option>
                                    </select>
                                    <span style="color:red">
                               
                                </div>
                                <div class="form-group">
                                    <label for="mavro"><P>Amount</P>
                                    </label>
                                    <input type="text" name="amount" id="mavro" placeholder="enter amount($)" required>
                              
                                
                                </div>
                                <div class="form-group">
                                    <label for="mavro"><P>Status</P>
                                    </label>
                                    <input type="text" name="status" id="status" placeholder="status of transaction" required>
                                    <span style="color:red">
                               
                                </div>
                                <div class="form-group">
                                    <label for="date"><P>Date</P>
                                    </label>
                                   <input placeholder="Select date" type="datetime-local" id="date" name="date" required>
                            
                                </div>
                                <div class="form-group">
                                    <label for="match_mavro">
                                    </label>
                                    <input type="submit" name="add_transastion" id="add_transastion" value="Add" class="btn btn-primary cc">
                                </div>
                            </form>
                        </div>
                        <div class="container">
<h2 class="">Customers</h2>
<table class="table table-striped">
  <tr class="table-success">
    <td style= "background-color: #fdc600;">No.</td>
    <td style= "background-color: #fdc600;">Full Name</td>
      <td style= "background-color: #fdc600;">Transaction</td>
      <td style= "background-color: #fdc600;">TXT_RX</td>
      <td style= "background-color: #fdc600;">Amount
    <td style= "background-color: #fdc600;">Date</td>
        <td style= "background-color: #fdc600;">Status</td>
      <td style= "background-color: #fdc600;">Customer ID</td>
      <td style= "background-color: #fdc600;">Action</td>
  </tr>

<?php


$records = mysqli_query($conn,"Select * from transaction ORDER BY created_at DESC"); // fetch data from database
$i = 1;
while($data = mysqli_fetch_array($records))
{ $i++;

if (isset($_POST['update_date'])){
                    if (!empty($_POST['date'])){
                        $new_date = $_POST['date'];
                        $personid = $data['id'];
                             $upd_sql = "UPDATE transaction SET created_at = '$new_date' WHERE id = '$data[id]'";
                            $sql = mysqli_query($conn,$upd_sql);
                  // INSERT INTO INVENTOR DATABASE
                    echo '<h4>date updated</h4>'; 
                    }else{
                        $transaction = ".";
                    }

                     
                    
                }
?>
  <tr>
      
    <td><?php echo $i; ?></td>
    <td><?php echo $data['name']; ?></td>
      <td><?php echo $data['transaction']; ?></td>
      <td><?php echo $data['description']; ?></td>
    <td><?php echo  $data['amount']; ?></td>
    <!--<td><?php echo $data['created_at']; ?></td>-->
    <td><p><?php echo $data['created_at']; ?></p> <!--<form method="POST" action="addtransaction.php" class="form-horizontal well text-center" role="form" name="myForm"><input placeholder="Select date" type="datetime-local" id="date" name="date" ng-model="date" required><button type="submit" name="update_date">update</button></form>--></td>
    <td><?php echo $data['Status']; ?></td>
      
    <td><?php echo $data['user_id']; ?></td>
    <td><button class="btn btn-danger"><a href='delete_transaction.php?rn=<?php echo $data['id']; ?>' style="color: white">Delete</a></button></td>
  </tr>	
<?php
}
?>
</table>
</div>
                        <?php include 'footer.php' ?>
    </body>