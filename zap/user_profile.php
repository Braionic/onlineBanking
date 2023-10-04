<?php include '../includes/timeoutable.php' ?>

    <body>
        <?php include '../includes/db.php'; ?>
            <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
         echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
      //  header('Location: login.php?login_error=wrong');
    }
?>
                <?php
    if(isset($_GET['person_id'])) {
    }else{
         header('Location: index.php');
    }
    ?>
                    <?php include 'header.php';  ?>
                        <!-- AFTER SENDING MESSAGE BEGINS-->
                        <?php  
        if(isset($_POST['message_submit'])) {
            if(!empty($_POST['message'])) {
            $sel_sql = "SELECT * FROM users WHERE id = '$_GET[message_id]'";
            $run_sql = mysqli_query($conn,$sel_sql);
            while($rows = mysqli_fetch_assoc($run_sql)){
                $date = date('Y-m-d h:1:s');
                $mess = strip_tags($_POST['message']);
                $message = ''.$mess.'. Thank You!';
                $title = $_POST['title'];
                $ins_sql = "INSERT INTO messages (title, receiver, sender, message, receiver_id, sent_time) VALUES ('$title', '$rows[name]', 'Admin', '$message', '$rows[id]', '$date')";
                $message_sql = mysqli_query($conn,$ins_sql);
            }
                echo "<script type='text/javascript'> document.location = 'all_users.php?message_sent'; </script>";
           //  header('Location: all_users.php?message_sent');
            }else{
                 echo "<script type='text/javascript'> document.location = 'user_profile.php?message_empty'; </script>";
             //   header('Location: user_profile.php?message_empty');
            }
        }
        
    ?>
                            <!-- AFTER SENDING MESSAGE ENDS-->
                            <div class="container">
                                <?php //DELETE FROM PROVIDE TABLE BEGINS
                                     if(isset($_POST["delete_submit"])){
                                 $sql = "DELETE FROM users WHERE id = '$_GET[user_id]'";
                                 $delete_sql = mysqli_query($conn,$sql);
                                         echo '<p>User Deleted Successfully</p>';
                              //   header('Location: my_matches.php');
                      //DELETE FROM PROVIDE TABLE ENDS
                             }
                        ?>
                                    <?php //BLOCK FROM PROVIDE TABLE BEGINS
                                     if(isset($_POST["block_submit"])){
                                         $block = "b7kXyH9!rmFB!B";
                                         $ins_sql = "UPDATE users SET password='$block', confirm_password='$block' WHERE id = '$_GET[user_id]'";
                                            $run_sql = mysqli_query($conn,$ins_sql);
                                         echo '<p>User Blocked Successfully</p>';
                              //   header('Location: my_matches.php');
                      //DELETE FROM PROVIDE TABLE ENDS
                             }
                        ?>
                                        <!-- SEND MESSAGE BEGINS-->
                                        <?php  
                        $sel_sql = "SELECT * FROM users WHERE id = '$_GET[person_id]'";
                        $run_sql = mysqli_query($conn,$sel_sql);
                        while($rows = mysqli_fetch_assoc($run_sql)){
                             echo '
                             <h4>Full Name: '.$rows['name'].'</h4>
                             <h4>Email Address: '.$rows['email'].'</h4>
                             <h4>Gender: '.$rows['gender'].'</h4>
                             <h4>Bank: '.$rows['bank'].'</h4>
                             <h4>Account Number: '.$rows['act_no'].'</h4>
                             <h4>Phone: '.$rows['fone_no'].'</h4>
                             <h4>Country: '.$rows['state'].'</h4>
                             <h4>Reseller: '.$rows['nickname'].'</h4>
                             
                             <form method="POST" action="all_users.php?user_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Delete User?\')" name="delete_submit" id="delete_submit" value="Delete User" class="btn btn-danger delete_acct">
                    </form>
                    <form method="POST" action="all_users.php?user_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Block User?\')" name="block_submit" id="block_submit" value="Block User" class="btn btn-warning delete_acct">
                    </form>
                             
                             
                        <h4 class="text-center">Send '.$rows['name'].' A Message</h4>
                        <form method="POST" action="user_profile.php?message_id='.$rows['id'].'" class="form-horizontal well text-center send_msg" enctype="multipart/form-data" role="form">
                            <div class="form-group">
                                <label class="col-sm-6 col-xs-6" for="title">Title
                                </label>
                                <input type="text" name="title" id="title" placeholder="Enter Title" class="col-sm-3 col-xs-3" required>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 col-xs-6" for="message">Message
                                </label>
                                <textarea name="message" id="message" class="col-sm-3 col-xs-3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6" for="message_submit">
                                </label>
                                <input type="submit" name="message_submit" id="message_submit" value="message" class="btn btn-info cc" class="col-sm-6 col-xs-6">
                            </div>
                        </form>
                        ';
                        }
                        ?>
                                            <!-- SEND MESSAGE ENDS-->
                                            <!-- SHOW RECEIVED MESSAGES BEGINS-->
                                            <div class="container-fluid">
                                                <div class='panel panel-default panel-success'>
                                                    <div class='panel-heading'>
                                                        <h4 class="text-center">User Messages</h4>
                                                    </div>
                                                    <div id="accordion">
                                                        <?php
                                $sql = "SELECT * FROM messages WHERE receiver_id = '$_GET[person_id]' ORDER BY id DESC"; //FOR USERS
                                $run_sql = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($run_sql) >= 1){
                                while($rows = mysqli_fetch_assoc($run_sql)){ 
                                echo "
                                        <h3 class='text-center'>" . $rows['title'] . "<i class='pull-right'>From: " . $rows['sender'] . "</i></h3>
                                        <div class='panel-body'>
                                            <p>
                                               " . $rows['message'] . "
                                            </p>
                                        </div>
                                ";
                                }
                                } else{
                                     echo "
                                        <h3 class='text-center' style='color:red;'>You have no messages</h3>
                                        <div class='panel-body'>
                                            <p class='text-center' style='color:red;'></p>
                                        </div>
                                ";
                                }
                                
                                ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- SHOW RECEIVED MESSAGES ENDS-->
                                            <!-- SHOW queries BEGINS-->
                                            <div class="container-fluid">
                                                <div class='panel panel-default panel-success'>
                                                    <div class='panel-heading'>
                                                        <h4 class="text-center">Queries</h4>
                                                    </div>
                                                    <div id="accord">
                                                        <?php
                                $sql = "SELECT * FROM contact WHERE user_id = '$_GET[person_id]' ORDER BY id DESC"; //FOR USERS
                                $run_sql = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($run_sql) >= 1){
                                while($rows = mysqli_fetch_assoc($run_sql)){ 
                                echo "
                                        <h3 class='text-center'>" . $rows['title'] . "<i class='pull-right'>" . $rows['created_at'] . "</i></h3>
                                        <div class='panel-body'>
                                            <p>
                                               " . $rows['body'] . "
                                            </p>
                                        </div>
                                ";
                                }
                                } else{
                                     echo "
                                        <h3 class='text-center' style='color:red;'>No Queries</h3>
                                        <div class='panel-body'>
                                            <p class='text-center' style='color:red;'></p>
                                        </div>
                                ";
                                }
                                
                                ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- SHOW queries ENDS-->
                                            <!-- SHOW PAYMENTS BEGINS-->
                                            <h3 class="text-center" style="text-decoration:underline;">User Payments</h3>
                                            <h4 class="text-center">Confirmed and Pending Paymnents</h4>
                                            <p style="color:orangered;"><i style="color:blue;">After you have been confirmed, you will be enlisted to receive payment.</i>
                                                <br>If given time has expired and you have not made payment, your account will be put on hold.
                                                <br>Please make payment before the specified time is over to avoid being blocked!</p>
                                            <!--MATCH QUERY BEGINS-->
                                            <?php
    echo'

    ';
            $match_sql= "SELECT * FROM matches ORDER BY id DESC";
            $sql= mysqli_query($conn,$match_sql);
            if(mysqli_num_rows($sql) >= 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
            while($rows = mysqli_fetch_assoc($sql)){
                //TIME QUERY BEGINS
               
               $dat = date("Y-m-d H:i:s"); //MAKE NEW DATE
                $timestamp = strtotime($dat); //CHANGE DATESTRING TO TIME
                $new_date_format = date('Y-m-d H:i:s', $timestamp); //GET TIME ABOVE IN FORMAT STATED HERE
                $da = new DateTime($new_date_format); //MAKE TIME ABOVE AS NEW DATETIME
                $da->modify("+1 hours"); //ADD TIME TO DATE
                $d = $da->format("Y-m-d H:i:s"); // CONVERT 'da' TO FORMAT HERE
               // $datetime1 = date_create("2017-02-05 21:40:10");
                $curentdate = date("Y-m-d H:i:s"); //MAKE NEW DATE
                $datetime1 = date_create($curentdate); //CREATE NEW DATE
                $datetime2 = new DateTime($rows['created_at']); //CREATE NEW DATE
                $oldtime = new DateTime($rows['created_at']); //CREATE NEW DATE
                $oldtime->modify("+6 hours"); //ADD TIME TO DATE
                $old = $oldtime->format("Y-m-d H:i:s"); // CONVERT 'da' TO FORMAT HERE
                $oldtime_plus_addtime = date_create($old); //MAKE NEW DATE
                $datetime3 = $datetime2->format("Y-m-d H:i:s"); // CONVERT 'datetime2' TO FORMAT HERE
         //       $interval = $datetime1->diff($datetime2); //DIFF BTW TWO DATETIME
               $interval = $oldtime_plus_addtime->diff($datetime1); //DIFF BTW TWO DATETIME
                //$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %S seconds');
                $elapsed = $interval->format('%h hrs %i mins %S secs'); //GET DIFF BTW DATES IN FORMAT HERE
           //     echo $elapsed;
               
                echo '
                <!--TIME FOR REFERRAL STARTS-->
                                <script>
                                    // Set the date we\'re counting down to
                                    //  var countDownDate = new Date("Feb 25, 2017 13:37:00").getTime();
                                    var countDownDate = new Date("'.$old.'").getTime();
                              //   countDownDate.setHours(countDownDate.getHours() + 6);
                            //        var countDownDate = countdown.getTime();

                                    // Update the count down every 1 second
                                    var x = setInterval(function () {

                                        // Get todays date and time
                                        var now = new Date().getTime();

                                        // Find the distance between now an the count down date
                                        var distance = countDownDate - now;
                                    //    var distance = now - countDownDate;

                                        // Time calculations for days, hours, minutes and seconds
                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                   
                                        // Output the result in an element with id="demo"
                                        document.getElementById("demo").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";
                                        // If the count down is over, write some text 
                                        if (distance < 0) {
                                            clearInterval(x);
                                            document.getElementById("demo").innerHTML = "TIME ELAPSED";
                                            document.getElementById("dem").innerHTML = "Referral Time Over";
                                        }
                                    }, 1000);
                                </script>

                                <!--TIME FOR REFERRAL ENDS-->
                ';
                
                
                
                
                //TIME QUERY ENDS
                if($rows['provider_id'] != 0 || $rows['receiver_id'] != 0){ //CHECK IF PROVIDER_ID OR RECEIVER_ID IS EMPTY 
                if($rows['provider_id'] == $_GET['person_id'] || $rows['receiver_id'] == $_GET['person_id']){ //IF PROVIDER ID
                          if($rows['confirm'] == 'pending'){ //IF PROVIDER ID
                            $provider_sql = "SELECT * FROM users WHERE id = '$rows[provider_id]'"; //PROVIDER SQL
                            $p_sql = mysqli_query($conn,$provider_sql);
                            while($rowp = mysqli_fetch_assoc($p_sql)){
                                echo '
                                <div class="row payment_row" style="background-color:#e8b85f;">
                                    <div class="col-xs-4"><span>.'.$rows['rematch'].'</span></div>
                                    <div class="col-xs-8"><span>.</span></div>
                                    <div class="col-xs-4"><span>Package:</span></div>
                                    <div class="col-xs-8"><span>'.$rows['amount'].'</span></div>
                                    <div class="col-xs-4"><span style="color:red;">Donator:</span></div>
                                    <div class="col-xs-8"><span>'.$rowp['name'].'(<b style="color:black;">'.$rowp['id'].'</b>);</span></div>
                                ';
                        }
                            $receiver_sql = "SELECT * FROM users WHERE id = '$rows[receiver_id]'"; //RECEIVER SQL
                            $r_sql = mysqli_query($conn,$receiver_sql);
                            while($rowr = mysqli_fetch_assoc($r_sql)){
                                echo '
                                    <div class="col-xs-4"><span style="color:red;">Receiver:</span></div>
                                    <div class="col-xs-8"><span>'.$rowr['name'].'(<b style="color:black;">'.$rowr['id'].'</b>);</span></div>
                                    <div class="col-xs-4"><span>Bank:</span></div>
                                    <div class="col-xs-8"><span>'.$rowr['bank'].'</span></div>
                                    <div class="col-xs-4"><span>Act no:</div>
                                    <div class="col-xs-8"><span>'.$rowr['act_no'].'</span></div>
                                    <div class="col-xs-4"><span>Phone:</div>
                                    <div class="col-xs-8"><span>'.$rowr['fone_no'].'</span></div>
                                    <div class="col-xs-4"><span>Pop:</div>
                                    <div class="col-xs-8"><a href="../'.$rows['image'].'" target="blank"><img src="../'.$rows['image'].'" width="40px;" height="20px;"></a></div>
                                    ';
                                if($_SESSION['id'] == 1){
                                    echo '
                                    <div class="col-xs-4"><span>Proof:</span></div>
                                    <div class="col-xs-8">
                                        <span><form method="POST" action="paired_donations.php?confirm_id='.$rows['id'].'" class="form-horizontal" enctype="multipart/form-data" role="form">
                                        <input type="text" name="confirm" id="confirm" value="admin confirmed" hidden="true" style="visibility:hidden;">
                                        <input type="text" name="provider" id="provider" value="'.$rows['provider_id'].'" hidden="true" style="visibility:hidden;">
                                        <input type="submit" name="confirm_submit" value="Confirm" style="color:green;" onclick="show_alert();">
                                    </form></span>
                                    </div>';
                                     echo '
                                    <div class="col-xs-4"><span>Delete:</span></div>
                                    <div class="col-xs-8">
                                        <span></form><form method="POST" action="paired_donations.php?match_id='.$rows['id'].'" enctype="multipart/form-data">
                                        <input type="submit" onClick="return confirm(\'Delete Match?\')" name="delete_submit" id="delete_submit" value="Delete Match" class="btn btn-xs btn-danger delete_acct">
                                        </form></span>
                                        </div>';
                                }
                                echo '
                                    <div class="col-xs-4"><span>Status:</span></div>
                                    <div class="col-xs-8"><span>'.$rows['confirm'].'</span></div>
                                    <div class="col-xs-4"><span>Started:</div>
                                    <div class="col-xs-8"><span>'.$rows['created_at'].'</span></div>
                                ';
                        }
                    echo '
                    ';
                   // if(date("Y-m-d H:i:s") < $datetime3) {
                    if(date("Y-m-d H:i:s") < $old) {
                    echo '
                         <div class="col-xs-4"><span>Timeleft:</span></div>
                        <div class="col-xs-8"><span id="d">'.$elapsed.'</span></div>
                        </div>
                    ';
                    }else{
                      echo '
                        <div class="col-xs-4"><span>Timeleft:</span></div>
                        <div class="col-xs-8"><span>finished</span></div>
                        </div>
                    ';  
                    }    //CONFIRM STARTS
                }else{
                    if($rows['confirm'] == 'confirmed' || $rows['confirm'] == 'admin confirmed'){ //IF PROVIDER ID
                                 $provider_sql = "SELECT * FROM users WHERE id = '$rows[provider_id]'"; //PROVIDER SQL
                            $p_sql = mysqli_query($conn,$provider_sql);
                            while($rowp = mysqli_fetch_assoc($p_sql)){
                                echo '
                               <div class="row payment_row" style="background-color:#4848e3;">
                                    <div class="col-xs-4"><span>.'.$rows['rematch'].'</span></div>
                                    <div class="col-xs-8"><span>.</span></div>
                                    <div class="col-xs-4"><span>Package:</span></div>
                                    <div class="col-xs-8"><span>'.$rows['amount'].'</span></div>
                                    <div class="col-xs-4"><span style="color:#810000;">Donator:</span></div>
                                    <div class="col-xs-8"><span>'.$rowp['name'].'(<b style="color:black;">'.$rowp['id'].'</b>);</span></div>
                                ';
                        }
                            $receiver_sql = "SELECT * FROM users WHERE id = '$rows[receiver_id]'"; //RECEIVER SQL
                            $r_sql = mysqli_query($conn,$receiver_sql);
                            while($rowr = mysqli_fetch_assoc($r_sql)){
                                echo '
                                     <div class="col-xs-4"><span style="color:#810000;">Receiver:</span></div>
                                    <div class="col-xs-8"><span>'.$rowr['name'].'(<b style="color:black;">'.$rowr['id'].'</b>);</span></div>
                                    <div class="col-xs-4"><span>Bank:</span></div>
                                    <div class="col-xs-8"><span>'.$rowr['bank'].'</span></div>
                                    <div class="col-xs-4"><span>Act no:</div>
                                    <div class="col-xs-8"><span>'.$rowr['act_no'].'</span></div>
                                    <div class="col-xs-4"><span>Phone:</div>
                                    <div class="col-xs-8"><span>'.$rowr['fone_no'].'</span></div>
                                    <div class="col-xs-4"><span>Pop:</div>
                                    <div class="col-xs-8"><a href="../'.$rows['image'].'" target="blank"><img src="../'.$rows['image'].'" width="40px;" height="20px;"></a></div>
                                    ';
                                if($_SESSION['id'] == 1){
                                    echo '
                                    <div class="col-xs-4"><span>Proof:</span></div>
                                    <div class="col-xs-8">
                                        <span><form method="POST" action="paired_donations.php?confirm_id='.$rows['id'].'" class="form-horizontal" enctype="multipart/form-data" role="form">
                                        <input type="text" name="confirm" id="confirm" value="admin confirmed" hidden="true" style="visibility:hidden;">
                                        <input type="text" name="provider" id="provider" value="'.$rows['provider_id'].'" hidden="true" style="visibility:hidden;">
                                        <input type="submit" name="confirm_submit" value="Confirm" style="color:green;" onclick="show_alert();">
                                    </form></span>
                                    </div>';
                                     echo '
                                    <div class="col-xs-4"><span>Delete:</span></div>
                                    <div class="col-xs-8">
                                        <span></form><form method="POST" action="paired_donations.php?match_id='.$rows['id'].'" enctype="multipart/form-data">
                                        <input type="submit" onClick="return confirm(\'Delete Match?\')" name="delete_submit" id="delete_submit" value="Delete Match" class="btn btn-xs btn-danger delete_acct">
                                        </form></span>
                                        </div>';
                                }
                                echo '
                                    <div class="col-xs-4"><span>Status:</span></div>
                                    <div class="col-xs-8"><span>'.$rows['confirm'].'</span></div>
                                    <div class="col-xs-4"><span>Started:</div>
                                    <div class="col-xs-8"><span>'.$rows['created_at'].'</span></div>
                                ';
                        }
                    echo '
                    ';
                   // if(date("Y-m-d H:i:s") < $datetime3) {
                    if(date("Y-m-d H:i:s") < $old) {
                    echo '
                        <div class="col-xs-4"><span>Timeleft:</span></div>
                        <div class="col-xs-8"><span id="dem">Stopped</span></div>
                        </div>
                    ';
                    }else{
                      echo '
                        <div class="col-xs-4"><span>Timeleft:</span></div>
                        <div class="col-xs-8"><span>Stopped</span></div>
                        </div>
                    ';  
                    } 
                }
                    
                }
                    
                    //END OF PROVIDER ID
                    //BEGINNING OF RECEIVER ID
                    //END OF RECEIVER ID
            }
                    
                    //END OF PROVIDER ID
                    //BEGINNING OF RECEIVER ID
             
                    //END OF RECEIVER ID
            }
                else{
                    echo '
                    <td><p style="color:red;">Match Canceled!</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    ';
                }
            }
                        }else{
                echo '
                <td><p style="color:#913838;">You do not have any current paired donations yet!</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    ';
            }
    echo '
        
    ';
        ?>
                                                <!-- SHOW PAYMENTS ENDS-->
                                                <script>
                                                    function show_alert() {
                                                        if (confirm("Do you really want to do this?"))
                                                            document.forms[0].submit();
                                                        else
                                                            return false;
                                                    }
                                                </script>
                            </div>
                            <?php include 'footer.php' ?>
    </body>