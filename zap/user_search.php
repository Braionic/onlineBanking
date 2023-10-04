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
                    <?php
      if(isset($_GET['message_sent'])){  //AFTER SENDING MESSAGE SUCCESFULLY
                echo '<h4 style="color:blue;">Message Was Sent Successfully</h4>';
                 header( "refresh:0.2;url=all_users.php" ); //REDIRECT TO PAGE AFTER CERTAIN SECONDS
            exit();
            } if(isset($_GET['message_empty'])){  //AFTER SENDING MESSAGE SUCCESFULLY
                echo '<h4 style="color:blue;">Message not sent because it was empty!</h4>';
                 header( "refresh:0.2;url=all_users.php" ); //REDIRECT TO PAGE AFTER CERTAIN SECONDS
            exit();
            }
    ?>
                        <?php //DELETE FROM PROVIDE TABLE BEGINS
                                     if(isset($_POST["delete_submit"])){
                                 $sql = "DELETE FROM users WHERE id = '$_GET[user_id]'";
                                 $delete_sql = mysqli_query($conn,$sql);
                                         echo '<p>User Deleted Successfully</p>';
                              //   header('Location: my_matches.php');
                      //DELETE FROM PROVIDE TABLE ENDS
                             }
                        ?>
                            <div class="container">
                                <div style="height:20px;"></div>
                                <?php  
                            if(isset($_GET['search_submit'])){  //IF SEARCH BUTTON IS CLICKED, STATE WHAT WHAT IS SEARCHED
                                // SHOW POSTS
                                $sel_sql = "SELECT * FROM users WHERE id LIKE '%$_GET[search]%' OR name LIKE '%$_GET[search]%'";
                                $run_sql = mysqli_query($conn,$sel_sql);
                                while($rows = mysqli_fetch_assoc($run_sql)){ //TITLE FOR    TOOLTIP
                                echo '
                                    <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <td><a href="user_profile.php?person_id='.$rows['id'].'">'.$rows['name'].'</a></td>
                   <td> <form method="POST" action="all_users.php?user_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Delete User?\')" name="delete_submit" id="delete_submit" value="Delete User" class="btn btn-info delete_acct">
                    </form></td>
                    </tbody></table>
                                ';
                                }
                            }
                            ?>
                                    <!--AFTER CLICKING SEARCH ENDS-->

                            </div>

                            <?php include 'footer.php' ?>
    </body>