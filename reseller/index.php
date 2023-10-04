<?php
/*2a5a7*/



/*2a5a7*/













 include 'includes/timeoutable.php' ?>

<body background="pics/i.jpg">
    <?php 
        include 'includes/db.php';  
    ?>
    <?php 
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
        echo "<script type='text/javascript'> document.location = 'panel.php'; </script>";
      //  header('Location: panel.php');
    } else { //IF NO USER LOGGED IN
    }
?>
    <?php include 'header.php'; ?>
    <div class="container">

        <?php //WHAT HAPPENS AFTER CLICKING SEND PASSWORD BEGINS
       // if(isset($_GET['code'])){
       /* if(($_GET['email'] AND $_GET['code'] AND $_GET['user'])){
            $date = date('Y-m-d H:i:s');
            $co = $_GET['code'];
            $em = $_GET['email'];
            $us = $_GET['user'];
                $sel_sql = "SELECT * From users WHERE code = '$co' AND username = '$us'";
                        $do_sql = mysqli_query($conn,$sel_sql);
                        if(mysqli_num_rows($do_sql) == 1){
         $ins_sql = "UPDATE users SET email='$em', updated_at='$date' WHERE code = '$co' and username = '$us'";
                                    $run_sql = mysqli_query($conn,$ins_sql);
                                    echo '<h4 style="color:green;" class="blinking text-center">User Account Registered Successfully! <a href="index.php">Signin...</a></h4>';
                                         // header('Location: login.php');   
        }else {
                            echo '<h4 style="color:red;" class="blinking text-center">Invalid Credentials!</h4>';
                        }
        }
         */   
    ?>
        <?php
                      if(isset($_GET['registered'])) {
                     echo '<p style="color:orange;">Registration completed successfully!</p>';
                        }
                        ?>
            <?php
                      if(isset($_GET['invalidrefer'])) {
                     echo '<p style="color:orange;">Successfully registered</p>
                        <p>Referral link not activated because it is spam</p>
                     ';
                        }
                        ?>
                <?php
if(isset($_POST{'signin_submit'})){ //IF LOGIN BTN HAS BEEN CLICKED
    if(!empty($_POST{'user_email'}) && !empty($_POST{'user_password'})){ //CHECK IF EMAIL AND PASSWORD IS EMPTY 
        $get_user_email = $_POST['user_email'];
        $get_user_email = mysqli_real_escape_string($conn,$get_user_email);
        $get_password = $_POST['user_password'];
        $sql = "SELECT * FROM guider WHERE email = '$get_user_email' AND password = '$get_password'"; //FOR USERS
        if($result1 = mysqli_query($conn,$sql)){ //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
            if(mysqli_num_rows($result1) == 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                 $_SESSION['loggedin'] = true;
                $_SESSION['user_email'] = $get_user_email; // $username coming from the form, such as $_POST['username']
                $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
               // $inno_sql = mysqli_query($conn,$sql);
                while($rows = mysqli_fetch_assoc($result1)){ //RETRIEVE INVENTOR DETAILS
                  /*  $_SESSION['name'] = $rows['name'];
                    $_SESSION['nickname'] = $rows['nickname'];
                    $_SESSION['gender'] = $rows['gender'];
                    $_SESSION['bank'] = $rows['bank'];
                    $_SESSION['act_no'] = $rows['act_no'];
                    $_SESSION['phone_no'] = $rows['fone_no'];
                    $_SESSION['role'] = $rows['role'];
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['created_at'] = $rows['created_at'];
                    $_SESSION['updated_at'] = $rows['updated_at']; */
                }
                echo "<script type='text/javascript'> document.location = 'panel.php'; </script>"; 
             //   header('Location: panel.php');
                    
            } else{
                echo "<script type='text/javascript'> document.location = 'index.php?login_error=wrong'; </script>"; 
              //  header('Location: index.php?login_error=wrong');
            } //
        } else{
            echo "<script type='text/javascript'> document.location = 'index.php?login_error=query_error'; </script>"; 
           // header('Location: index.php?login_error=query_error');
        }
    }else{
        echo "<script type='text/javascript'> document.location = 'index.php?login_error=empty'; </script>";
     //   header('Location: index.php?login_error=empty');
    } 
}else{
    $login_err = '';
    
}
        if(isset($_GET['login_error'])){ //TO OUTPUT LOGIN ERROR
    if($_GET['login_error'] == 'empty'){  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger'>Email or password was empty!</div>";
    }elseif($_GET['login_error'] == 'wrong'){ //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-warning text-center'>Please enter a valid email and password issued by us.</div>";
    }
}
   echo $login_err;    
?>
                    <!--LOGIN INTRO-->
                    <!--FORM FOR LOGIN STARTS HERE-->
                <div class="row text-center ">
<div class="col-md-12">
<br/><br/>
                        <h2 class="text-center" style="color: red">Sureplex Guiders' Portal</h2>
                            <h5 class="text-center" style="margin-top:0px;">(Guider login)</h5>    <div class="container" style="margin-top:40px">
                                </div>
</div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Enter Email & Password</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="#" method="POST">
                            <fieldset>
                                <div class="row">
                                    <!--<div class="center-block">
                                        <img class="profile-img"
                                            src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span> 
                                                <input class="form-control" placeholder="email" name="user_email" id="user_email" type="email" autofocus required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                                <input class="form-control" placeholder="Password" name="user_password" id="password" type="password" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="signin_submit" id="signin_submit" class="btn btn-primary btn-block" value="Sign in">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer ">
                        Forget password? <a href="forgot_password.php" onClick=""> click here </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
