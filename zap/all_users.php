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
              //   header( "refresh:0.2;url=all_users.php" ); //REDIRECT TO PAGE AFTER CERTAIN SECONDS
            exit();
            } if(isset($_GET['message_empty'])){  //AFTER SENDING MESSAGE SUCCESFULLY
                echo '<h4 style="color:blue;">Message not sent because it was empty!</h4>';
             //    header( "refresh:0.2;url=all_users.php" ); //REDIRECT TO PAGE AFTER CERTAIN SECONDS
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
                                <div class="container">
                                    <div style="height:20px;"></div>
                                    <!--SCRIPT FOR LIVE SEARCH USERS BEGINS-->
                                    <script>
                                        $(document).ready(function () {
                                            $('.search-box input[type="text"]').on("keyup input", function () {
                                                /* Get input value on change */
                                                var term = $(this).val();
                                                var resultDropdown = $(this).siblings(".result");
                                                if (term.length) {
                                                    $.get("backend-search.php", {
                                                        query: term
                                                    }).done(function (data) {
                                                        // Display the returned data in browser
                                                        resultDropdown.html(data);
                                                        //  document.getElementById("live_msg").innerHTML = "demt";
                                                    });
                                                } else {
                                                    resultDropdown.empty();
                                                    // document.getElementById("demmo").innerHTML = "demo_test.txt";
                                                }
                                            });

                                            // Set search input value on click of result item
                                            $(document).on("click", ".result p", function () {
                                                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                                                $(this).parent(".result").empty();
                                            });
                                        });
                                    </script>
                                    <!--SCRIPT FOR LIVE SEARCH USERS ENDS-->
                                    <!--SEARCH FOR LIVE SEARCH USERS ENDS-->
                                    <div class="search-box">
                                        <div class="form-group">
                                            <label class="col-sm-2" for="post_title">Quickly Search Users:
                                            </label>
                                            <input type="text" autocomplete="off" placeholder="Input Name or Id..." />
                                            <div class="result"></div>
                                        </div>
                                    </div>
                                    <!--SEARCH FOR LIVE SEARCH USERS ENDS-->
                                    <!--SEARCH FORM FOR USERS BEGINS-->
                                    <!-- HIDE SEARCH FORM    <form class="form-horizontal" action="" role="form">
                                    <div class="input-group ">
                                        <input style="cursor:text;" type="search" name="search" class="btn btn-link" placeholder="Search Something......">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default btn-link" name="search_submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form> -->
                                    <!--SEARCH FORM FOR USERS ENDS-->
                                    <!--AFTER CLICKING SEARCH BEGINS-->
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
                                        <!--SSEARCH USERS BEGINS-->
                                       <!-- <form class="form-horizontal" action="user_search.php" role="form">
                                            <div class="input-group ">
                                                <input style="cursor:text;" type="search" name="search" class="form-control btn btn-link" placeholder="Search Something......">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default btn-link" name="search_submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                                </div>
                                            </div>
                                        </form>-->
                                        <!--SEARCH USERS ENDS-->
                                        <h3 class="text-center">All existing Customers</h3>
                                        <table class="table table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Transfer Status</th>
                                                    <th>Full Name</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                               
            $sel_sql= "SELECT * FROM users ORDER BY id DESC";
            $sql= mysqli_query($conn,$sel_sql);
            while($rows = mysqli_fetch_assoc($sql)){
                
                if($rows['image'] == ''){
                    echo '<td><img src="https://i.ibb.co/18PZkVk/tymebank-thumbnail-05-1080x1080-1.jpg" class="jarallax-img" alt="profile pic" style="max-width: 50px; max-height: 50px;"></td>';
                 }else{
                    echo '<td><img src="../uploaded_img/'.$rows['image'].'" alt="profile pic" style="max-width: 50px; max-height: 50px;"></td>';
                 }

                 if($rows['limit_status'] == 'restricted'){
                    echo '<td><div class="restricted">User Restricted</div></td>';
                 }else{
                    echo '<td><div class="allowed">Limit allowed</div></td>';
                 }
                echo '
                 
                    <td><a href="user_profile.php?person_id='.$rows['id'].'">'.$rows['name'].' (<b style="color:orange">'.$rows['id'].'</b>)</a></td>
                    <td class="btn btn-warning"><a href="deleteuser.php?id='.$rows['id'].'">Delete</a></td>
        ';}?>
                    </tbody>
        
                                        </table>
                                </div>

                                <?php include 'footer.php' ?>
    </body>