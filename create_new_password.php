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
    if(!empty($_POST['otp'])) { //CHECK IF NOTHING WAS SELECTED
        $otp = mysqli_real_escape_string($conn, $_POST['otp']);
        
        $sql = "SELECT * FROM otp WHERE email = '$_SESSION[email]'"; //FOR USERS
        if($result1 = mysqli_query($conn, $sql)) { //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
            if(mysqli_num_rows($result1) > 0) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                
                while($rows = mysqli_fetch_assoc($result1)) { //RETRIEVE INVENTOR DETAILS
                    $db_otp = $rows['code'];
                    if($db_otp != $otp) {
                        echo "<script type='text/javascript'> document.location = 'confirm_email.php?otp_error=wrong'; </script>";
                        //  header('Location: signin.php?login_error=wrong');
                    } else {
                        echo "<script type='text/javascript'> document.location = 'create_new_password.php'; </script>";
                    }
                   
                    
                }


                //   header('Location: panel.php');
                    
            } else {
                echo "<script type='text/javascript'> document.location = 'confirm_email.php?otp_error=no_user'; </script>";
                //  header('Location: signin.php?login_error=wrong');
            } //
        } else {
            echo "<script type='text/javascript'> document.location = 'confirm_email.php?otp_error=dbfailed'; </script>";
        }
    }

} else {
    $login_err = '';


}

?>

    <?php
if(isset($_GET['otp_error'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['otp_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger text-center'>Sorry! field was empty!</div>";
    } elseif($_GET['otp_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-danger text-center'>Invalid OTP!</div>";
    } elseif($_GET['otp_resent'] == 'sent') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-success text-center'>OTP has been resent!</div>";
    }
}
?>

    <body class="homepage" style="background-color: #e8e8e8;">

        <div class="container form-div">

            <div class="row">
                <div class="col-xs-12" style="background-color: white;">
                    <form role="form" class="register-form" method="POST" action="np.php" class="form-vertical"
                        enctype="multipart/form-data" role="form" name="myForm">
                        <h4 style="font-weight: 600; font-size: 22px; margin-bottom: 35px">
                            Create new password</h4>
                        <?php echo $login_err; ?>
                        <div class="option-container">
                            <div>
                                <div
                                    style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                    <p style="margin-bottom: 0px; font-weight: bold; font-size: 12px">New Password
                                    </p>

                                </div>

                            </div>
                            <input type="text" name="new_pwd" style="padding: 5px;" required>
                            <p style="margin-bottom: 0px; margin-left: px; font-weight: bold; font-size: 12px">Confirm
                                new password
                            </p>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" data-dismiss="alert">&times;</span>
                                </button>
                                <span></span>
                                <p style="font-weight: bold; font-size: 13px;">One time password</p>
                                <p style="color: black;">Please enter the one time password sent to your email</p>
                            </div>
                            <input type="text" name="new_pwdc" style="padding: 5px;" required>
                            <hr class="colorgraph">

                            <div class="row">
                                <div
                                    style="display: flex; align-items: center; justify-content: end; margin: 15px 0px; position: relative">
                                    <div><button name="submit" id="user_password"
                                            class="index-loginbtn">Continue</button>
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
<div style="height:50px;"></div>

<?php include 'footer.php'; ?>