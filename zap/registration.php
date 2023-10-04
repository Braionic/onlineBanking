<?php include '../includes/timeoutable.php' ?>
<body>
    <?php include '../includes/db.php'; ?>
            <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
   //     header('Location: index.php');
    } else { //IF NO USER LOGGED IN
    }
?>
                <?php include 'header.php'; ?>
                    <?php 
                $date = date('Y-m-d H:i:s'); 
                    //INVENTOR SUBMIT
                if (isset($_POST['register_submit'])){
                    $password = $_POST['password'];
                    $c_password = $_POST['c_password'];
                    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                    $name = $_POST['name'];
                    $name = mysqli_real_escape_string($conn,$name);
                    $role = "admin";
                    if($password == $c_password){ //CHECK IF PASSWORDS MATCH
                  // INSERT INTO INVENTOR DATABASE
                    $ins_sql = "INSERT INTO admins (name, email, password, confirm_password, created_at, role) VALUES ('$name', '$email', '$password', '$c_password', '$date', '$role' )";
                    $run_sql = mysqli_query($conn,$ins_sql);
                    echo '<h4>Admin Registered Successfully</h4>';
                      if ($role == 'admin'){
                        echo '<p>Admin registered succesfully</p>';
                           echo "<script type='text/javascript'> document.location = 'login.php?registered'; </script>"; 
                   //       header('Location: login.php?registered');
                    }
                } else { //OUTPUT IF PASSWORDS DONT MATCH
                        echo '<p style="color:red;">Passwords do not match</p>';
                    }
            }
        ?>

                        <div style="height:30px;"></div>
                        <div ng-app="" class="container">
                            <h2>Admin Signup</h2>
                            <form class="form form-horizontal" action="registration.php" method="POST" enctype="multipart/form-data" role="form" name="myForm" id="feedbackform">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3">Full Name <span class="glyphicon glyphicon-pencil"></span></label>
                                    <input type="text" class="col-sm-5 form-control" id="name" name="name" placeholder="Type Full Name" ng-model="name" required>
                                    <span style="color:red" ng-show="myForm.name.$dirty && myForm.name.$invalid">
                <span ng-show="myForm.name.$error.required">Username is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-3">Email <span class="glyphicon glyphicon-envelope"></span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Type Email" ng-model="email" required>
                                    <span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
                            <span ng-show="myForm.email.$error.required">Email is required.</span>
                                    <span ng-show="myForm.email.$error.email">Invalid email bank.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3">Password <span class="glyphicon glyphicon-qrcode"></span></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Type password" ng-model="password" required>
                                    <span style="color:red" ng-show="myForm.password.$dirty && myForm.password.$invalid">
                <span ng-show="myForm.password.$error.required">Password is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="c_password" class="col-sm-3">Confirm Password <span class="glyphicon glyphicon-qrcode"></span></label>
                                    <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Re-type Password">
                                </div>
                                <div class="form-group">
                                    <label for="submit" class="col-sm-3"></label>
                                    <input type="submit" class="form-control btn btn-info" id="submit" name="register_submit">
                                </div>
                            </form>
                        </div>
                        <?php include 'footer.php' ?>
</body>