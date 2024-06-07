<?php include '../includes/db.php'; ?>
<?php
if(isset($_GET['id'])  && $_GET['id'] !== null) {
    $transaction_id = $_GET['id'];

    $sql = "SELECT * FROM transaction WHERE id='$transaction_id'";
    $sql_query = mysqli_query($conn, $sql);
    while($rows = mysqli_fetch_assoc($sql_query)) {
        if(mysqli_num_rows($sql_query) > 0) {
            $sel_user = "SELECT * FROM users WHERE id='$rows[user_id]'";
            $query_user = mysqli_query($conn, $sel_user);
            while($row = mysqli_fetch_assoc($query_user)) {
                $update_sql = "UPDATE transaction SET  Status='reversed' WHERE id='$transaction_id'";
                $update_query = mysqli_query($conn, $update_sql);
                $new_balance = $rows['amount'] + $row['amount'];
                $act_no = $rows['act_no'];
                $newact = substr_replace($row['act_no'], '*****', 6, 4);
                $update_user = "UPDATE users SET amount='$new_balance' WHERE id='$row[id]'";
                $query_update_user = mysqli_query($conn, $update_user);
       
                if($query_update_user) {
                    $to = $row['email']; // this is the client Email address
                    $from = "no-reply@hsbca.com"; // this is the sender's Email address
                    $first_name = $row['name'];
           
                    $subject2 = "HSBCA Transaction Notification [Reversed: ".$row['currency'] . $rows['amount'] . "]";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $message = '<html><body>';
                    $message = '<div class="navbar-brand"  style="text-align: center; background-color: red" href=""><img src="https://i.ibb.co/LRSjYX8/logo-200x45.png" alt="HSBCA" class="logo">';
                    $message .= '<div  style="background-color: white;">';
                    $message .= '<h3 style="text-align: left;">Dear '. $first_name . '</h3>';
                    $message .= "<h4 style='color:#071d49;'>Your payment was reversed
                </4>";
                    $message .= '<h1 style="color: green; font-size:18px;">' .$row['currency'] .$rows['amount'].'.00</h1>';
                    $message .= '<h3>Transaction Summary</h3>';
                    $message .= '<p><b>ACCT:</b> '.$newact.' </p><p><b>Account type:</b> '.$row['account'].'<br></p>';
                    $message .= '<p><b>Account Name:</b> '. $row['name'] .'</p><p><b>Transaction Branch:</b> Head Office</p><p><b>Transaction Date:</b> ' .$date.'<br></p>';
                    $message .= '<p><b>Transaction Amount:</b> '.$row['currency'] .$row['amount'].'.00</p><p><b>Available Balance:</b> ' .$currency . $amount2 .'.00</p>';
                    $message .= '<h4>Your balance at the time of this transaction is <strong>' .$currency . $row['amount'] .'.00</strong> Thank you for chosing HSBC</h4>';
                    $message .= '<div style="background-color: #28a745; color: white;"><a href="https://www.hsbca.com">HSBCA!</a> Always giving you extra. Get a little extra help from the <a href="https://www.hsbca.com">HSBCA</a>.</div>';
                    $message .= '</div></div></body></html>';
                    $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject2, $message, $headers);
                    echo "<script type='text/javascript'> document.location = 'index.php?message=transaction_reversed' ; </script>";
                } else {
                    echo "<script type='text/javascript'> document.location = 'index.php?message=not_updated'; </script>";
                }
            }
        } else {
            echo"<script>document.location='index.php?message=not_selected';</script>";
        }
    }
} else {
    echo "<script type='text/javascript'> document.location = 'index.php?message=failed'; </script>";
}
?>