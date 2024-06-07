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
    if(!empty($_POST['cp'])) { //CHECK IF NOTHING WAS SELECTED
        if($_POST['cp'] === 'email') {
            echo "<script type='text/javascript'> document.location = 'verify_email.php'; </script>";
        }
        // $login_err = $_POST['cp'];
        echo "<script type='text/javascript'> document.location = 'verify_sec_question.php'; </script>";
        //   header('Location: panel.php');
    }

} else {
    $login_err = '';


}
?>

    <body class="homepage" style="background-color: #e8e8e8;">

        <div class="container form-div">
            <div class="row">
                <div class="col-xs-12" style="background-color: white;">
                    <form role="form" class="register-form" method="POST" action="forgot-password.php"
                        class="form-vertical" enctype="multipart/form-data" role="form" name="myForm">
                        <?php
                        if(isset($_GET['security_device'])) {
                            echo  '<h4 style="font-weight: 600; font-size: 22px; margin-bottom: 35px">
                            Continue with security device </h4>';
                        } else {
                            echo '<h4 style="font-weight: 600; font-size: 22px; margin-bottom: 35px">
                            Forgotten password?</h4>';
                        }
?>

                        <p><?php echo $login_err; ?></p>

                        <p style="color: black;">Please chose a method to reset your password, we recommend
                            activating your mobile secure key for a safer experience.</p>
                        <div class="option-container">
                            <div
                                style="display:flex; align-items: center; justify-content: space-between; padding-left: 10px; padding-right: 10px">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <i style="font-size:24px;" class="fa">&#xf06a;</i>
                                    <p style="margin-bottom: 0px; font-weight: bold; font-size: 13px">Reset using your
                                        email address</p>
                                </div>
                                <input type="radio" name="cp" value="email" required>
                            </div>
                            <div style="padding: 10px 30px;">
                                <p style="font-size: 13px;">
                                    This is the default way of getting back online, you'd have to provide your email
                                    address associated with your account, a one time password will be generated to
                                    complete the process
                                </p>
                            </div>
                            <div class="option-container">
                                <div
                                    style="display:flex; align-items: center; justify-content: space-between; padding-left: 10px; padding-right: 10px">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i style="font-size:24px;" class="fa">&#xf06a;</i>
                                        <p style="margin-bottom: 0px; font-weight: bold; font-size: 13px">Reset using
                                            your
                                            security question</p>
                                    </div>
                                    <input type="radio" name="cp" value="security_question" required>
                                </div>
                                <div style="padding: 10px 30px;">
                                    <p style="font-size: 13px;">
                                        This is the default way of getting back online, you'd have to provide your email
                                        address associated with your account, a one time password will be generated to
                                        complete the process
                                    </p>
                                </div>
                            </div>

                            <hr class="colorgraph">

                            <div class="row">
                                <div
                                    style="display: flex; align-items: center; justify-content: end; margin: 15px 0px; position: relative">
                                    <div><button name="submit" id="user_password"
                                            class="index-loginbtn">Continue</button>
                                    </div>
                                    <div style="position: absolute; right: 200px;">
                                        <a href="index.php" style="background-color: white; color: black; border: none"
                                            id="" class="">Cancel</a>
                                    </div>
                                </div>

                            </div>

                    </form>


                </div>
            </div>
        </div>
</div>
<div style="height:50px;"></div>

<?php include 'footer.php'; ?>