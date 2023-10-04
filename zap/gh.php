<?php include '../includes/timeoutable.php' ?>

<body style="background-color:grey">
    <?php include '../includes/db.php'; ?>
    <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
      //  header('Location: login.php?login_error=wrong');
    }
?>
    <?php include 'header.php';  ?>
    <div class="container">
        <h4 class="text-center" style="text-decoration:underline;">Withdrawal requests</h4>
        <div id="tabs">
            <ul>
            
            </ul>
            <div id="tabs-1">
                <p>
                    <!--START-->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $provide_sql = "SELECT * FROM gh ORDER BY id DESC";
                        $sql = mysqli_query($conn,$provide_sql);
                        if(mysqli_num_rows($sql) >= 1){ //IF NO. OF ROWS WITH ABOVE QUERY IS JUST ONE
                        while($rows = mysqli_fetch_assoc($sql)){
                   //         if($rows['user_id'] == $_GET['provide_id']) {
                            $sel_sql = "SELECT * FROM users WHERE id = '$rows[user_id]'";
                            $run_sql = mysqli_query($conn,$sel_sql);
                            while($row = mysqli_fetch_assoc($run_sql)){
                             echo '
                             <tr>
                                <td><b style="color:black;">'.$row['name'].'</b>(<b style="color:orange;">'.$rows['user_id'].'</b>); '.$row['bank'].'</td>
                                <td>'.$rows['amount'].'</td>
                                <td>'.$rows['created_at'].'</td>
                            </tr>
                             ';
                            }
                        //    }
                        }
                        }else{
                            echo '<h3>There are no donations at the moment. Please check again soon!</h3>';
                        }
                            ?>
                        </tbody>
                    </table>
                </p>
                <!--END-->
        </div>
    </div>
    <script>
        $(function() {
            $("#tabs").tabs();
        });

    </script>
    <?php include 'footer.php' ?>
</body>