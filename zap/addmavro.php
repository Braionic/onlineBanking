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
                $date = date('Y-m-d H:i:s'); 
                    //MATCH SUBMIT
               if (isset($_POST['match_mavro'])){
                    $role = "admin";
                   $user_id = $_POST['user_id'];
                    if (!empty($_POST['mavro']) || !empty($_POST['mavro2'])){
                        $mavro = $_POST['mavro'];
                        $mavro2 = $_POST['mavro'];
                    }else{
                        $mavro = ".";
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
                  $mavro = $_POST['mavro'];
                  $mavro2 = $_POST['mavro2'];
                    $ins_sql = "INSERT INTO mavro (name, mavro, mavro2, user_id, created_at) VALUES ('$name', '$mavro', '$mavro2', '$_POST[user_id]', '$date')";
                    $run_sql = mysqli_query($conn,$ins_sql);
                    echo '<div class="success alert-success text-center">
                    User wallet has been funded<strong>successfully</strong> to trade.
                  </div'; 
                    
                }
        ?>
       <?php
                      if(isset($_GET['deleted'])) {
                     echo '<div class="alert alert-danger text-center alert-dismissable">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     <strong>User ballance has been cleared successfully!</strong></div>';
                        }
                        ?>
                        <h3 class="text-center">Fund account</h3>
                        <div ng-app="">
                            <form method="POST" action="addmavro.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="user_id"><p>Receiver ID</p>
                                    </label>
                                    <input type="text" name="user_id" id="user_id" placeholder="Enter Receiver" class="col-sm-3 col-xs-3" ng-model="user_id" required>
                                    <span style="color:red" ng-show="myForm.user_id.$touched && myForm.user_id.$invalid">
                                <span ng-show="myForm.user_id.$error.required"><P>Receiver Id is required.</P></span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="mavro"><P>Amount in Dollars</P>
                                    </label>
                                    <input type="text" name="mavro" id="mavro" placeholder="enter amount($)" class="col-sm-3 col-xs-3" ng-model="mavro" required>
                                    <span style="color:red" ng-show="myForm.mavro.$touched && myForm.mavro.$invalid">
                                <span ng-show="myForm.mavro.$error.required">Amount is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="mavro"><P>Amount in Bitcoin</P>
                                    </label>
                                    <input type="text" name="mavro2" id="mavro2" placeholder="enter amount(B)" class="col-sm-3 col-xs-3" ng-model="mavro2" required>
                                    <span style="color:red" ng-show="myForm.mavro.$touched && myForm.mavro.$invalid">
                                <span ng-show="myForm.mavro.$error.required">Amount is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6" for="match_mavro">
                                    </label>
                                    <input type="submit" name="match_mavro" id="match_mavro" value="FUND" class="btn btn-primary cc" class="col-sm-6 col-xs-6">
                                </div>
                            </form>
                        </div>
                        
<div class="container">
<h2 class="">USERS Wallets</h2>
<table class="table table-striped">
  <tr>
    <td>Sr.No.</td>
    <td>Full Name</td>
    <td>USD</td>
    <td>BTC</td>
    <td>Delete</td>
  </tr>

<?php


$records = mysqli_query($conn,"select * from mavro ORDER BY user_id DESC"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['user_id']; ?></td>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['mavro']; ?></td>
    <td><?php echo $data['mavro2']; ?></td>   
    <td class="btn btn-warning"><a href="delete.php?Del=<?php echo $data['ID']; ?>">Delete</a></td>
  </tr>	
<?php
}
?>
</table>
</div>

                        <?php include 'footer.php' ?>
    </body>