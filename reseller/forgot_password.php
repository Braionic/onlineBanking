<?php 
        include 'includes/db.php';
    ?>
<?php 
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
        header('Location: index.php');
    } else { //IF NO USER LOGGED IN
    }
?>

<body background="pics/image.jpg">
    <?php include 'header.php'; ?>
    <div style="height:20px;"></div>
    <!--FOR SPACE -->
    <div class="container">
        <?php //WHAT HAPPENS AFTER CLICKING SEND PASSWORD BEGINS
        if(isset($_POST['forgot_submit'])){
            if(!empty($_POST['forgot_email'])) {
                $forgot_email = $_POST['forgot_email'];
                $sel_sql = "SELECT * From users WHERE email = '$forgot_email'";
                $run_sql = mysqli_query($conn,$sel_sql);
                if(mysqli_num_rows($run_sql) == 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                while($rows = mysqli_fetch_assoc($run_sql)) {
                    if($_POST['forgot_email'] == $rows['email']) {
                        $block = "b7kXyH9!rmFB!B";
                        if($rows['password'] == $block || $rows['confirm_password'] == $block) {
                            //TO SEND EMAIL BEGINS
                         $to = $_POST['forgot_email']; // this is your Email address
                        $from = "sureplex.com"; // this is the sender's Email address
                        $first_name = $rows['name'];
                       // $last_name = $_POST['last_name'];
                        $password = $rows['password'];
                       // $subject = "Form submission";
                        $subject2 = "sureplex Notice";
                       // $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
                        $message2 = "" . $first_name .", Your account has been blocked! because there has been a violation of our terms and rules!";

                        $headers = "From:" . $from;
                      //  $headers2 = "From:" . $to;
                      //  mail($to,$subject,$message,$headers);
                        mail($to,$subject2,$message2,$headers); // sends a copy of the message to the sender
                        // You can also use header('Location: thank_you.php'); to redirect to another page.
                        //TO SEND EMAIL ENDS
                                // EMAIL SENT MESSAGE SUCCESFULLY
                                echo '
                                        <p style="color:black">Email Sent!</p> 
                        '; 
                    }else{
                         //TO SEND EMAIL BEGINS
                 $to = $_POST['forgot_email']; // this is your Email address
                $from = "sureplex.com"; // this is the sender's Email address
                $first_name = $rows['name'];
               // $last_name = $_POST['last_name'];
                $password = $rows['password'];
               // $subject = "Form submission";
                $subject2 = "Your sureplex Password";
               // $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
                $message2 = "" . $first_name ."your sureplex Password is => " . $password . ". on no account should you disclose it to anyone!";

                $headers = "From:" . $from;
              //  $headers2 = "From:" . $to;
              //  mail($to,$subject,$message,$headers);
                mail($to,$subject2,$message2,$headers); // sends a copy of the message to the sender
                // You can also use header('Location: thank_you.php'); to redirect to another page.
                //TO SEND EMAIL ENDS
                        // EMAIL SENT MESSAGE SUCCESFULLY
                        echo '
                                <p style="color:black">Password sent, check email!</p> 
                        '; 
                    }
                    }else{ // EMAIL DOESNT EXIST MESSAGE
                        echo '
                                <p style="color:red">Email Doesn\'t exist!</p>
                        ';
                    }
                }
            }else{ // EMAIL DOESNT EXIST MESSAGE
                        echo '
                                <p style="color:red">Email Doesn\'t exist!</p>
                        ';
                    }
            }
        } //WHAT HAPPENS AFTER CLICKING SEND PASSWORD ENDS
    ?>
        <p class="text-center" style="color:#965e24;">Input Email!</p>
        <div ng-app="">
            <form method="POST" action="forgot_password.php" class="form-horizontal well text-center reg_form" enctype="multipart/form-data" role="form" name="myForm">
                <div class="form-group">
                    <label class="col-sm-6 col-xs-6" for="forgot_email">Email Address
                                    </label>
                    <input type="email" name="forgot_email" id="forgot_email" placeholder="Input Email" class="col-sm-3 col-xs-6 focbk" ng-model="forgot_email" required>
                    <span style="color:red" ng-show="myForm.forgot_email.$dirty && myForm.forgot_email.$invalid">
                            <span ng-show="myForm.forgot_email.$error.required">Email is required.</span>
                    <span ng-show="myForm.forgot_email.$error.email">Invalid email address.</span>
                    </span>
                </div>
                <div class="form-group">
                    <label class="col-sm-6" for="forgot_submit">
                                    </label>
                    <input type="submit" name="forgot_submit" id="forgot_submit" value="Get My Password" class="btn btn-success btn-block cc" class="col-sm-6 col-xs-6">
                </div>
            </form>
        </div>
    </div>
</body>
