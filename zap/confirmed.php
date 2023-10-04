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
                                          echo "<script type='text/javascript'> document.location = 'paired_donations.php'; </script>"; 
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
                                         echo '<p>Saved Checked</p>
                                         <script>
                                            (function () {
                                                document.getElementById("show_save").innerHTML = "Saved Successfully";
                                            })();
                                        </script>
                                         ';
                              //   header('Location: my_matches.php');
                      //UPDTE COLUMNS TO EMPTY FROM PROVIDE TABLE ENDS
                                     }else{
                                         $sql = "UPDATE matches SET tick=' ' WHERE id = '$_GET[tick_id]'";
                                 $tick_sql = mysqli_query($conn,$sql);
                                         echo '<p>Unchecked done</p>
                                         <script>
                                            (function () {
                                                document.getElementById("show_save").innerHTML = "Unsaved";
                                            })();
                                        </script>
                                         ';
                                     }
                             }
                        ?>
    <div class="container">
        <h3 class="text-center" style="text-decoration:underline;">Confirmations <i id="show_save"></i></h3>
        <h4 class="text-center">Those ticked means the provider has been matched to receive donation/assistance of x2 i.e 100%</h4>
        <?php  
        $match_sql= "SELECT * FROM matches ORDER BY id DESC";
            $sql= mysqli_query($conn,$match_sql);
            if(mysqli_num_rows($sql) >= 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
            while($rows = mysqli_fetch_assoc($sql)){
                if($rows['confirm'] == 'confirmed'){
                $provider_sql = "SELECT * FROM users WHERE id = '$rows[provider_id]'"; //PROVIDER SQL
                $p_sql = mysqli_query($conn,$provider_sql);
                            while($rowp = mysqli_fetch_assoc($p_sql)){
                                $amt = $rows['amount'];
                                $amount = $amt * 2;
                            echo '
        <div ng-app="">
            <p>
            <iframe name="votar" style="display:none;"></iframe>
            <form method="POST" action="confirmed.php?tick_id='.$rows['id'].'" class="form-horizontal" enctype="multipart/form-data" role="form" target="votar">
            <input type="checkbox" name="tick" id="tick" value="'.$rows['provider_id'].'" '.$rows['tick'].'>
            <input type="submit" name="tick_submit" value="Save" id="tck" style="color:green;" class="btn btn-xs"> <a href="user_profile.php?person_id='.$rowp['id'].'">(<b style="color:black;">'.$rowp['id'].'</b>)'.$rowp['name'].'</a> to receive '.$amount.'; => paid to 
            
            
            ';
            
              $receiver_sql = "SELECT * FROM users WHERE id = '$rows[receiver_id]'"; //PROVIDER SQL
                $r_sql = mysqli_query($conn,$receiver_sql);
                            while($rowr = mysqli_fetch_assoc($r_sql)){
                            echo '
         <a href="user_profile.php?person_id='.$rowr['id'].'">(<b style="color:black;">'.$rowr['id'].'</b>)'.$rowr['name'].'</a> at '.$rows['created_at'].'</form>
</p>
        </div> '; }
                                echo '
            
</p>
        </div> '; }
                }
            }
            }
        ?>
    </div>
    <?php include 'footer.php' ?>
</body>
