<?php include '../includes/db.php'; ?>

<?php
if(isset($_GET['id'])  && $_GET['id'] !== null) {
    $transaction_id = $_GET['id'];

    $sql = "SELECT * FROM transaction WHERE id='$transaction_id'";
    $sql_query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($sql_query) > 0) {
        $update_sql = "UPDATE transaction SET  Status='Success' WHERE id='$transaction_id'";
        $update_query = mysqli_query($conn, $update_sql);
       
        if($update_query) {
            echo "<script type='text/javascript'> document.location = 'index.php?message=updated_successfully'; </script>";
        } else {
            echo "<script type='text/javascript'> document.location = 'index.php?message=not_updated'; </script>";
        }
    } else {
        echo"<script>document.location='index.php?message=not_selected';</script>";
    }
} else {
    echo "<script type='text/javascript'> document.location = 'index.php?message=failed'; </script>";
}
?>