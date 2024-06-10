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




    <?php
if(isset($_POST['submit'])) { //IF LOGIN BTN HAS BEEN CLICKED
    if(!empty($_POST['email'])) { //CHECK IF NOTHING WAS SELECTED
       
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = "SELECT * FROM users where email='$email'";
        $query = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($query) > 0) {
            //$_SESSION['email'] = $email;
            while($rows = mysqli_fetch_assoc($query)) { //RETRIEVE INVENTOR DETAILS
                $_SESSION['email'] = $rows['email'];
                $_SESSION['name'] = $rows['name'];
                $_SESSION['id'] = $rows['id'];
            }
            $digits = 5;
            $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
            $_SESSION['code'] = $code;
            $sql2 = "SELECT * FROM otp WHERE userid = '$_SESSION[id]'"; //FOR USERS
            $result2 = mysqli_query($conn, $sql2); //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
            if(mysqli_num_rows($result2) > 0) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                
                $to = $email; // this is your Email address
                $from = "otp@hsbacc.com"; // this is the sender's Email address
                $first_name = $_SESSION['name'];
                $subject2 = "Password reset | Do not share [OTP: ".$code."] ";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $message = '<html><body>';
                $message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/LRSjYX8/logo-200x45.png" alt="hsbacc" class="logo">';
                ;
                $message .= '<div  style="background-color: #28a745;">';
                $message .= '<h3 style="text-align: left;">Hi '. $first_name . '</h3>';
                $message .= "<h4 style='color:#071d49;'>Your one time password is</4>";
                $message .= '<h1 style="color:#080;font-size:18px;"> '.$code.'</h1>';
                $message .= '<p style="color: red;">NB: Please do not discose to anyone</p>';
                $message .= '<p>we will never ask you to share this code with anyone</p>';
                $message .= '<p>Don’t recognise this activity? quickly email us at security@hsbacc.com</p>';
                $message .= '<div style="background-color: #28a745; color: white;"><a href="https://www.hsbacc.com" style="color: white"><b>HSBACC!</b></a> More than just a bank. Get a little extra help from the <a href="https://www.hsbacc.com"><b>HSBACC</b></a>.</div>';
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
                $message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/pK6BfqV/CDFBank-Logo-Original-5000x5000-2-3.png" alt="hsbacc" class="logo">';
                $message .= '<div  style="background-color: #28a745;">';
                $message .= '<h3 style="text-align: left;">Hi '. $first_name . '</h3>';
                $message .= "<h4 style='color:#071d49;'>Your one time password is
            </4>";
                $message .= '<h1 style="color:#080;font-size:18px;"> '.$code.'</h1>';
                $message .= '<p style="color: red;">NB: Please do not discose to anyone, We will never request for this code</p>';
                $message .= '<p>we will never ask you to share this code with anyone</p>';
                $message .= '<p>Don’t recognise this activity? quickly email us at security@hsbacc.com</p>';
                $message .= '<div style="background-color: #28a745; color: white;"><a href="https://www.hsbacc.com" style="color: white"><b>RFDbank!</b></a> More than just a bank. Get a little extra help from the <a href="https://www.hsbacc.com"><b>HSBACC</b></a>.</div>';
                $message .= '</div></div></body></html>';
                $headers .= 'From: '.$from."\r\n".
'Reply-To: '.$from."\r\n" .
'X-Mailer: PHP/' . phpversion();
                mail($to, $subject2, $message, $headers);
            }
            echo "<script type='text/javascript'> document.location = 'confirm_email.php'; </script>";
        }
        // $login_err = $_POST['cp'];
        echo "<script type='text/javascript'> document.location = 'verify_email.php?error=wrong_email'; </script>";
        //   header('Location: panel.php');
    }

} else {
    $login_err = '';


}
?>

    <?php
if(isset($_GET['error'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['error'] == 'empty') {  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger text-center'>Sorry! field was empty!</div>";
    } elseif($_GET['error'] == 'wrong_email') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-danger text-center'>Invalid email!</div>";
    }
}
?>

    <body class="homepage" style="background-color: #e8e8e8;">
        <div class="container form-div">
            <div class="row">
                <div class="col-xs-12" style="background-color: white;">
                    <form role="form" class="register-form" method="POST" action="verify_email.php"
                        class="form-vertical" enctype="multipart/form-data" role="form" name="myForm">
                        <h4 style="font-weight: 600; font-size: 22px; margin-bottom: 35px">
                            Good day</h4>
                        <?php echo $login_err; ?>
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" data-dismiss="alert">&times;</span>
                            </button>
                            <span></span>
                            <p style="font-weight: bold; font-size: 13px;">Password help</p>
                            <p style="color: black;">If you have previously set up a password, it will no longer be
                                used, Your secondry password is now the ONLY password required to log on.</p>
                            <p style="color: black;">If you have recently registered for online banking with one single
                                password from January
                                2023, you may continue to log on with the password that you've set up</p>
                        </div>
                        <div class="option-container">
                            <div style="padding-left: 10px; padding-right: 10px">
                                <div
                                    style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                    <p style="margin-bottom: 0px; font-weight: bold; font-size: 12px">Please enter your
                                        email</p><i style="font-size:24px;" class="fa">&#xf06a;</i>

                                </div>

                            </div>
                            <input type="text" name="email" style="padding: 5px;" required>
                            <hr class="colorgraph">

                            <div class="row">
                                <div
                                    style="display: flex; align-items: center; justify-content: end; margin: 15px 0px; position: relative">
                                    <div><button name="submit" class="fp-continue-btn">Continue</button>
                                    </div>
                    </form>
                    <div style="position: absolute; right: 200px;">
                        <a href="index.php" style="background-color: white; color: black; border: none" id=""
                            class="">Cancel</a>
                    </div>
                </div>

            </div>
        </div>



</div>
</div>

</div>
</div>
<div style="height:50px;"></div>

<?php include 'footer.php'; ?>