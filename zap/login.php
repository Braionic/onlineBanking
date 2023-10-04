<?php include '../includes/timeoutable.php' ?>
<body>
<?php include 'header.php'; ?>
    <?php 
        include '../includes/db.php';  
    ?>
        <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
    //    header('Location: index.php');
    } else { //IF NO USER LOGGED IN
        
    }
?>
            
                <div class="container">
                    <?php
                      if(isset($_GET['registered'])) {
                     echo '<p style="color:orange;">Successfully registered</p>';
                        }
                        ?>
                        <?php
if(isset($_POST['login_submit'])){ //IF LOGIN BTN HAS BEEN CLICKED
    if(!empty($_POST['admin_email']) && !empty($_POST['admin_password'])){ //CHECK IF EMAIL AND PASSWORD IS EMPTY 
        $get_admin_email = $_POST['admin_email'];
        $get_admin_email = mysqli_real_escape_string($conn,$get_admin_email);
        $get_password = $_POST['admin_password'];
        $sql = "SELECT * FROM admins WHERE email = '$get_admin_email' AND password = '$get_password'"; //FOR ADMINS
        if($result1 = mysqli_query($conn,$sql)){ //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
            if(mysqli_num_rows($result1) == 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                 $_SESSION['admin_loggedin'] = true;
                $_SESSION['admin_email'] = $get_admin_email; // $username coming from the form, such as $_POST['username']
                $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
               // $inno_sql = mysqli_query($conn,$sql);
                while($rows = mysqli_fetch_assoc($result1)){ //RETRIEVE INVENTOR DETAILS
                    $_SESSION['name'] = $rows['name'];
                    $_SESSION['gender'] = $rows['gender'];
                    $_SESSION['bank'] = $rows['bank'];
                    $_SESSION['act_no'] = $rows['act_no'];
                    $_SESSION['phone_no'] = $rows['fone_no'];
                    $_SESSION['role'] = $rows['role'];
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['created_at'] = $rows['created_at'];
                    $_SESSION['updated_at'] = $rows['updated_at'];
                }
                   echo "<script type='text/javascript'> document.location = 'index.php'; </script>"; 
              //  header('Location: index.php');
                    
            } else{
                echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>"; 
             //   header('Location: login.php?login_error=wrong');
            } //
        } else{
            echo "<script type='text/javascript'> document.location = 'login.php?login_error=query_error'; </script>"; 
           // header('Location: login.php?login_error=query_error');
        }
    }else{
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=empty'; </script>"; 
      //  header('Location: login.php?login_error=empty');
    } 
}else{
    $login_err = '';
    
}
        if(isset($_GET['login_error'])){ //TO OUTPUT LOGIN ERROR
    if($_GET['login_error'] == 'empty'){  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger'>Admin name or password was empty!</div>";
    }elseif($_GET['login_error'] == 'wrong'){ //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-danger'>Admin name or password was wrong!</div>";
    }
}
   echo $login_err;    
?>
                            <!--LOGIN INTRO-->
                            <h3 class="text-center" style="text-decoration:underline;">Admin Login</h3>
                            <!--FORM FOR LOGIN STARTS HERE-->
                            <div class="container-fluid">
                                <div ng-app="">
                                    <form method="POST" action="login.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                        <div class="form-group">
                                            <label class="col-sm-6 col-xs-6" for="admin_email">Email
                                            </label>
                                            <input type="email" name="admin_email" id="admin_email" placeholder="Enter Email" class="col-sm-5 col-xs-5 focbk" ng-model="admin_email" required>
                                            <span style="color:red" ng-show="myForm.admin_email.$dirty && myForm.admin_email.$invalid">
                                <span ng-show="myForm.admin_email.$error.required">Email is required.</span>
                                            <span ng-show="myForm.admin_email.$error.email">Invalid email address.</span>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-6 col-xs-6" for="admin_email">Password
                                            </label>
                                            <input type="password" name="admin_password" id="admin_password" placeholder="Enter Password" class="col-sm-5 col-xs-5" ng-model="admin_password" required>
                                            <span style="color:red" ng-show="myForm.admin_password.$touched && myForm.admin_password.$invalid">
                                <span ng-show="myForm.admin_password.$error.required">Password is required.</span>
                                            </span>

                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-6" for="login_submit">
                                            </label>
                                            <input type="submit" name="login_submit" id="login_submit" value="Login" class="btn btn-primary cc" class="col-sm-6 col-xs-6">
                                        </div>
                                    </form>
                                </div>
                                <!-- <a href="registration.php">Register</a> -->
                                <br/>
                                <a href="forgot_password.php">Forgot Password?</a>
                            </div>
                </div>
                <?php include 'footer.php' ?>
</body>