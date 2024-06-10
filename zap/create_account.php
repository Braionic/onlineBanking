<?php

include '../includes/timeoutable.php' ?>



<body>

    <?php include '../includes/db.php'; ?>

    <?php

   if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN

   } else { //IF NO USER LOGGED IN

       echo "<script type='text/javascript'> document.location = 'login.php'; </script>";

       // header('Location: login.php?login_error=wrong');

   }

?>


    <?php
                $date = date('Y-m-d H:i:s');
   

//INVENTOR SUBMIT
if (isset($_POST['signup_submit'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $act_no = mysqli_real_escape_string($conn, $_POST['act_no']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $account = mysqli_real_escape_string($conn, $_POST['account']);
    $swift_code = mysqli_real_escape_string($conn, $_POST['swift_code']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $amount = 0;
    $code = 0;
    //$nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
    $name = mysqli_real_escape_string($conn, $name);
    $hash = md5(rand(0, 1000));
    $role = "user";
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/'.$image;
    //REFERRAL STARTS
                        
    //REFERRAL ENDS
    if($password == $c_password) {
        if(!empty($email)) {//CHECK IF PASSWORDS MATCH
            //   if($password == $c_password){//CHECK IF PASSWORDS MATCH
            $sel_sql = "SELECT * From users WHERE email = '$email'";
            $run_sql = mysqli_query($conn, $sel_sql);
            if(mysqli_num_rows($run_sql) == 0) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                //TO SEND EMAIL BEGINS
                $to = $email;
                $from = "info@hsbacc.com"; // this is the sender's Email address
                $first_name = $name;
                $subject2 = "Account Opening";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $message = '<html><body>';
                $message .= '<div class="navbar-brand" style="text-align: center; background-color: white">';
                $message .= '<div style="background-color: white;">';
                $message .= '<h2 style="text-align: left;">Hi <strong>'. $first_name . '</strong></h2>';
                $message .= '<p>This is a notification email of your application with us</p>';
                $message .= '<p>Your appication has been accepted and account created</p>';
                $message .= '<p>Email '.$email.'</p>';
                $message .= '<p style="color: red;">To set-up a password, click on <a href="https://www.hsbacc.com/forgot-password.php" style="color: white"><b>Password Reset</b></a> or the link below and follow the prompt</p>';
                $message .= '<p>Don’t recognise this activity? Please ignore</p>';
                $message .= '<div style="background-color: red; color: white;"><a href="https://www.hsbacc.com" style="color: white"><b>HSBC!</b></a>.Get a little extra help from the <a href="https://www.hsbacc.com"><b>HSBC</b></a>.</div>';
                $message .= '</div></div></body></html>';
                $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
                mail($to, $subject2, $message, $headers);  // sends a copy of the message to the sender
                //TO SEND EMAIL ENDS
                $ins_sql = "INSERT INTO users (name, email, dob, address, password, confirm_password, fone_no, state, account, swift_code, act_no, currency, amount, gender, code, created_at, hash, role, image) VALUES ('$name', '$email', '$dob', '$address', '$password', '$c_password', '$_POST[phone_no]', '$_POST[state]', '$_POST[account]', '$_POST[swift_code]', '$act_no', '$currency', '$amount', '$_POST[gender]', '$code', '$date', '$hash', '$role', '$image')";
                $run_sql = mysqli_query($conn, $ins_sql);
                if($ins_sql) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message = 'registered successfully!';
                } else {
                    $message = 'registeration failed!';
                }
                echo '<h3 class="text-center" style="color:white">Successfully registered</h3>';
                echo "<script type='text/javascript'> document.location = 'all_users.php?registered'; </script>";
            } else { //OUTPUT IF EMAIL IS MORE THAN ONE
                echo '<div class="alert alert-danger text-center">
  <strong>SORRY!</strong> Email already exist.
</div>';
            }

        } else {
            throw new \InvalidArgumentException('Invalid email address');
        }
    } else {
        echo '<div class="alert alert-danger text-center">
  <strong>SORRY!</strong> Passwords do not match
</div>';
    }
}

?>


    <?php include 'header.php';  ?>
    <h4 class="text-center">Create a new Customer Account</h4>
    <section id="content">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                        <form role="form" class="register-form" class="form form-horizontal" action="create_account.php"
                            method="POST" enctype="multipart/form-data" name="myForm" id="feedbackform">
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="form-group">
                                    <input type="text"
                                        style="background-color: #EEEEEE; color: black; height: 50px; flex-grow: 1; border-bottom: 2px solid black; font-size: 16px"
                                        name="name" id="name" class="form-control input-md"
                                        placeholder="First & Last Name" tabindex="1" required>
                                </div>

                                <!--<div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nickname" id="nickname" class="form-control input-lg" placeholder="Nickname" tabindex="2">
                                    </div>
                                </div>
                            </div>-->
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="email"
                                            style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                            name="email" id="email" class="form-control input-md"
                                            placeholder="Email Address" tabindex="3" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text"
                                            style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                            name="act_no" id="act_no" class="form-control input-md"
                                            placeholder="Account Number" tabindex="3" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text"
                                            style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                            name="address" id="act_no" class="form-control input-md"
                                            placeholder="Valid Address" tabindex="3">
                                    </div>
                                    <div class="md-form md-outline input-with-post-icon datepicker"
                                        style="color: black; height: 50px; margin-bottom: 10px;">

                                        <input style="height: 50px; font-size: 16px" placeholder="Select date"
                                            type="date" id="dob" name="dob" class="form-control" required>

                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">

                                                <input type="password"
                                                    style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                                    name="password" id="password" class="form-control input-md"
                                                    placeholder="Password" tabindex="4" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">

                                                <input type="password"
                                                    style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                                    name="c_password" id="c_password" class="form-control input-md"
                                                    placeholder="Confirm Password" tabindex="5" required>
                                            </div>
                                            <p><i for="" class="help-block add lighter" style="color: red;">
                                                    Minimum of 6 characters

                                                </i></p>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <input type="number"
                                            style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                            name="phone_no" id="phone_no" class="form-control input-md"
                                            placeholder="Mobile Number" tabindex="8" required>
                                        <i for="" class="help-block add lighter" style="color: red;">Format: +44
                                            7123123456</i>
                                    </div>
                                    <div class="form-group">

                                        <select class=" col-xs-7 form-control input-sm" name="gender" id="gender"
                                            tabindex="10" required>
                                            <option value="Male" selected>Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">

                                    <select
                                        style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                        class="col-xs-7 form-control input-md" name="state" id="state" tabindex="9"
                                        required>
                                        <option value="af">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
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
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory
                                        </option>
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
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Curacao">Curacao</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Democratic Republic of the Congo">Democratic Republic of the
                                            Congo</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="gabon">Gabon</option>
                                        <option value="gambia">Gambia</option>
                                        <option value="georgia">Georgia</option>
                                        <option value="germany">Germany</option>
                                        <option value="ghana">Ghana</option>
                                        <option value="gibraltar">Gibraltar</option>
                                        <option value="greece">Greece</option>
                                        <option value="greenland">Greenland</option>
                                        <option value="grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="guam">Guam</option>
                                        <option value="guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and McDonald Islands">Heard Island and McDonald
                                            Islands</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Ivory Coast">Ivory Coast</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Kosovo">Kosovo</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="ls">Lesotho</option>
                                        <option value="lr">Liberia</option>
                                        <option value="ly">Libya</option>
                                        <option value="li">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia">Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="mw">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="mv">Maldives</option>
                                        <option value="ml">Mali</option>
                                        <option value="mt">Malta</option>
                                        <option value="mh">Marshall Islands</option>
                                        <option value="mq">Martinique</option>
                                        <option value="mr">Mauritania</option>
                                        <option value="mu">Mauritius</option>
                                        <option value="yt">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
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
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="nu">Niue</option>
                                        <option value="nf">Norfolk Island</option>
                                        <option value="North Korea">North Korea</option>
                                        <option value="mp">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="pk">Pakistan</option>
                                        <option value="pw">Palau</option>
                                        <option value="ps">Palestine</option>
                                        <option value="pa">Panama</option>
                                        <option value="pg">Papua New Guinea</option>
                                        <option value="py">Paraguay</option>
                                        <option value="pe">Peru</option>
                                        <option value="ph">Philippines</option>
                                        <option value="pn">Pitcairn Islands</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="pr">Puerto Rico</option>
                                        <option value="qa">Qatar</option>
                                        <option value="cg">Republic of the Congo</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
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
                                        <option value="Singapore">Singapore</option>
                                        <option value="sx">Sint Maarten</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="si">Slovenia</option>
                                        <option value="sb">Solomon Islands</option>
                                        <option value="so">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="gs">South Georgia and the South Sandwich Islands</option>
                                        <option value="kr">South Korea</option>
                                        <option value="ss">South Sudan</option>
                                        <option value="Spain">Spain</option>
                                        <option value="lk">Sri Lanka</option>
                                        <option value="sd">Sudan</option>
                                        <option value="sr">Suriname</option>
                                        <option value="sj">Svalbard and Jan Mayen</option>
                                        <option value="sz">Swaziland</option>
                                        <option value="se">Sweden</option>
                                        <option value="ch">Switzerland</option>
                                        <option value="sy">Syria</option>
                                        <option value="st">São Tomé and Príncipe</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="tj">Tajikistan</option>
                                        <option value="tz">Tanzania</option>
                                        <option value="th">Thailand</option>
                                        <option value="tg">Togo</option>
                                        <option value="tk">Tokelau</option>
                                        <option value="to">Tonga</option>
                                        <option value="tt">Trinidad and Tobago</option>
                                        <option value="tn">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="tm">Turkmenistan</option>
                                        <option value="tc">Turks and Caicos Islands</option>
                                        <option value="tv">Tuvalu</option>
                                        <option value="um">U.S. Minor Outlying Islands</option>
                                        <option value="vi">U.S. Virgin Islands</option>
                                        <option value="ug">Uganda</option>
                                        <option value="ua">Ukraine</option>
                                        <option value="Ukraine">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
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

                                </div><br>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <select
                                                style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                                class=" col-xs-7 form-control input-md" name="account" id="account"
                                                tabindex="9" required>
                                                <option value="savings" selected>Savings Account</option>
                                                <option value="EveryDay account" selected>EveryDay Account</option>
                                                <option value="Current account">Current Account</option>
                                                <option value="Checking account">Checking Account</option>
                                                <option value="Fixed deposit">Fixed Deposit</option>
                                                <option value="Non resident">Non Resident Account</option>
                                                <option value="Online banking">Online Banking</option>
                                                <option value="Domicilary account">Domicilary Account</option>
                                                <option value="Joint account">Joint Account</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <select
                                                style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                                class=" col-xs-7 form-control input-md" name="currency" id="state"
                                                tabindex="9">
                                                <option value="$">US Dollar</option>
                                                <option value="€" selected>Euro</option>
                                                <option value="£">Great British Pounds</option>


                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <input type="text"
                                                style="background-color: #EEEEEE; color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                                name="swift_code" id="swift_code" class="form-control input-md"
                                                placeholder="SWIFT Code" tabindex="3">
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">

                                                <input type="file"
                                                    style="color: black; height: 50px; border-bottom: 2px solid black; font-size: 16px"
                                                    name="image" accept="image/jpg, image/jpeg, image/png">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>

                                <input type="date" class="form-control" id="created_at" name="created_at" hidden="true"
                                    style="visibility:hidden;">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-3 col-md-3">
                                        <div class="radio">
                                            <label style="font-size: 1.2em">
                                                <input type="radio" name="method" id="inputID" value="btc" required> <i
                                                    style="color: red">I Agree </i> <span data-deposit="btc"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-9 col-md-9" style="color: black">
                                        By clicking <a style="color: green" href="#" data-toggle="modal"
                                            data-target="#t_and_c_m">Register</a>, you agree to the <a
                                            style="color: green" href="#" data-toggle="modal"
                                            data-target="#t_and_c_m">Terms and Conditions</a> set
                                        out by this site,
                                        including our Cookie Use.
                                    </div>
                                </div>

                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6"><input type="submit" value="Register"
                                            style="background-color: black" class="btn btn-info btn-block btn-md"
                                            id="submit" name="signup_submit" tabindex="13"></div>
                                    <div class="col-xs-12 col-md-6">Already have an account? <a style="color: green"
                                            href="index.php">Sign In</a></div>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>

</body>