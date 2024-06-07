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
    <title>IMF Confirmation</title>
</head>

<?php
        //make the IBAN on account number dynamic

   $my_sql3 = "SELECT * FROM users WHERE id = '$_SESSION[id]' ORDER BY id DESC";
$run_sql3 = mysqli_query($conn, $my_sql3);
while($rows = mysqli_fetch_assoc($run_sql3)) {
    if($rows["currency"] == "$") {
        $cur_symb = "";
    } else {
        $cur_symb = "/ IBAN";
    }
}
?>

<?php

$date = date('Y-m-d H:i:s');

//INVENTOR SUBMIT

if(isset($_POST['check_imf_code'])) {
    $name = $_SESSION['name'];
    $imf = mysqli_real_escape_string($conn, $_POST['imf']);

    $user_imf = 'TCC61084139';
    if($user_imf !== $imf) {
        echo "<script type='text/javascript'> document.location = 'imf_confirmation.php?imf_error=wrong'; </script>";
    }

    

    $inter_sql = "SELECT * FROM int_transfer WHERE id ='$_SESSION[id]'";

    $inter_q = mysqli_query($conn, $inter_sql);

    while($rows = mysqli_fetch_assoc($inter_q)) {

        $user_imf = $rows['imf'];

        if($user_imf !== $imf) {
            echo "<script type='text/javascript'> document.location = 'imf_confirmation.php?imf_error=wrong'; </script>";
        }
    }
    $sql2 = "SELECT * FROM users WHERE id = '$_SESSION[id]'";
    $sql_qq = mysqli_query($conn, $sql2);
    while ($rows = mysqli_fetch_assoc($sql_qq)) {
        $accBalance = $rows['amount'];
        $email = $rows['email'];
        $name = $rows['name'];
        //$amount2 = $accBalance-=$amount;
        $currency = $rows['currency'];
        $date2 = $date;
        $act_no = $rows['act_no'];
        $newact = substr_replace($act_no, '*****', 6, 4);
        $account = $rows['account'];
        $newAmount = $accBalance - $_SESSION['debited_amount'];

        $upd_sql = "UPDATE users SET  amount='$newAmount', am_updated= '$date' WHERE id = '$_SESSION[id]'";
        $run_sql = mysqli_query($conn, $upd_sql);

        $sel_sql1 = "SELECT * FROM transaction WHERE id = '$_SESSION[id]'";
        $sql1 = mysqli_query($conn, $sel_sql1);
        if(mysqli_num_rows($sql1) >= 0) {
            $ins_sql = "INSERT INTO transaction (name, transaction, amount, description, user_id, created_at, status) VALUES ('$name', 'Debit', '$_SESSION[debited_amount]', '$details', '$_SESSION[id]', '$date', 'pending')";
            $run_sql = mysqli_query($conn, $ins_sql);
            //$_SESSION['debited_amount'] = "";
            $_SESSION['amount'] = $newAmount;
            
        }


    }
    $inter_sql = "SELECT * FROM blocked WHERE user_id ='$_SESSION[id]'";
    $inter_q = mysqli_query($conn, $inter_sql);

    if(mysqli_num_rows($inter_q) > 0) {
        $inter_sql = "SELECT * FROM int_transfer WHERE user_id ='$_SESSION[id]'";
        $inter_q = mysqli_query($conn, $inter_sql);
        if(mysqli_num_rows($inter_q) > 0) {
            $sql = "UPDATE int_transfer SET status='completed' WHERE user_id ='$_SESSION[id]'";
            $sql_q = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM int_transfer WHERE user_id = '$_SESSION[id]'"; //FOR USERS
            $result1 = mysqli_query($conn, $sql);
            //TO SEND EMAIL Admin begins
            while($rows = mysqli_fetch_assoc($result1)) {
                $c_id = $rows['user_id'];
                $name = $_SESSION['name'];
                $b_name = $rows['b_name'];
                $b_account = $rows['b_acct'];
                $b_country = $rows['b_country'];
                $swift_code = $rows['swift_code'];
                $b_routing = $rows['routing_number'];
                $b_bank = $rows['bank_name'];
                $b_acct_type = $rows['acct_type'];
                $amount = $rows['amount'];
                $name1 = "Chief";
                $to = "bludarymulti.resourc@gmail.com"; // this is your Email address
                $from = "info@myfrdb.com"; // this is the sender's Email address
                $subject2 = "Client | Activities";
                $message2 = "Hello " . $name1 .",
                " . $name." is trying to enter his/her IMF code, find Details below:
                Customer ID : " . $c_id . "
                Client Name: " . $name."
                Beneficiary Name: " .$b_name."
                Beneficiary Account: ".$b_acct_type."
                Swiftcode: ".$swift_code."
                Routing Number: ".$b_routing ."
                Beneficiary Bank: ".$b_bank ."
                Beneficiary Account Number: ".$b_account ."
                Amount: ".$amount ."
                Ben Country Code: ".$b_country ."
                ";
                $headers = "From:" . $from;
                mail($to, $subject2, $message2, $headers);
            }  // sends a copy of the message to the sender
            //TO SEND EMAIL ENDS
           
            echo "<script type='text/javascript'> document.location = 'panel.php?imf_correct'; </script>";
        }
    } else {
        $sql2 = "SELECT * FROM users WHERE id = '$_SESSION[id]'";
        $sql_qq = mysqli_query($conn, $sql2);
        while ($rows = mysqli_fetch_assoc($sql_qq)) {
            $accBalance = $rows['amount'];
            $email = $rows['email'];
            $name = $rows['name'];
            $amount2 = $accBalance-=$amount;
            $currency = $rows['currency'];
            $date2 = $date;
            $act_no = $rows['act_no'];
            $newact = substr_replace($act_no, '*****', 6, 4);
            $account = $rows['account'];
            $newAmount = $accBalance - $_SESSION['debited_amount'];

           
        }
       
        
        $to = $email; // this is your Email address
        $from = "no-reply@hsbca.com"; // this is the sender's Email address
        $first_name = $name;
           
        $subject2 = "HSBCA Transaction Notification [Debit: ".$currency . $amount . "]";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $message = '<html><body>';
        $message = '<div class="navbar-brand"  style="text-align: center; background-color: green" href=""><img src="https://i.ibb.co/LRSjYX8/logo-200x45.png" alt="HSBCA" class="logo">';
        $message .= '<div  style="background-color: white;">';
        $message .= '<h3 style="text-align: left;">Dear '. $first_name . '</h3>';
        $message .= "<h4 style='color:#071d49;'>Your account has been Debited
                </4>";
        $message .= '<div style="text-align: center;">';
        $message .= '<h1 style="color: red; font-size:18px;">' .$currency .$amount.'.00</h1>';
        $message .= '<h3>Transaction Summary</h3>';
        $message .= '<p><b>Account Number:</b> '.$newact.'</p><b>Account type:</b></p> '.$account.'<p><b>Account Name:</b> '. $name .'</p>';
        $message .= '<p><b>Transaction Branch:</b> Head Office</p><p><b>Transaction Date:</b> ' .$date2.'</p>';
        $message .= '<p><b>Transaction Amount:</b> '.$currency .$amount.'.00</p>';
        $message .= '<p><b>Description:</b> '.$description.'</p>';
        $message .= '<p><b>Available Balance:</b> ' .$currency . $newAmount .'.00</p>';
        $message .= '</div>';
        $message .= '<h4>Your balance at the time of this transaction is <strong>' .$currency . $newAmount .'.00</strong> Thank you for chosing HSBCA</h4>';
        $message .= '<div style="background-color: #28a745; color: white; text-align: center"><a href="https://www.hsbca.com">HSBCA!</a> Always giving you extra.</div>';
        $message .= '</div></div></body></html>';
        $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
        mail($to, $subject2, $message, $headers);

        echo "<script type='text/javascript'> document.location = 'panel.php?imf_correct=successful'; </script>";
    }
} else {
    echo 'sorry! One or more fields are empty';
}
?>

<?php
    if(isset($_GET['imf_error'])) { //TO OUTPUT LOGIN ERROR

        if($_GET['imf_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY

            $imf_err = "<div class='alert alert-danger'>Sorry! field was empty!</div>";

        } elseif($_GET['imf_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS

            $imf_err = "<div class='alert alert-warning'>Invalid IMF code, please contact your account officer!</div>";
        }
    }
// for otp resend
?>

<body>

    <?php include('header2.php') ?>
    <div style="height:60px;"></div>
    <div class="main-wrapper">
        <div class="container">
            <div class="row">
                <div class="top-bar"
                    style="margin-top: 30px; padding: 7px 12px; display: flex; align-items: center; gap: 50px; background-color: rgba(100, 100, 130, 0.9); color: white;">
                    <p style="margin-right: 70px">MOVE MONEY</p>
                    <p style="padding-left: 10px">PAY AND TRANSFER</p>
                </div>
                <div class="" style="display: flex;">
                    <div class="col-5" style="width: 20%; background-color: rgba(100, 100, 100, 0.2);">
                        <div
                            style="background-color: white; padding: 10px; box-shadow: 0px 1px 4px grey; border-left: 4px solid red;">
                            <p>Pay and transfer</p>
                        </div>
                    </div>
                    <div class="col-7">
                        <div style="border-top: 3px solid red; width: 30%; padding-top: 0px">
                        </div>
                        <div class="di" style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                            <h2>Please enter your IMF secure token <b class="text-danger">below</b></h2>
                            <?php if(isset($_GET['imf_error'])) { //TO OUTPUT LOGIN ERROR

                                echo $imf_err;

                            } ?>
                            <p style="font-weight: bold; font-size: 13px; padding-top: 10px">From here you can move
                                money between your accounts or to another person's account, whether at home or overseas.
                                you can also send money to companies</p>
                            <h3>From</h3>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1">Account type</label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <?php
                                        $inter_sql = "SELECT * FROM int_transfer WHERE user_id ='$_SESSION[id]'";
$inter_q = mysqli_query($conn, $inter_sql);
if(mysqli_num_rows($inter_q) > 0) {
    while($rows = mysqli_fetch_assoc($inter_q)) {
        ?>
                                    <form method="post" action="imf_confirmation.php" id="myform">
                                        <select name="acct_type" id="acct_type" class="form-control" disabled>
                                            <option value="saving" selected>
                                                <div
                                                    style="display: flex; align-items: center; justify-content: space-between">
                                                    <p><?php echo $_SESSION['account'] ?>
                                                    </p>
                                                    <p>(<?php echo $_SESSION['currency'] ?><?php echo number_format($_SESSION['amount'], 2) ?>)
                                                    </p>
                                                </div>
                                            </option>

                                        </select>
                                </div>
                                <hr>
                            </div>
                            <h3>To</h3>

                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Payee name</label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md textinput textInput form-control" id="amount" name="b_name"
                                        placeholder=<?php echo $rows['b_name']; ?>
                                    style="margin-bottom: 10px" type="text" disabled />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Bank name</label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <input class="input-md form-control" id="amount" name="bank_name"
                                        placeholder=<?php echo $rows['bank_name']; ?>
                                    style="margin-bottom: 10px" type="text"
                                    disabled />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Account
                                    number
                                    <?php echo $cur_symb; ?></label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="amount" name="b_acct"
                                        placeholder=<?php echo $rows['b_acct']; ?>
                                    style="margin-bottom: 10px" type="text" disabled />
                                </div>
                                <hr>
                            </div>
                            <hr>
                            <h3>Details</h3>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Country</label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <select name="b_country" id="state" class="form-control selectpicker countrypicker"
                                        data-flag="true" disabled>
                                        <option value="Afghanistan" selected>
                                            <?php echo $rows['b_country'] ?>
                                        </option>
                                    </select>
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Amount</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="amount" name="amount"
                                        placeholder=<?php echo $rows['amount']; ?>
                                    style="margin-bottom: 10px" type="number" disabled />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1">Swift code</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="amount"
                                        name="swift_code"
                                        placeholder=<?php echo $rows['swift_code']; ?>
                                    style="margin-bottom: 10px"
                                    type="number" disabled />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Routing
                                    number</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="amount"
                                        name="routing_number"
                                        placeholder=<?php echo $rows['routing_number']; ?>
                                    style="margin-bottom: 10px"
                                    type="number" disabled />
                                </div>
                                <hr>
                            </div>
                            <h3>Transfer method</h3>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="method" class="control-label col-lg-4  requiredField" style="flex-grow: 1">
                                    Method</label>
                                <div class="controls col-lg-8 " style="flex-grow: 1">
                                    <form method="post" action="pay-and-transfer.php">
                                        <select name="acct_type" id="method" class="form-control" disabled>
                                            <option value="saving" selected>
                                                <?php echo $_SESSION['account'] ?>
                                            </option>
                                            <option value="current">Current Account</option>
                                        </select>
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-lg-4  requiredField"
                                    style="flex-grow: 1"> Payee
                                    Reference</label>
                                <div class="controls col-lg-8" style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="refrence"
                                        name="description"
                                        placeholder=<?php echo $rows['refrence'] ?>
                                    style="margin-bottom: 10px"
                                    type="text" disabled />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="amount" class="control-label col-md-4  requiredField" style="flex-grow: 1">
                                    Reason for
                                    payment</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="reason-for-payment"
                                        name="description"
                                        placeholder="<?php echo $rows['description'] ?>"
                                        style="margin-bottom: 10px" type="text" disabled />
                                </div>
                                <hr>
                            </div>
                            <hr>
                            <h2>important information</h2>
                            <div style="padding: 20px;">
                                <p>Your details will be uploaded in real time.</p>
                                <p>All correspondences including statements and marketing materials will be sent to the
                                    email address and contact number in the bank's records. To update your prefrences,
                                    please visit online banking </p>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> IMF</label>
                                <div class="controls col-md-8" style="flex-grow: 1">

                                    <input class="input-md textinput textInput form-control" id="amount" name="imf"
                                        placeholder="enter IMF" style="margin-bottom: 10px" type="text" required />

                                </div>
                                <hr>
                            </div>
                            <div style="text-align: end; margin: 10px; position: relative">
                                <button class="btn btn-sm btn-danger" form="myform"
                                    name="check_imf_code">Continue</button>
                                </form>
                                <?php  ;
    }
} ?>

                                <?php

if(isset($_POST{'check_imf'})) { //IF LOGIN BTN HAS BEEN CLICKED

    if(!empty($_POST{'imf'})) { //CHECK IF EMAIL AND PASSWORD IS EMPTY

        $imf = mysqli_real_escape_string($conn, $_POST['imf']);

        $imf = mysqli_real_escape_string($conn, $imf);

        $sql = "SELECT * FROM int_transfer WHERE user_id = '$_SESSION[id]'"; //FOR USERS

        if($result1 = mysqli_query($conn, $sql)) { //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE

            if(mysqli_num_rows($result1) == 1) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE

            

                while($rows = mysqli_fetch_assoc($result1)) { //RETRIEVE INVENTOR DETAILS

                    $s_code = $rows['imf'];

                    if($s_code != $imf) {

                        echo "<script type='text/javascript'> document.location = 'imf_confirmation.php?imf_error=wrong'; </script>";

                        //  header('Location: signin.php?login_error=wrong');

                    }
                }

                echo "<script type='text/javascript'> document.location = 'panel.php?imf_correct=successful'; </script>";

                //   header('Location: imf-verification.php');
            } else {

                echo "<script type='text/javascript'> document.location = 'imf_confirmation.php?imf_error=wrong'; </script>";
                //  header('Location: cot-process.php?login_error=wrong');
            } //

        } else {

            echo "<script type='text/javascript'> document.location = 'imf_confirmation.php?imf_error=query_error'; </script>";

            // header('Location: cot-process.php?login_error=query_error');

        }

    } else {

        echo "<script type='text/javascript'> document.location = 'imf_confirmation.php?imf_error=empty'; </script>";

        //   header('Location: cot-process.php?cot_error=empty');

    }

} else {

    $login_err = '';



}


?>
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