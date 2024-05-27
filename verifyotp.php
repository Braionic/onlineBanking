<?php include 'includes/timeoutable.php' ?>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    //  header('Location: panel.php');

    echo "<script type='text/javascript'> document.location = 'panel.php'; </script>";
} else { //IF NO USER LOGGED IN

}
?>

<?php
include 'includes/db.php';
?>


<?php
if(isset($_GET['otp_error'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['otp_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger text-center'>Sorry! field was empty!</div>";
    } elseif($_GET['otp_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-warning text-center'>Invalid OTP!</div>";
    } elseif($_GET['otp_resent'] == 'sent') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-success text-center'>OTP has been resent!</div>";
    }
}
?>

<?php
if(isset($_POST['otp_submit'])) { //IF LOGIN BTN HAS BEEN CLICKED
    if(!empty($_POST['otp'])) { //CHECK IF EMAIL AND PASSWORD IS EMPTY
        $get_otp = mysqli_real_escape_string($conn, $_POST['otp']);
        //$get_otp = mysqli_real_escape_string($conn, $get_otp);
        $sql = "SELECT * FROM otp WHERE userid = '$_SESSION[id]'"; //FOR USERS
        if($result1 = mysqli_query($conn, $sql)) { //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
            if(mysqli_num_rows($result1) == 1) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                
                while($rows = mysqli_fetch_assoc($result1)) { //RETRIEVE INVENTOR DETAILS
                    $otp = $rows['code'];
                    if($otp != $get_otp) {
                        echo "<script type='text/javascript'> document.location = 'verifyotp.php?otp_error=wrong'; </script>";
                        //  header('Location: signin.php?login_error=wrong');
                    } else {
                        $sql2 = "SELECT * FROM USERS WHERE id = '$_SESSION[id]'";
                        $result2 = mysqli_query($conn, $sql2);
                        if(mysqli_num_rows($result2) == 1) {
                            while($rows = mysqli_fetch_array($result2)) {
                                $_SESSION['loggedin'] = true;
                                $_SESSION['user_email'] = $rows['email']; // $username coming from the form, such as $_POST['username']
                                $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
                                $my_email = $rows['email'];
                                $_SESSION['name'] = $rows['name'];
                                //$_SESSION['email'] = $rows['email'];
                                $_SESSION['address'] = $rows['address'];
                                $_SESSION['dob'] = $rows['dob'];
                                $_SESSION['swift_code'] = $rows['swift_code'];
                                $_SESSION['nickname'] = $rows['nickname'];
                                $_SESSION['account'] = $rows['account'];
                                $_SESSION['gender'] = $rows['gender'];
                                //$_SESSION['bank'] = $rows['bank'];
                                $_SESSION['act_no'] = $rows['act_no'];
                                $_SESSION['phone_no'] = $rows['fone_no'];
                                $_SESSION['state'] = $rows['state'];
                                $_SESSION['limit_status'] = $rows['limit_status'];
                                // $_SESSION['walletcode'] = $rows['walletcode'];
                                $_SESSION['role'] = $rows['role'];
                                $_SESSION['amount'] = $rows['amount'];
                                $_SESSION['currency'] = $rows['currency'];
                                $_SESSION['id'] = $rows['id'];
                                $_SESSION['created_at'] = $rows['created_at'];
                                $_SESSION['updated_at'] = $rows['updated_at'];
                            }
    
                        }
                    }
                   
                    
                }

                echo "<script type='text/javascript'> document.location = 'panel.php'; </script>";
                //   header('Location: panel.php');
                    
            } else {
                echo "<script type='text/javascript'> document.location = 'verifyotp.php?otp_error=wrong'; </script>";
                //  header('Location: signin.php?login_error=wrong');
            } //
        } else {
            echo "<script type='text/javascript'> document.location = 'verifyotp.php?otp_error=query_error'; </script>";
            // header('Location: signin.php?login_error=query_error');
        }
    } else {
        echo "<script type='text/javascript'> document.location = 'verifyotp.php?otp_error=empty'; </script>";
        //   header('Location: signin.php?otp_error=empty');
    }
} else {
    $login_err = '';

}
if(isset($_GET['otp_error'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['otp_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger'>Sorry! field was empty!</div>";
    } elseif($_GET['otp_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-danger'>Invalid OTP!</div>";
    } elseif($_GET['otp_resent'] == 'sent') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-success'>OTP has been resent!</div>";
    }
}

if(isset($_GET['otp_resent'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['otp_resent'] == 'sent') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-success'>OTP has been resent!</div>";
    }
}
echo $login_err;
// for otp resend
if(isset($_POST['resendotp'])) {
    $digits = 5;
    $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
    $sql2 = "SELECT * FROM otp WHERE userid = '$_SESSION[id]'"; //FOR USERS
    $result2 = mysqli_query($conn, $sql2); //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
    if(mysqli_num_rows($result2) == 1) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
        $to = $_SESSION['user_email']; // this is your Email address
        $from = "otp@mycdfb.com"; // this is the sender's Email address
        $first_name = $_SESSION['name'];
        $subject2 = "OTP Verification | Do not share [OTP: ".$code. "]";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $message = '<html><body>';
        $message .= '<div class="navbar-brand" style="text-align: center;"><img src="https://i.ibb.co/LRSjYX8/logo-200x45.png" alt="CA" class="logo">';
        $message .= '<div  style="background-color: #f3f3f3;">';
        $message .= '<h3 style="text-align: left;">Hi '. $first_name . '</h3>';
        $message .= "<h4 style='color:#071d49;'>Your one time password is</4>";
        $message .= '<h1 style="color:#080;font-size:18px;"> '.$code.'</h1>';
        $message .= '<p style="color: red;">NB: Please do not discose to anyone</p>';
        $message .= '<p>we will never ask you to share this code with anyone</p>';
        $message .= '<p>Don’t recognise this activity? quickly email us at security@myrfdb.com</p>';
        $message .= '<div style="background-color: #fdc600; color: black;"><a href="https://www.myrfdb.com" style="color: white"><b>RFDB!</b></a> More than just a bank. Get a little extra help from the <a href="https://www.myrfdb.com"><b>RFDB</b></a>.</div>';
        $message .= '</div></div></body></html>';
        $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
        $mymail = mail($to, $subject2, $message, $headers);
        $upd_sql = "UPDATE otp SET code='$code' WHERE userid = '$_SESSION[id]'";
        $run_sql = mysqli_query($conn, $upd_sql);
                    
        echo "<script type='text/javascript'> document.location = 'verifyotp.php?otp_resent=sent'; </script>";
        //  header('Location: signin.php?login_error=wrong');
    }
}

$trunck_email = (strlen($_SESSION['email']) > 5) ? substr($_SESSION['email'], 0, strlen($_SESSION['email'])-8).'...': $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php") ?>

    <style>
        .main-wrapper {

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 90vh;
            padding: 20px;
        }

        .form-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: column;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .otp-time {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 10px;
        }

        .form {
            padding: 20px 15px;
            box-shadow: 2px 2px 5px grey;
            margin-top: 20px;
            text-align: center;
            max-width: 70%;
        }

        .input {
            padding: 10px 5px;
        }

        @media (min-width: 600px) {
            .form {
                width: 30%;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
               echo $login_err;
?>
                    <div class="form-container">
                        <div class="form">
                            <div class="heading">
                                <h3><b>OTP Verification</b></h3>

                                <p>please enter the one time password sent to your email
                                    <?php echo $trunck_email ?>
                                    to complete your
                                    verification
                                </p>
                            </div>
                            <form method="post" action="verifyotp.php">

                                <div class="input">
                                    <input type="text" class="form-form-control " name="otp"
                                        placeholder="one time password" />
                                </div>
                                <div class="otp-time">
                                    <p style="font-size: x-small;">Remaining time <span class="text-primary">12:23</p>
                                    <p style="font-size: x-small;">Didn't get the code? <button name="resendotp"
                                            style="background-color: none; padding: 0; border: none; cursor: pointer; text-primary">Resend</button>
                                    </p>
                                </div>
                                <button class="btn btn-md btn-primary"
                                    style="margin-top: 10px; width: 100%; border-radius: 18px; padding: 8px 16px;"
                                    name="otp_submit">Verify</button>
                            </form>
                            <a href="signout.php"><button class="btn text-primary border-primary"
                                    style="margin-top: 10px; width: 100%; border-radius: 18px; padding: 8px 16px; background-color: white; border: 2px solid gray">Cancel</button></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php") ?>
</body>

</html>