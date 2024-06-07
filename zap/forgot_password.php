<?php include '../includes/timeoutable.php' ?>
<?php 
        include '../includes/db.php';
    ?>
    <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
      //  header('Location: index.php');
    } else { //IF NO USER LOGGED IN
    }
?>

        <body>
            <?php include 'header.php'; ?>
                <div style="height:20px;"></div>
                <!--FOR SPACE -->
                <div class="container">
                    <?php //WHAT HAPPENS AFTER CLICKING SEND PASSWORD BEGINS
        if(isset($_POST['forgot_submit'])){
            if(!empty($_POST['forgot_email'])) {
                $forgot_email = $_POST['forgot_email'];
                $sel_sql = "SELECT * From admins WHERE email = '$forgot_email'";
                $run_sql = mysqli_query($conn,$sel_sql);
                if(mysqli_num_rows($run_sql) == 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                while($rows = mysqli_fetch_assoc($run_sql)) {
                    if($_POST['forgot_email'] == $rows['email']) {
                         //TO SEND EMAIL BEGINS
                 $to = $_POST['forgot_email']; // this is your Email address
                $from = "hsbca.com"; // this is the sender's Email address
                $first_name = $rows['name'];
               // $last_name = $_POST['last_name'];
                $password = $rows['password'];
               // $subject = "Form submission";
                $subject2 = "HSBCA Password";
               // $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
                $message2 = "" . $first_name ." this is your password for HSBCA: " . $password . ". Do not disclose to anyone!";

                $headers = "From:" . $from;
              //  $headers2 = "From:" . $to;
              //  mail($to,$subject,$message,$headers);
                mail($to,$subject2,$message2,$headers); // sends a copy of the message to the sender
                // You can also use header('Location: thank_you.php'); to redirect to another page.
                //TO SEND EMAIL ENDS
                        // EMAIL SENT MESSAGE SUCCESFULLY
                        echo '
                                <p style="color:green">Request sent!</p> 
                        '; 
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
                        <p class="text-center" style="color:#965e24;">Enter your email address and your password will be sent to you!</p>
                        <div ng-app="">
                            <form method="POST" action="forgot_password.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="forgot_email">Email Address
                                    </label>
                                    <input type="email" name="forgot_email" id="forgot_email" placeholder="Input Email" class="col-sm-3 col-xs-3 focbk" ng-model="forgot_email" required>
                                    <span style="color:red" ng-show="myForm.forgot_email.$dirty && myForm.forgot_email.$invalid">
                            <span ng-show="myForm.forgot_email.$error.required">Email is required.</span>
                                    <span ng-show="myForm.forgot_email.$error.email">Invalid email address.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6" for="forgot_submit">
                                    </label>
                                    <input type="submit" name="forgot_submit" id="forgot_submit" value="Reset" class="btn btn-primary cc" class="col-sm-6 col-xs-6">
                                </div>
                            </form>
                        </div>
                </div>
                <?php include 'footer.php' ?>
        </body>