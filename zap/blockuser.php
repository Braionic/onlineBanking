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
                    //MATCH SUBMIT
               if (isset($_POST['block_user'])){
                    $role = "admin";
                   $user_id = $_POST['user_id'];
                    if (!empty($_POST['status'])){
                        $status = $_POST['status'];
                    }else{
                        $status = ".";
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
                    $ins_sql = "INSERT INTO blocked (firstname, user_id, status) VALUES ('$name', '$_POST[user_id]', '$status')";
                    $run_sql = mysqli_query($conn,$ins_sql);
                    echo '<h4 style="color:white">user successfully placed on dormancy</h4>'; 
                    
                }
        ?>
                        <h3 class="text-center">Block user</h3>
                        <div ng-app="">
                            <form method="POST" action="blockuser.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" style="color: white;" for="user_id">Receiver
                                    </label>
                                    <input type="text" name="user_id" id="user_id" placeholder="Enter Receiver" class="col-sm-3 col-xs-3" ng-model="user_id" required>
                                    <span style="color:red" ng-show="myForm.user_id.$touched && myForm.user_id.$invalid">
                                <span ng-show="myForm.user_id.$error.required">Receiver Id is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" style="color: white;" for="status">Status
                                    </label>
                                    <input type="text" name="status" id="status" placeholder="enter Status" class="col-sm-3 col-xs-3" ng-model="status" required>
                                    <span style="color:red" ng-show="myForm.status.$touched && myForm.status.$invalid">
                                <span ng-show="myForm.status.$error.required">status is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6" for="match_status">
                                    </label>
                                    <input type="submit" name="block_user" id="block_user" value="block_user" class="btn btn-primary cc" class="col-sm-6 col-xs-6">
                                </div>
                            </form>
                        </div>
                        <?php include 'footer.php' ?>
    </body>