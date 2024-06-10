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
    <title>Edit Profile Tnformation</title>
</head>

<?php

$date = date('Y-m-d H:i:s');

//INVENTOR SUBMIT

if (isset($_POST['edit_submit'])) {
    $fone_no = mysqli_real_escape_string($conn, $_POST['fone_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = "user";

    // UPDATE INTO USERS

    $ssql = "SELECT * FROM users WHERE id='$_SESSION[id]'";

    $run_ssql = mysqli_query($conn, $ssql);

    if(mysqli_num_rows($run_ssql) == 1) {
        $_SESSION['temp_fone_no'] = $fone_no;
        $_SESSION['temp_email'] = $email;

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
            $message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/SXJ2prp/logo-icon-170012.png" alt="HSBACC" class="logo">';
            ;
            $message .= '<div>';
            $message .= '<h3 style="text-align: left; font-weight: normal">Hi '. $first_name . '</h3>';
            $message .= "<h4 style='color:#071d49;'>Your one time password is</4>";
            $message .= '<h1 style="color:#080;font-size:18px;"> '.$code.'</h1>';
            $message .= '<p style="color: red;">NB: Please do not discose to anyone</p>';
            $message .= '<p>we will never ask you to share this code with anyone</p>';
            $message .= '<p>Don’t recognise this activity? quickly email us at security@hsbacc.com</p>';
            $message .= '<div style="background-color: red; color: white;"><a href="https://www.hsbacc.com" style="color: white"><b>HSBACC!</b></a> More than just a bank. Get a little extra help from the <a href="https://www.myrfdb.com"><b>RFDB</b></a>.</div>';
            $message .= '</div></div></body></html>';
            $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
            mail($to, $subject2, $message, $headers);
            $upd_sql = "UPDATE otp SET code='$code' WHERE userid = '$_SESSION[id]'";
            $run_sql = mysqli_query($conn, $upd_sql);
        } else {
            $ins_sql1 = "INSERT INTO otp (name, userid, email, code) VALUES ('$_SESSION[name]', '$_SESSION[id]', '$_SESSION[user_email]', '$code')";
            $run_sql2 = mysqli_query($conn, $ins_sql1);
            $to = $_SESSION['email']; // this is your Email address
            $from = "security@hsbacc.com"; // this is the sender's Email address
            $first_name = $_SESSION['name'];
            $subject2 = "OTP Verification | Do not share [OTP: ".$code. "]";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $message = '<html><body>';
            $message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/SXJ2prp/logo-icon-170012.png" alt="HSBACC" class="logo" style="width: 50px; width: 50px;">';
            $message .= '<div>';
            $message .= '<h3 style="text-align: left; font-weight: normal">Hi '. $first_name . '</h3>';
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
        header("Location: confirm_profile_edit.php?verify=please provide the otp sent to your email");
        
        // $ins_sql = "UPDATE users SET fone_no='$fone_no', email='$email updated_at='$date'";

        // $run_sql = mysqli_query($conn, $ins_sql);

        // echo '<div class="alert alert-success text-center">Your Details has been updated Successful</div>';

        // header('Location: login.php');

    } else {

        echo 'no file to update';

    }

}

?>

<body>

    <?php include('header2.php') ?>
    <div style="height:60px;"></div>
    <div class="main-wrapper">
        <div class="container">
            <div class="row">
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


                            <h2>Contact details</h2>

                            <p style="font-weight: bold; font-size: 12px; padding-top: 10px">Change to your phone number
                                will apply to your
                                individual
                                accounts only. To update changes to
                                any joint accounts, please call contact center or visit any HSBC/HSBC Amanah branch.</p>
                            <h3>Your Personal Details</h3>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <p style="flex-grow: 1">Mobile Number</p>
                                <div style="flex-grow: 2">
                                    <form action="profile_edit.php" method="post" id="myform">
                                        <input type="text" name="fone_no"
                                            value="<?php echo $_SESSION['phone_no'] ?>"
                                            style="width: 50%; padding: 5px; margin: auto"
                                            placeholder="<?php echo $_SESSION['phone_no'] ?>" />
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <p style="flex-grow: 1">Email Address</p>
                                <div style="flex-grow: 2">
                                    <input type="email" name="email"
                                        value="<?php echo $_SESSION['email'] ?>"
                                        style="width: 50%; padding: 5px; margin: auto"
                                        placeholder="<?php echo $_SESSION['email'] ?>" />
                                </div>
                            </div>

                            <hr>
                            <h2>important information</h2>
                            <div style="padding: 20px;">
                                <p>Your details will be uploaded in real time.</p>
                                <p>All correspondences including statements and marketing materials will be sent to the
                                    email address and contact number in the bank's records. To update your prefrences,
                                    please visit online banking </p>
                            </div>
                            <div style="text-align: end; margin: 10px; position: relative">
                                <button class="btn btn-sm btn-danger" form="myform" name="edit_submit">Continue</button>
                                </form>
                                <button class="btn btn-sm btn-outline-light " onclick="handleCancel();"
                                    style="margin: 5px; position: absolute; right: 80px; bottom: -5px">Go back</button>
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