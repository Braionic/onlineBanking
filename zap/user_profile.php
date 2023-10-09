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
                            
                             echo '<div class="pgd">
                             <div class"details">
                             <h4>Full Name: '.$rows['name'].'</h4>
                             <h4>Email Address: '.$rows['email'].'</h4>
                             <h4>Gender: '.$rows['gender'].'</h4>
                             <h4>Bank: '.$rows['bank'].'</h4>
                             <h4>Account Number: '.$rows['act_no'].'</h4>
                             <h4>Phone: '.$rows['fone_no'].'</h4>
                             <h4>Country: '.$rows['state'].'</h4>
                             <h4>Reseller: '.$rows['nickname'].'</h4>
                             <div class="profilebtns">
                             <form method="POST" action="all_users.php?user_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Delete User?\')" name="delete_submit" id="delete_submit" value="Delete User" class="btn btn-danger delete_acct">
                    </form>
                    <form method="POST" action="all_users.php?user_id='.$rows['id'].'" enctype="multipart/form-data">
                        <input type="submit" onClick="return confirm(\'Block User?\')" name="block_submit" id="block_submit" value="Block User" class="btn btn-warning delete_acct">
                    </form>
                    </div>
                             </div>
                             <div class"images">
                             
                                ';} ?>
                                <?php  
                        $sel_sql = "SELECT * FROM users WHERE id = '$_GET[person_id]'";
                        $run_sql = mysqli_query($conn,$sel_sql);
                        while($fetch = mysqli_fetch_assoc($run_sql)){
                                 if($fetch['image'] == ''){
            echo '<img src="https://i.ibb.co/18PZkVk/tymebank-thumbnail-05-1080x1080-1.jpg" class="jarallax-img">';
         }else{
            echo '<img src="../uploaded_img/'.$fetch['image'].'" alt="profile pic" style="max-width: 200px; max-height: 200px;">';
         } 
         echo'
                             </div>
                             </div>
                        <h4 class="text-center">Send '.$fetch['name'].' A Message</h4>
                        <form method="POST" action="user_profile.php?message_id='.$fetch['id'].'" class="form-horizontal well text-center send_msg" enctype="multipart/form-data" role="form">
                            <div class="form-group">
                                <label for="title">Title
                                </label>
                                <input type="text" name="title" id="title" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message
                                </label>
                                <textarea name="message" id="message" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message_submit">
                                </label>
                                <input type="submit" name="message_submit" id="message_submit" value="message" class="btn btn-info cc">
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