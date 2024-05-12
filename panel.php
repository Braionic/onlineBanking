<?php include 'includes/timeoutable.php' ?>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    //  header('Location: panel.php');
} else { //IF NO USER LOGGED IN
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
?>


<?php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<style>
		.main-wrapper {
			background-color: rgba(100, 100, 100, 0.1);
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			min-height: 90vh;
			padding: 20px;
			margin-top: 30px;
		}

		.top-bar {
			margin-top: 20px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 10px
		}

		.name-bar {
			margin-top: 20px;
			padding: 10px;
		}

		.details-div {
			background-color: white;
			padding: 20px 10px;
			box-shadow: 0px 0px 2px;
			flex-grow: 1;
			border-radius: 12px;
		}

		.details-div>p {
			margin-bottom: 0px;
		}

		.acct-details>.acct-num>.act-num {
			margin-bottom: 0px;
		}

		.act-num {
			font-weight: 600;
		}

		th {
			background-color: aqua;
		}


		@media (max-width: 500px) {
			.acct-num-container {
				display: none;
			}
		}

		@media (min-width: 600px) {
			.acct-num-container {
				left: 60px;
			}

		}
	</style>
</head>

<body>

	<?php include("header2.php") ?>
	<div style="height:23px;"></div>
	<div class="main-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="top-bar">
						<div class="name-bar">
							Welcome <span class="fw-bold ">
								<?php echo $_SESSION['name'] ?>,
							</span>
							<p class="" style="font-size: 11px">What would you like to do today</p>
						</div>
						<div class="right-util"
							style="display: flex; align-items: center; justify-content: end; gap: 3px; position: relative;">
							<button class="btn btn-sm btn-primary"
								style="margin-top: 10px; border-radius: 18px; padding: 5px 16px"><svg
									xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-patch-check-fill" viewBox="0 0 16 16">
									<path
										d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
								</svg> Cash
								Top
								Up</button>
							<button class="btn btn-sm btn-primary"
								style="margin-top: 10px; border-radius: 18px; padding: 5px 16px; margin-bottom: 0px;"
								onclick="handleShow()">Send
								Money</button>
							<div id="trans" style="display: none; position: absolute; bottom: -37px; right: 15px;">
								<a href="intrabank.php"><button class="btn btn-sm btn-primary">Local</button></a>
								<a href="intrabank.php"><button
										class="btn btn-sm btn-primary">International</button></a>
							</div>
						</div>
					</div>
					<div class="price-container rounded-3 btn-primary"
						style="border-radius: 13px; padding: 10px; position: relative; margin-top: 15px;">
						<div class=" avatar rounded-circle" style="width: 50px; height: 50px; overflow: hidden;"><img
								src="./images/client2.png" class="img-fluid" style="width: 40px; height: 40px;" /></div>
						<div class="price text-center" style="margin-bottom: 40px">
							<p class="" style="font-weight: 600;">Available Balance</p>
							<h4><?php
                                 $my_sql = "SELECT * FROM users WHERE id = '$_SESSION[id]' ORDER BY id DESC";
$run_sql = mysqli_query($conn, $my_sql);
while($rows = mysqli_fetch_assoc($run_sql)) {
    echo '<h4 class="balance" style="color: white; font-size: 20px; font-weight: bold">'.$rows['currency'].'
                              '.$rows['amount'].' .00 USD</h4>
  ';
}
?></h4>
						</div>
						<div class="acct-num-container"
							style="background-color: white;border-radius: 13px; padding: 10px; position: absolute; bottom: -40px; right: 60px; margin-left: auto; margin-right: auto;">
							<div class="panell"
								style="display: flex; align-items: center; justify-content: space-between; ">

								<div class="acct-details"
									style="color: black; display: flex; align-items: center; justify-content: center; gap: 4px;">

									<div> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
											fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
											<path
												d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
										</svg></div>
									<div class="acct-num"
										style="display:flex; justify-content: center; flex-direction: column;">
										<p class="act-num o">Your Account Number</p>
										<p class="o">00894883748</p>
									</div>
								</div>
								<div style="display: flex; align-items: center; justify-content: end"><a
										href="history.php"><button class="btn btn-sm bg-primary"
											style="margin-right: 3px;">Transactions</button></a><button
										class="btn btn-sm bg-primary">Top up balance</button></div>
							</div>
						</div>
					</div>
					<div class="dashboard-details"
						style="margin-top: 60px; display: flex; align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap">
						<div class="details-div limit">
							<p>
								Transaction Limit
							</p>
							<p style="font-size: 11px">Your current transaction limit</p>
							<p style="font-size: 17px; font-weight: bold">$500,000.00</p>
						</div>
						<div class="details-div pending">
							<p>
								Pending Transaction
							</p>
							<p style="font-size: 11px">Your pending transaction</p>
							<p style="font-size: 17px; font-weight: bold">$0.00</p>
						</div>
						<div class="details-div volume">
							<p>
								Transaction Volume
							</p>
							<p style="font-size: 11px">Total volume of transaction made</p>
							<p style="font-size: 17px; font-weight: bold">$30,000.00</p>
						</div>
					</div>
					<div class="transaction-container"
						style="background-color: white; border-radius: 10px; margin-top: 30px;">
						<table class="table">
							<thead>
								<tr>
									<th>NO</th>
									<th style="font-weight: normal;"> Transaction:</th>
									<th style="font-weight: normal;">Amount:</th>
									<th style="font-weight: normal;">Date:</th>
									<th style="font-weight: normal;">Status:</th>
							</thead>
							<?php
              $i = 1;
$my_sql = "SELECT * FROM transaction WHERE user_id = '$_SESSION[id]' ORDER BY id DESC";
$run_sql = mysqli_query($conn, $my_sql);
while($rows = mysqli_fetch_assoc($run_sql)) { ?>
							</tr>
							<td><?php echo $i  ?></td>
							<td style="">
								<?php echo $rows['transaction']; ?>
							</td>
							<td style=""><i
									class="fa fa-bitcoin fa-1x"></i><?php echo $rows['amount']; ?>
							</td>
							<td style="">
								<?php echo $rows['created_at']; ?>
							</td>
							<?php if($rows['Status'] == 'Successful') {
							    echo '<td style="color: green; font-weight: bold;" class="">';
							} else {
							    echo '<td style="color: red; font-weight: bold" class="">';
							} ?> <?php echo $rows['Status'];
    $i++;
}
?></td><br>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include("footer.php") ?>
</body>

</html>