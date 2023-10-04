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
                if (isset($_POST['match_submit'])){
                    $role = "admin";
                    if (!empty($_POST['rematch'])){
                        $remacth = $_POST['rematch'];
                    }else{
                        $remacth = ".";
                    }
                  // INSERT INTO INVENTOR DATABASE
                    $ins_sql = "INSERT INTO matches (rematch, provider_id, receiver_id, amount, confirm, created_at) VALUES ('$remacth', '$_POST[provider]', '$_POST[receiver]', '$_POST[amount]', 'pending', '$date')";
                    $run_sql = mysqli_query($conn,$ins_sql);
                    echo '<h4 style="color:white">Successfully Matched</h4>'; 
                    
                }
        ?>
                        <h3 class="text-center">Match Users</h3>
                        <div ng-app="">
                            <form method="POST" action="new_match.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="rematch">Rematch?
                                    </label>
                                    <input type="radio" name="rematch" value="Rematched" id="rematch" class="col-sm-3 col-xs-3">
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="provider">Provider
                                    </label>
                                    <input type="text" name="provider" id="provider" placeholder="Enter Provider" class="col-sm-3 col-xs-3" ng-model="provider" required>
                                    <span style="color:red" ng-show="myForm.provider.$touched && myForm.provider.$invalid">
                                <span ng-show="myForm.provider.$error.required">Provider Id is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="col-sm-6 col-xs-6">Amount</label>
                                    <select class="col-sm-3 col-xs-3" name="amount" id="amount" required>
                                        <option value=" " selected>Select amount</option>
                                        <option value="5,000naira">5,000naira</option>
                                        <option value="10,000naira">10,000naira</option>
                                        <option value="20,000naira">20,000naira</option>
                                        <option value="30,000naira">30,000naira</option>
                                        <option value="40,000naira">40,000naira</option>
                                        <option value="50,000naira">50,000naira</option>
                                        <option value="100,000naira">100,000naira</option>
                                        <option value="150,000naira">150,000naira</option>
                                        <option value="200,000naira">200,000naira</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="receiver">Receiver
                                    </label>
                                    <input type="text" name="receiver" id="receiver" placeholder="Enter Receiver" class="col-sm-3 col-xs-3" ng-model="receiver" required>
                                    <span style="color:red" ng-show="myForm.receiver.$touched && myForm.receiver.$invalid">
                                <span ng-show="myForm.receiver.$error.required">Receiver Id is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6" for="match_submit">
                                    </label>
                                    <input type="submit" name="match_submit" id="match_submit" value="Match" class="btn btn-primary cc" class="col-sm-6 col-xs-6">
                                </div>
                            </form>
                        </div>
                        <?php include 'footer.php' ?>
    </body>