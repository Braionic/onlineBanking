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
    <?php include 'header.php';  ?>
    <?php //CONFIRM USER
                             if(isset($_POST["confirm_submit"])){
                                 $ins_sql = "UPDATE matches SET confirm='$_POST[confirm]' WHERE id = '$_GET[confirm_id]'";
                                     $run_sql = mysqli_query($conn,$ins_sql);
                                 //DELETE FROM PROVIDE TABLE BEGINS
                                 $sql = "DELETE FROM provide WHERE user_id = '$_POST[provider]'";
                                 $delete_sql = mysqli_query($conn,$sql);
                                 echo '<p class="blinking text-center" style="color:orange;">Confirmation successfull!</p>';
                              //   header('Location: paired_donations.php');
                      //DELETE FROM PROVIDE TABLE ENDS
                             }
                        ?>
    <?php //DELETE FROM PROVIDE TABLE BEGINS
                                     if(isset($_POST["delete_submit"])){
                                 $sql = "DELETE FROM matches WHERE id = '$_GET[match_id]'";
                                 $delete_sql = mysqli_query($conn,$sql);
                                         echo '<p>Match Deleted Successfully</p>';
                                      //    echo "<script type='text/javascript'> document.location = 'paired_donations.php'; </script>"; 
                              //   header('Location: paired_donations.php');
                      //DELETE FROM PROVIDE TABLE ENDS
                             }
                        ?>
    <?php //UPDATE COLUMNS TO EMPTY FROM PROVIDE TABLE BEGINS
                                     if(isset($_POST["cancel_submit"])){
                                 $sql = "UPDATE matches SET provider_id=' ', receiver_id=' ' WHERE id = '$_GET[match_id]'";
                                 $cancel_sql = mysqli_query($conn,$sql);
                                         echo '<p>Match Deleted Successfully</p>';
                              //   header('Location: my_matches.php');
                      //UPDTE COLUMNS TO EMPTY FROM PROVIDE TABLE ENDS
                             }
                        ?>
    <?php //UPDATE COLUMNS TO Tick FROM MATCHES TABLE BEGINS
                                     if(isset($_POST["tick_submit"])){
                                     if(isset($_POST["tick"])){
                                 $sql = "UPDATE matches SET tick='checked' WHERE id = '$_GET[tick_id]'";
                                 $tick_sql = mysqli_query($conn,$sql);
                                         echo '<p>Saved Checked</p>';
                              //   header('Location: my_matches.php');
                      //UPDTE COLUMNS TO EMPTY FROM PROVIDE TABLE ENDS
                                     }else{
                                         $sql = "UPDATE matches SET tick=' ' WHERE id = '$_GET[tick_id]'";
                                 $tick_sql = mysqli_query($conn,$sql);
                                         echo '<p>Unchecked done</p>';
                                     }
                             }
                        ?>
    <div class="container">
        <h3 class="text-center" style="text-decoration:underline;">Pending</h3>
        <?php  
        $match_sql= "SELECT * FROM matches ORDER BY id DESC";
            $sql= mysqli_query($conn,$match_sql);
            if(mysqli_num_rows($sql) >= 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
            while($rows = mysqli_fetch_assoc($sql)){
                   //TIME STARTS
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
               //TIME ENDS
                if($rows['confirm'] == 'pending'){
                $receiver_sql = "SELECT * FROM users WHERE id = '$rows[receiver_id]'"; //PROVIDER SQL
                $r_sql = mysqli_query($conn,$receiver_sql);
                            while($rowr = mysqli_fetch_assoc($r_sql)){
                            echo '
                                <div ng-app="">
                                <p><a href="user_profile.php?person_id='.$rowr['id'].'">(<b style="color:black;">'.$rowr['id'].'</b>)'.$rowr['name'].'</a> to receive '.$rows['amount'].' from
                                '; }
                    $provider_sql = "SELECT * FROM users WHERE id = '$rows[provider_id]'"; //PROVIDER SQL
                $p_sql = mysqli_query($conn,$provider_sql);
                            while($rowp = mysqli_fetch_assoc($p_sql)){
                            echo '
        
            <a href="user_profile.php?person_id='.$rowp['id'].'">(<b style="color:black;">'.$rowp['id'].'</b>)'.$rowp['name'].'</a> initiated at '.$rows['created_at'].' Timeleft: ';
            
            
            // if(date("Y-m-d H:i:s") < $datetime3) {
                    if(date("Y-m-d H:i:s") < $old) {
                    echo '
                        <b>'.$elapsed.'</b>
                    ';
                    }else{
                      echo '
                        <b>EXPIRED</b>
                    ';  
                    }   
            
            echo '
            <span></form><form method="POST" action="pending.php?match_id='.$rows['id'].'" enctype="multipart/form-data">
                                        <input type="submit" onClick="return confirm(\'Delete Match?\')" name="delete_submit" id="delete_submit" value="Delete Match" class="btn btn-xs btn-danger delete_acct">
                                        </form></span>
</p>
        </div> '; }
                }
            }
            }
        ?>
    </div>
    <?php include 'footer.php' ?>
</body>
