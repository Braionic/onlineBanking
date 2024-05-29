<?php include '../includes/timeoutable.php' ?>

<body>
	<?php include 'header.php'; ?>
	<?php
        include '../includes/db.php';
?>
	<?php
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
    //    header('Location: index.php');
} else { //IF NO USER LOGGED IN

}
?>
	<div class="container">
		<?php
                      if(isset($_GET['registered'])) {
                          echo '<p style="color:orange;">Successfully registered</p>';
                      }
?>
		<?php
if(isset($_POST['login_submit'])) { //IF LOGIN BTN HAS BEEN CLICKED
    if(!empty($_POST['admin_email']) && !empty($_POST['admin_password'])) { //CHECK IF EMAIL AND PASSWORD IS EMPTY
        $get_admin_email = $_POST['admin_email'];
        $get_admin_email = mysqli_real_escape_string($conn, $get_admin_email);
        $get_password = $_POST['admin_password'];
        $sql = "SELECT * FROM admins WHERE email = '$get_admin_email' AND password = '$get_password'"; //FOR ADMINS
        if($result1 = mysqli_query($conn, $sql)) { //FOR USERS IF THERE IS CONNECTION TO THE DATABASE WHERE EMAIL AND PASSWORD IS AVAILABLE
            if(mysqli_num_rows($result1) == 1) { //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                $_SESSION['admin_loggedin'] = true;
                $_SESSION['admin_email'] = $get_admin_email; // $username coming from the form, such as $_POST['username']
                $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
                // $inno_sql = mysqli_query($conn,$sql);
                while($rows = mysqli_fetch_assoc($result1)) { //RETRIEVE INVENTOR DETAILS
                    $_SESSION['name'] = $rows['name'];
                    $_SESSION['gender'] = $rows['gender'];
                    $_SESSION['bank'] = $rows['bank'];
                    $_SESSION['act_no'] = $rows['act_no'];
                    $_SESSION['phone_no'] = $rows['fone_no'];
                    $_SESSION['role'] = $rows['role'];
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['created_at'] = $rows['created_at'];
                    $_SESSION['updated_at'] = $rows['updated_at'];
                }
                echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                //  header('Location: index.php');
                    
            } else {
                echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
                //   header('Location: login.php?login_error=wrong');
            } //
        } else {
            echo "<script type='text/javascript'> document.location = 'login.php?login_error=query_error'; </script>";
            // header('Location: login.php?login_error=query_error');
        }
    } else {
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=empty'; </script>";
        //  header('Location: login.php?login_error=empty');
    }
} else {
    $login_err = '';

}
if(isset($_GET['login_error'])) { //TO OUTPUT LOGIN ERROR
    if($_GET['login_error'] == 'empty') {  //LOGIN ERROR FOR EMPTY
        $login_err = "<div class='alert alert-danger'>Admin name or password was empty!</div>";
    } elseif($_GET['login_error'] == 'wrong') { //LOGIN ERROR FOR INVALID DETAILS
        $login_err = "<div class='alert alert-danger'>Admin name or password was wrong!</div>";
    }
}
echo $login_err;
?>
		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image" style="margin-top: 90px;"><img src="../images/HSBC_UK.png"
									width="40%"
									style="border-radius: 50%; margin-left: auto; margin-right: auto; display: block">
							</div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Welcome Admin!</h1>
									</div>
									<form method="POST" action="login.php" class="user" enctype="multipart/form-data"
										role="form">
										<div class="form-group">
											<input type="email" name="admin_email"
												class="form-control form-control-user" id="exampleInputEmail"
												aria-describedby="emailHelp" placeholder="Enter Email Address...">
										</div>
										<div class="form-group">
											<input type="password" name="admin_password"
												class="form-control form-control-user" id="exampleInputPassword"
												placeholder="Password">
										</div>
										<div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" id="customCheck">
												<label class="custom-control-label" for="customCheck">Remember
													Me</label>
											</div>
										</div>
										<input type="submit" name="login_submit" id="login_submit" value="Login"
											class="btn btn-primary btn-user btn-block">
										<hr>
									</form>
									<hr>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	</div>
	<?php include 'footer.php' ?>
</body>