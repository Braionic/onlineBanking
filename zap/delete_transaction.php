<?php
include '../includes/db.php';

    if(isset($_GET['rn']))

    {

    $row_id = $_GET['rn']; //
    $query = "delete from transaction where id = '$row_id'";

    $result = mysqli_query($conn,$query);
 if($result)

    {

        echo "<script type='text/javascript'> document.location = 'addtransaction.php?deleted'; </script>";

       // header("location:transfers.php");

    }

    else

    {

        echo ' Please Check Your Query ';

    }
}


?>
