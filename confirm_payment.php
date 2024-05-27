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
    <title>Pay & Transfer</title>
</head>

<?php

$date = date('Y-m-d H:i:s');

//INVENTOR SUBMIT
?>

<?php

    if(isset($_GET['fcc_error'])) { //TO OUTPUT LOGIN ERROR

        if($_GET['fcc_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY

            $fcc_err = "<div class='alert alert-danger'>Sorry! field was empty!</div>";

        } elseif($_GET['fcc_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS

            $fcc_err = "<div class='alert alert-warning'>Invalid FCC code, please contact your account officer!</div>";

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
                            <h2>Confirm payment</h2>
                            <?php if(isset($_GET['fcc_error'])) { //TO OUTPUT LOGIN ERROR

                                echo $fcc_err;

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
                                    <form method="post" action="confirm_payment.php" id="myform">
                                        <select name="acct_type" id="acct_type" class="form-control" disabled>
                                            <option value="saving" selected>
                                                <div
                                                    style="display: flex; align-items: center; justify-content: space-between">
                                                    <p><?php echo $_SESSION['account'] ?>
                                                    </p>
                                                    <p>(<?php echo $_SESSION['currency'] ?><?php echo $_SESSION['amount'] ?>)
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
                                    number</label>
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
                                        placeholder=<?php echo $rows['description'] ?>
                                    style="margin-bottom: 10px"
                                    type="text" disabled />
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
                                    style="flex-grow: 1"> FCC</label>
                                <div class="controls col-md-8" style="flex-grow: 1">

                                    <input class="input-md textinput textInput form-control" id="amount" name="cot"
                                        placeholder="enter FCC" style="margin-bottom: 10px" type="text" required />

                                </div>
                                <hr>
                            </div>
                            <div style="text-align: end; margin: 10px; position: relative">
                                <button class="btn btn-sm btn-danger" form="myform" name="check_cot">Continue</button>
                                </form>
                                <?php  ;
    }
} ?>

                                <?php

if(isset($_POST{'check_cot'})) { //IF LOGIN BTN HAS BEEN CLICKED

    if(!empty($_POST{'cot'})) { //CHECK IF EMAIL AND PASSWORD IS EMPTY

        $cot = mysqli_real_escape_string($conn, $_POST['cot']);

        $cot = mysqli_real_escape_string($conn, $cot);

        $sql = "SELECT * FROM int_transfer WHERE user_id = '$_SESSION[id]'"; //FOR USERS

        if($result1 = mysqli_query($conn, $sql)) { //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE

            if(mysqli_num_rows($result1) == 1) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE

            

                while($rows = mysqli_fetch_assoc($result1)) { //RETRIEVE INVENTOR DETAILS

                    $s_code = $rows['code'];

                    if($s_code != $cot) {

                        echo "<script type='text/javascript'> document.location = 'confirm_payment.php?fcc_error=wrong'; </script>";

                        //  header('Location: signin.php?login_error=wrong');

                    }

                }

                echo "<script type='text/javascript'> document.location = 'imf_confirmation.php?enter_imf_code'; </script>";

                //   header('Location: imf-verification.php');

            } else {

                echo "<script type='text/javascript'> document.location = 'confirm_payment.php?fcc_error=wrong'; </script>";

                //  header('Location: cot-process.php?login_error=wrong');
            } //
        } else {
            echo "<script type='text/javascript'> document.location = 'confirm_payment.php?cfcc_error=query_error'; </script>";

            // header('Location: cot-process.php?login_error=query_error');
        }
    } else {
        echo "<script type='text/javascript'> document.location = 'confirm_payment.php?fcc_error=empty'; </script>";

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