<?php include '../includes/timeoutable.php' ?>
<body>
        <?php include '../includes/db.php'; ?>
            <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF ADMIN IS LOGGED IN
    } else { //IF NO USER LOGGED IN
       echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
      //  header('Location: login.php?login_error=wrong');
    }
?>
                <?php include 'header.php';  ?>
                    <!--WHAT HAPPENS AFTER CREATING NEW POST BEGINS-->
                    <?php
                if(isset($_POST["post_submit"])){        
                            $date = date('Y-m-d h:1:s');
                            $ins_sql = "INSERT INTO posts (title, body, created_at) VALUES ('$_POST[post_title]', '$_POST[post_body]', '$date')";
                            $run_sql = mysqli_query($conn,$ins_sql);
                            }
    ?>
                        <!--WHAT HAPPENS AFTER CREATING NEW POST ENDS-->
                        <div style="height:20px;"></div>
                        <div class="container">
                            <h3>Make A New Post</h3>
                            <div class="row">
                                <div class="col-sm-8 main_content">
                                    <form method="POST" action="new_post.php" class="form-horizontal" enctype="multipart/form-data" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-2" for="post_title">Post Title
                                            </label>
                                            <input type="text" name="post_title" id="post_title" placeholder="Enter Title" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2" for="post_body">Post Title
                                            </label>
                                            <input type="text" name="post_body" id="post_body" placeholder="Enter Body" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2" for="post_submit">
                                            </label>
                                            <input type="submit" name="post_submit" id="post_submit" value="Create Post" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <?php include 'footer.php' ?>
</body>