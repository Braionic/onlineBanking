<?php include 'includes/timeoutable.php' ?>
<?php include 'includes/db.php'; ?>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    //  header('Location: panel.php');


} else { //IF NO USER LOGGED IN
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Update</title>
</head>

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

$date = date('Y-m-d H:i:s');

//INVENTOR SUBMIT

$new_email = $_SESSION['temp_email'];
$new_fone_number = $_SESSION['temp_fone_no'];
$id =  $_SESSION['id'];

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
                        echo "<script type='text/javascript'> document.location = 'confirm_profile_edit.php?otp_error=wrong'; </script>";
                        //  header('Location: signin.php?login_error=wrong');
                    } else {
                        $sql_2 = "UPDATE users
                            SET email='$new_email', fone_no='$new_fone_number', updated_at='$date'
                            WHERE id= '$_SESSION[id]'";
                        mysqli_query($conn, $sql_2);
                        $_SESSION['email'] = $new_email;
                        $_SESSION['phone_no'] = $new_fone_number;
                        $_SESSION['updated_at'] = $date;
                    }
                   
                    
                }

                echo "<script type='text/javascript'> document.location = 'personaldetails.php?success=Your password has been changed successfully'; </script>";
                //   header('Location: panel.php');
                    
            } else {
                echo "<script type='text/javascript'> document.location = 'confirm_profile_edit.php?otp_error=wrong'; </script>";
                //  header('Location: signin.php?login_error=wrong');
            } //
        } else {
            echo "<script type='text/javascript'> document.location = 'confirm_profile_edit.php?otp_error=query_error'; </script>";
            // header('Location: signin.php?login_error=query_error');
        }
    } else {
        echo "<script type='text/javascript'> document.location = 'confirm_profile_edit.php?otp_error=empty'; </script>";
        //   header('Location: signin.php?otp_error=empty');
    }
} else {
    $login_err = '';

}
if(isset($_GET['otp_error'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['otp_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger text-center'>Sorry! field was empty!</div>";
    } elseif($_GET['otp_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-danger text-center'>Invalid OTP!</div>";
    } elseif($_GET['otp_resent'] == 'sent') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-success text-center'>OTP has been resent!</div>";
    }
}

if(isset($_GET['otp_resent'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['otp_resent'] == 'sent') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-success text-center'>OTP has been resent!</div>";
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
        $to = $_SESSION['email']; // this is your Email address
        $from = "otp@hsbacc.com"; // this is the sender's Email address
        $first_name = $_SESSION['name'];
        $subject2 = "OTP Verification | Do not share [OTP: ".$code. "]";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $message = '<html><body>';
        //$message .= '<div class="navbar-brand" style="text-align: center;"><img src="https://i.ibb.co/LRSjYX8/logo-200x45.png" alt="hsbacc" class="logo">';
        $message .= '<div>';
        $message .= '<h3 style="text-align: left;">Hi '. $first_name . '</h3>';
        $message .= "<h4 style='color:#071d49;'>Your one time password is</4>";
        $message .= '<h1 style="color:#080;font-size:18px;"> '.$code.'</h1>';
        $message .= '<p style="color: red;">NB: Please do not discose to anyone</p>';
        $message .= '<p>we will never ask you to share this code with anyone</p>';
        $message .= '<p>Don’t recognise this activity? quickly email us at security@hsbacc.com</p>';
        $message .= '<div style="background-color: #fdc600; color: black;"><a href="https://www.hsbacc.com" style="color: white"><b>HSBACC!</b></a> More than just a bank. Get a little extra help from the <a href="https://www.hsbacc.com"><b>RFDB</b></a>.</div>';
        $message .= '</div></div></body></html>';
        $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
        $mymail = mail($to, $subject2, $message, $headers);
        $upd_sql = "UPDATE otp SET code='$code' WHERE userid = '$_SESSION[id]'";
        $run_sql = mysqli_query($conn, $upd_sql);
                    
        echo "<script type='text/javascript'> document.location = 'confirm_profile_edit.php?otp_resent=sent'; </script>";
        //  header('Location: signin.php?login_error=wrong');
    }
}

$trunck_email = (strlen($_SESSION['email']) > 5) ? substr($_SESSION['email'], 0, strlen($_SESSION['email'])-8).'...': $_SESSION['email'];
?>



<body>

    <?php include('header2.php') ?>
    <div style="height:60px;"></div>
    <div class="main-wrapper">
        <div class="container">
            <div class="row">


                <?php echo $login_err ?>
                <div class="top-bar"
                    style="margin-top: 30px; padding: 7px 12px; display: flex; align-items: center; gap: 50px; background-color: rgba(100, 100, 130, 0.9); color: white;">
                    <p style="margin-right: 70px">Account Reveiw</p>
                    <p style="padding-left: 10px">Your Personal Details</p>
                </div>
                <div class="" style="display: flex;">
                    <div class="col-5" style="width: 20%; background-color: rgba(100, 100, 100, 0.2);">
                        <div
                            style="background-color: white; padding: 10px; box-shadow: 0px 1px 4px grey; border-left: 4px solid red;">
                            <p>Your Personal Details</p>
                        </div>
                    </div>
                    <div class="col-7">
                        <div style="border-top: 3px solid red; width: 30%; padding-top: 0px">

                        </div>
                        <div class="di" style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">


                            <h2>Review your details</h2>

                            <p style="font-weight: bold; font-size: 12px; padding-top: 10px">Please check the details
                                you entered are correct are correct before continuing</p>
                            <h3>Contact Details</h3>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <p style="flex-grow: 1">Mobile Number</p>
                                <div style="flex-grow: 2">
                                    <form action="confirm_profile_edit.php" method="post" id="myform">
                                        <input type="text" name="fone_no" style="width: 50%; padding: 5px; margin: auto"
                                            placeholder="<?php echo $_SESSION['temp_fone_no'] ?>"
                                            disabled />
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <p style="flex-grow: 1">Email Address</p>
                                <div style="flex-grow: 2">
                                    <input type="email" name="email" style="width: 50%; padding: 5px; margin: auto"
                                        placeholder="<?php echo $_SESSION['temp_email'] ?>"
                                        disabled />
                                </div>
                            </div>

                            <hr>
                            <h2>Additional security required</h2>
                            <p style="font-weight: bold; font-size: 12px; padding-top: 10px">To continue this action,
                                you must enter a re-authentication code from your Security Device or email associated
                                with your account.</p>
                            <div class="bg-info text-info text-center" style="padding: 5px;">
                                <p>A verification email has been sent to your email
                                    &nbsp;
                                    <b><?php echo $trunck_email; ?>
                                        <?php echo $date ?></b>
                                </p>
                            </div>
                            <div style="padding: 20px;">
                                <div
                                    style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                    <p style="flex-grow: 1">Re-Authentication code</p>
                                    <div style="flex-grow: 2">
                                        <input type="text" name="otp" style="width: 50%; padding: 5px; margin: auto"
                                            placeholder="Enter OTP" />
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: end; margin: 10px; position: relative">
                                <button class="btn btn-sm btn-danger" form="myform" name="otp_submit">Continue</button>
                                </form>
                                <button class="btn btn-sm btn-outline-light "
                                    onclick="location.href = 'profile_edit.php';"
                                    style="margin: 5px; position: absolute; right: 80px; bottom: -5px">Cancel</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php") ?>

</html>