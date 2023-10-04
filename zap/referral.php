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
                    <div class="container">
                        <h3 class="text-center">Referrals Info</h3>
                        <?php
                        
                        $sel_sql= "SELECT * FROM users ORDER BY id DESC";
                        $sql= mysqli_query($conn,$sel_sql);
                        while($rows = mysqli_fetch_assoc($sql)){
                             $r_sql = "SELECT * FROM request WHERE origin_id = '$rows[id]'";
                             $re_sql = "SELECT DISTINCT origin_id FROM request WHERE origin_id = '$rows[id]' ORDER BY id DESC";
                            $ql = mysqli_query($conn,$re_sql);
                            $q = mysqli_query($conn,$r_sql);
                            while($rowp = mysqli_fetch_assoc($ql)){
                                $user = $rows['id'];
                                $ref = $rowp['origin_id'];
                                if ($user == $ref){
                            $num_rows = mysqli_num_rows($q);
                            echo ' <p><b>('.$rows['id'].')</b>'.$rows['name'].' has '.$num_rows.' referrals</p>';
                                }
                            }
                           
                        }
                        
                                    $ref_sql = "SELECT DISTINCT origin_id FROM Request ORDER BY id DESC"; //FOR USERSORDER BY id = DESC"; 
                                        $sql = mysqli_query($conn,$ref_sql);
                                        while($rows = mysqli_fetch_assoc($sql)){ //RETRIEVE INVENTOR DETAILS
                                            $re_sql = "SELECT * FROM request WHERE origin_id = '$rows[origin_id]'";
                                            $ql = mysqli_query($conn,$re_sql);
                                            $num_rows = mysqli_num_rows($ql);
                                            echo "$num_rows Rows\n";
                                        }
                                    ?>
                    </div>
                    <?php include 'footer.php' ?>
</body>