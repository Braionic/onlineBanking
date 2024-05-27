<?php include 'includes/timeoutable.php' ?>

<body>
	<?php include 'includes/db.php'; ?>
	<?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
        echo "<script type='text/javascript'> document.location = 'index.php?login_error=session'; </script>";
        //  header('Location: login.php?login_error=wrong');
    }
?>
	<?php include 'header2.php';  ?>
	<div style="min-height: 80vh;  margin-top: 100px ">

		<section class="add margin-top-50px">
			<div class="container-fluid">
				
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<div class="well well-sm add bg-transparent">
							<h3 class="add lighter separator">Filter History</h3>
							<form action="history.php" method="get" class="form-horizontal add margin-top-30px"
								role="form">
								<input type="hidden" name="search" value="yes">
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">From:</label>
									<div class="col-sm-10">
										<input type="date" name="from" id="" class="form-control" placeholder="From:"
											value="2023-02-01" required>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-sm-2 control-label">To:</label>
									<div class="col-sm-10">
										<input type="date" name="to" id="" class="form-control" placeholder="To:"
											value="2023-12-20" required>
									</div>
								</div>

								<!--<div class="col-xs-12 text-center add margin-bottom-10px">
                                <div class="btn-group btn-group-sm text-center" data-toggle="buttons">
                                    <label class="btn btn-footer-color ">
                                        <input type="radio" name="action" value="call"
                                               autocomplete="off" > pending
                                    </label>
                                    <label class="btn btn-footer-color ">
                                        <input type="radio" name="action" value="put"
                                               autocomplete="off" > completed
                                    </label>
                                    <label class="btn btn-footer-color  active">
                                        <input type="radio" name="action" value="all" autocomplete="off"
                                                checked> ALL
                                    </label>
                                </div>
                            </div>-->

								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2 text-center">
										<button type="submit" class="btn btn-sm"
											style="background-color: #fdc600;">FILTER</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-9">
						<div class="transaction-container"
							style="background-color: white; border-radius: 10px; margin-top: 30px;">
							<h4>All Transactions</h4>
							<table class="table">
								<thead>
									<tr>
										<th>NO</th>
										<th style="font-weight: normal;"> Transaction:</th>
										<th style="font-weight: normal;">Amount:</th>
										<th style="font-weight: normal;">Date:</th>
										<th style="font-weight: normal;">Status:</th>
								</thead>
								<tbody style="color: rgba(100,100,100, 1)">
									<?php
              $i = 1;
$my_sql = "SELECT * FROM transaction WHERE user_id = '$_SESSION[id]' ORDER BY id DESC";
$run_sql = mysqli_query($conn, $my_sql);
while($rows = mysqli_fetch_assoc($run_sql)) {
    $sql = "SELECT * FROM users where id = '$_SESSION[id]'";
    $sql_query2 = mysqli_query($conn, $sql);
    while($rows2 = mysqli_fetch_assoc($sql_query2)) {
        ?>
									</tr>
									<td><?php echo $i  ?></td>
									<td style="">
										<?php echo $rows['transaction']; ?>
									</td>
									<td style="">
										<?php echo $rows2['currency'].$rows['amount']; ?>
									</td>
									<td style="">
										<?php echo $rows['created_at']; ?>
									</td>
									<?php if($rows['Status'] == 'Successful') {
									    echo '<td style="color: green; font-weight: 600; font-size: 13px;">';
									} else {
									    echo '<td class="text-warning" style="font-weight: normal; font-size: 15px;" class="">';
									} ?> <?php echo $rows['Status'];
        $i++;
    }
}
?></td><br>
								</tbody>
							</table>
						</div>
						<div class="text-center">

						</div>
					</div>
				</div>
			</div>

		</section>

	</div>
	<div style="height:50px;"></div>

	<?php include 'footer.php' ?>
</body>