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
                        <?php //CONFIRM USER
                             if(isset($_POST["approve_submit"])){
                                 $approve = "approved";
                                 $ins_sql = "UPDATE testimony SET status='$approve' WHERE id = '$_GET[approve_id]'";
                                     $run_sql = mysqli_query($conn,$ins_sql);
                                 echo '
                                        <p class="blinking">Testimony Approved Successfully</p>';
                             }
                        ?>
                            <?php //DELETE FROM PROVIDE TABLE BEGINS
                                     if(isset($_POST["delete_submit"])){
                                 $sql = "DELETE FROM testimony WHERE id = '$_GET[delete_id]'";
                                 $delete_sql = mysqli_query($conn,$sql);
                                         echo '<p class="blinking">Testimony Deleted Successfully</p>';
                             //    header('Location: testimony.php');
                      //DELETE FROM PROVIDE TABLE ENDS
                             }
                        ?>
                                <h4 class="text-center">Testimonies</h4>
                                <?php  //USE $ROWS[''TITLE] TO GET DATA FROM DATABASE
                        $sel_sql = "SELECT * FROM testimony ORDER BY id DESC"; //THE QUERY
                        $run_sql = mysqli_query($conn,$sel_sql); //MENTION THE CONNECTION AND QUERY
                    while($rows = mysqli_fetch_assoc($run_sql)){ //TO FETCH/COLLECT DATA FROM SEL_SQL COMMAND
                        echo '  <div class="panel panel-success">  
                            <div class="panel-heading">
                                    <h4 class="small"><a href="user_profile.php?person_id='.$rows['id'].'">'.$rows['name'].'</a> - '.$rows['status'].'</h4>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-8">
                                    <p>'.strip_tags($rows['body']).'</p>
                                </div>
                                    <form method="POST" action="testimonies.php?approve_id='.$rows['id'].'" enctype="multipart/form-data">
                                        <input type="submit" onClick="return confirm(\'Approve?\')" name="approve_submit" id="approve_submit" value="Approve" class="btn btn-xs btn-success delete_acct">
                                    </form>
                                    <form method="POST" action="testimonies.php?delete_id='.$rows['id'].'" enctype="multipart/form-data">
                                        <input type="submit" onClick="return confirm(\'Delete?\')" name="delete_submit" id="delete_submit" value="Delete" class="btn btn-xs btn-danger delete_acct">
                                    </form>
                            </div>
                    </div>'; //ECHO TO RUN THIS BLOCK OF CODE MULTIPLE TIMES
                    }
                    ?>
                    </div>
                    <?php include 'footer.php' ?>
</body>