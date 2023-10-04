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
                    <!-- AFTER SENDING MESSAGE BEGINS-->

                    <!-- AFTER SENDING MESSAGE ENDS-->
                    <div class="container">
                        <h4 class="text-center">Queries</h4>
                        <?php  //USE $ROWS[''TITLE] TO GET DATA FROM DATABASE
                        $sel_sql = "SELECT * FROM contact ORDER BY id DESC"; //THE QUERY
                        $run_sql = mysqli_query($conn,$sel_sql); //MENTION THE CONNECTION AND QUERY
                    while($rows = mysqli_fetch_assoc($run_sql)){ //TO FETCH/COLLECT DATA FROM SEL_SQL COMMAND
                        echo '  <div class="panel panel-success">  
                            <div class="panel-heading">
                                    <h4>'.strip_tags($rows['title']).'</a><span class="pull-right small">'.$rows['name'].' - '.$rows['created_at'].'</span></h4>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-8">
                                    <p>'.strip_tags($rows['body']).'</p>
                                </div>
                                    <form method="POST" action="user_profile.php?person_id='.$rows['user_id'].'" enctype="multipart/form-data">
                                        <input type="submit" name="approve_submit" id="approve_submit" value="Reply" class="btn btn-xs btn-info delete_acct">
                                    </form>
                                    <form method="POST" action="messages.php?delete_id='.$rows['user_id'].'" enctype="multipart/form-data">
                                        <input type="submit" onClick="return confirm(\'Delete?\')" name="delete_submit" id="delete_submit" value="Delete" class="btn btn-xs btn-danger delete_acct">
                                    </form>
                            </div>
                    </div>'; //ECHO TO RUN THIS BLOCK OF CODE MULTIPLE TIMES
                    }
                    ?>

                    </div>
                    <?php include 'footer.php' ?>
</body>