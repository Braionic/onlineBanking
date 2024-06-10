<?php include '../includes/timeoutable.php' ?>
<style>
    .main-wrapper {
      background-color: rgba(100, 100, 100, 0.5);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 90vh;
      padding: 20px;
      margin-top: 30px;
    }
</style>
<body>
    <?php include '../includes/db.php'; ?>
    <div class="main-wrapper">
    <?php
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
        //  header('Location: login.php?login_error=wrong');
    }
?>
    <?php include 'header.php';  ?>
    <?php
                    //MATCH SUBMIT
if (isset($_POST['block_user'])) {
    $role = "admin";
    $user_id = $_POST['user_id'];
    if (!empty($_POST['status']) && !empty($_POST['user_id'])) {
        $status = $_POST['status'];
    } else {
        $status = ".";
    }

    //select
    $sel_sql = "SELECT * FROM users WHERE id = '$_POST[user_id]'";
    $sql = mysqli_query($conn, $sel_sql);
    while($rows = mysqli_fetch_assoc($sql)) {
        //so get the user details you want to save here
        $name = $rows['name'];
        //etc etc etc.......
    }
    if(mysqli_num_rows($sql) < 1) {
        // INSERT INTO INVENTOR DATABASE
        $ins_sql = "INSERT INTO blocked (firstname, user_id, status) VALUES ('$name', '$_POST[user_id]', '$status')";
        $run_sql = mysqli_query($conn, $ins_sql);
        echo '<h4 class="alert alert-success text-center" style="color:green">'.$name. ' has successfully been placed on COT FCC Restriction</h4>';
    } else {
        echo "<div class='alert alert-danger text-center'>".$name." account has already been restricted</div>'";
    }
}
?>
    <h3 class="text-center">Restrict Customer to COT Interface</h3>
    <div class="container">
        <div class="form">
            <form method="POST" action="blockuser.php" class="form-horizontal well text-center"
                enctype="multipart/form-data" role="form" name="myForm">
                <div class="form-group" class="col-xs-12 col-sm-6 col-md-6">
                    <select
                        style="background-color: aqua; color: black; height: 50px; border-bottom: 2px solid black;"
                        class=" col-xs-7 form-control input-md" name="user_id" id="user_id" tabindex="9" required>
                        <option value="">Please select</option>
                        <?php
$sel_user = "SELECT * FROM users";
$sel_query = mysqli_query($conn, $sel_user);
if(mysqli_num_rows($sel_query) >0) {
    while($rows = mysqli_fetch_assoc($sel_query)) {
        
        echo '<option style="font-size: 14px" value="'.$rows['id'].'">'.$rows['name'].'</option>';
    }
} else {
    echo "<p>No level</p>";
}
?>
                    </select>
                </div>

                <div class="form-group">

                    <select class="col-xs-7 form-control input-sm" name="status" id="status" tabindex="10" required>
                        <option value="FCC & IMF" selected>COT or IMF</option>
                    </select>

                </div>
                <div class="form-group">
                    <input type="submit" name="block_user" id="block_user" value="Restrict User"
                        class="btn btn-primary cc">
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <h2 class="">Customers</h2>
        <table class="table table-striped">
            <tr class="table-success">
                <td style="background-color: #fdc600;">No.</td>
                <td style="background-color: #fdc600;">Full Name</td>
                <td style="background-color: #fdc600;">Customer ID</td>
                <td style="background-color: #fdc600;">Status</td>
            </tr>

            <?php


$records = mysqli_query($conn, "Select * from blocked ORDER BY id DESC"); // fetch data from database
$i = 1;
while($data = mysqli_fetch_array($records)) {
    $i++;
    ?>
            <tr>

                <td><?php echo $i; ?></td>
                <td><?php echo $data['firstname']; ?>
                </td>
                <td><?php echo $data['user_id']; ?>
                </td>
                <td><?php echo $data['status']; ?>
                </td>
            </tr>
            <?php
}
?>
        </table>
    </div>
    <?php include 'footer.php' ?>
</body>