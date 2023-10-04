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

                <div style="height:3%;"></div>
                <!--FOR SPACE -->
                <div class="row container">
                    <!--OUTPUT FOR LIVE SEARCH MESSAGE BEGINS-->
                    <h4>Unique Paired Donations</h4>
                    <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

// Escape user inputs for security
$query = mysqli_real_escape_string($conn, $_REQUEST['query']);
 
if(isset($query)){
    // Attempt select query execution
    $sql = "SELECT * FROM matches WHERE provider_id LIKE '%" . $query . "%' OR receiver_id LIKE '%" . $query . "%'"; 
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_array($result)){
                echo '
                              <table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th>Details</th>
            <th>Pop</th>
            <th>Upload/Confirm</th>
            <th>Timeleft</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
                                         
                ';
                
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
                
                $oldtime->modify("+7 hours"); //ADD TIME TO DATE
                $old = $oldtime->format("Y-m-d H:i:s"); // CONVERT 'da' TO FORMAT HERE
                $oldtime_plus_addtime = date_create($old); //MAKE NEW DATE
                $datetime3 = $datetime2->format("Y-m-d H:i:s"); // CONVERT 'datetime2' TO FORMAT HERE
         //       $interval = $datetime1->diff($datetime2); //DIFF BTW TWO DATETIME
               $interval = $oldtime_plus_addtime->diff($datetime1); //DIFF BTW TWO DATETIME
                //$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %S seconds');
                $elapsed = $interval->format('%h hrs %i mins %S secs'); //GET DIFF BTW DATES IN FORMAT HERE
           //     echo $elapsed;
                //TIME QUERY ENDS
                            if($rows['provider_id'] != 0 || $rows['receiver_id'] != 0){ //CHECK IF PROVIDER_ID OR RECEIVER_ID IS EMPTY 
                            $provider_sql = "SELECT * FROM users WHERE id = '$rows[provider_id]'";
                            $p_sql = mysqli_query($conn,$provider_sql);
                            while($rowp = mysqli_fetch_assoc($p_sql)){
                                echo '<tr><td><i style="color:orange;">'.$rows['rematch'].'</i>: (<i style="color:orange;">'.$rowp['id'].'</i>)'.$rowp['name'].'(phone: '.$rowp['fone_no'].') with '.$rowp['bank'].': '.$rowp['act_no'].' has been matched to pay '.$rows['amount'].' to => <br/>';
                        }
                            $receiver_sql = "SELECT * FROM users WHERE id = '$rows[receiver_id]'";
                            $r_sql = mysqli_query($conn,$receiver_sql);
                            while($rowr = mysqli_fetch_assoc($r_sql)){
                                echo '(<i style="color:orange;">'.$rowr['id'].'</i>)'.$rowr['name'].'(phone: '.$rowr['fone_no'].') with '.$rowr['bank'].': '.$rowr['act_no'].'</td>
                                <td><a href="../'.$rows['image'].'" target="blank"><img src="../'.$rows['image'].'" width="40px;" height="20px;"></a>'.$rows['confirm'].'</td>
                       <td> <form method="POST" action="matches.php?confirm_id='.$rows['id'].'" class="form-horizontal" enctype="multipart/form-data" role="form">
                            <input type="text" name="confirm" id="confirm" value="Admin Confirmed" hidden="true" style="visibility:hidden;">
                            <input type="text" name="provider" id="provider" value="'.$rows['provider_id'].'" hidden="true" style="visibility:hidden;">
                            <input type="submit" name="confirm_submit" value="Confirm">
                        </form></td> ';
                             // if(date("Y-m-d H:i:s") < $datetime3) {
                    if(date("Y-m-d H:i:s") < $old) {
                    echo '
                         <td>Time remaining: <b style="color:orange;">'.$elapsed.'</b></td>
                        </tr>
                    ';
                    }else{
                      echo '
                         <td>Time remaining: <i style="color:orange;">expired</i></td>
                        </tr>
                    ';  
                    }
                        } //BEGINNING OF IF FOR ADMIN
                                $admin_sql= "SELECT * FROM admins WHERE id = 1";
                                $a_sql= mysqli_query($conn,$admin_sql);
                                while($rows = mysqli_fetch_assoc($a_sql)){
                        if($rows['id'] == 1){ //CHECK IF PROVIDER_ID OR RECEIVER_ID IS EMPTY 
                 echo '
                        <td> <form method="POST" action="paired_donations.php?match_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Cancel Match?\')" name="cancel_submit" id="cancel_submit" value="Cancel Match" class="btn btn-xs btn-danger delete_acct">
                        </form><form method="POST" action="paired_donations.php?match_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Delete Match?\')" name="delete_submit" id="delete_submit" value="Delete Match" class="btn btn-xs btn-danger delete_acct">
                        </form></td> 
                        ';
                            }
                                }//END OF IF FOR ADMIN
            }else{
                    echo '
                    <td><p style="color:red;">Match Canceled!</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    ';
                }
            }
            echo "
                                </tbody>
                                </table>
            ";
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found for <b>$query</b></p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}
 
// close connection
mysqli_close($conn);
?>
                        <!--OUTPUT FOR LIVE SEARCH MESSAGE ENDS-->
                </div>
    </body>