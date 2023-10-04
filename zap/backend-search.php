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
                     <?php //DELETE FROM PROVIDE TABLE BEGINS
                                     if(isset($_POST["delete_submit"])){
                                 $sql = "DELETE FROM users WHERE id = '$_GET[user_id]'";
                                 $delete_sql = mysqli_query($conn,$sql);
                                         echo '<p>User Deleted Successfully</p>';
                              //   header('Location: my_matches.php');
                      //DELETE FROM PROVIDE TABLE ENDS
                             }
                        ?>
                    <!--OUTPUT FOR LIVE SEARCH MESSAGE BEGINS-->
                    <h4>Messages</h4>
                    <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

// Escape user inputs for security
$query = mysqli_real_escape_string($conn, $_REQUEST['query']);
 
if(isset($query)){
    // Attempt select query execution
    $sql = "SELECT * FROM users WHERE id LIKE '%" . $query . "%' OR name LIKE '%" . $query . "%'"; 
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_array($result)){
                echo '
                         <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <td><a href="user_profile.php?person_id='.$rows['id'].'">'.$rows['name'].' (<b style="color:orange">'.$rows['id'].'</b>)</a></td>';
             //BEGINNING OF IF FOR ADMIN
                                $admin_sql= "SELECT * FROM admins WHERE id = 1";
                                $a_sql= mysqli_query($conn,$admin_sql);
                                while($rows = mysqli_fetch_assoc($a_sql)){
                        if($rows['id'] == 1){ //CHECK IF PROVIDER_ID OR RECEIVER_ID IS EMPTY 
                            echo '
                   <td> <form method="POST" action="all_users.php?user_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Delete User?\')" name="delete_submit" id="delete_submit" value="Delete User" class="btn btn-info delete_acct">
                    </form></td>
                    </tbody></table>';
                        }else{
                                    echo '
                                     <td></td>
                                    </tbody></table>';
                                }
                            }
                //END OF IF FOR ADMIN
                                         
                
            }
            echo "
                    
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