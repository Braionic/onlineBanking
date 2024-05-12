<?php include 'includes/timeoutable.php' ?>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    //  header('Location: panel.php');


} else { //IF NO USER LOGGED IN
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

	<?php include('header2.php') ?>
	<div style="height:60px;"></div>
	<div class="main-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="top-bar"
						style="margin-top: 30px; padding: 7px 12px; display: flex; align-items: center; gap: 10px; background-color: rgba(100, 100, 130, 0.9); color: white;">
						<p>Account Reveiw</p>
						<p>Your Personal Details</p>
					</div>
					<h3>Your Profile</h3>
					<p>Here you can review and update your profile information</p>
					<h3>Your Personal Details</h3>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Name</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['name']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Date of Birth</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['dob']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Country of Origin</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['state']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Gender</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['gender']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Transaction Notification</p>
						<p style="flex-grow: 1;">Yes</p>
					</div>
					<hr>
					<h3>Contact Details</h3>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Mobile Number</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['phone_no']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Email Address</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['email']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Home Address</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['address']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Account Type</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['account']; ?>
						</p>
					</div>
					<hr>
					<h3>Account</h3>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Mobile Number</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['account']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Account Status</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['limit_status']; ?>
						</p>
					</div>

					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Created on</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['created_at']; ?>
						</p>
					</div>
					<div style="display: flex; align-items: center; justify-content: between; gap: 40px;">
						<p style="flex-grow: 1">Last Updated</p>
						<p style="flex-grow: 1;">
							<?php echo $_SESSION['updated_at']; ?>
						</p>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php include("footer.php") ?>
</body>

</html>