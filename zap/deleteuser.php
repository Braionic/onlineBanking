<?php include '../includes/timeoutable.php' ?>

    <body>
        <?php include '../includes/db.php'; ?>
            <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
      //  header('Location: login.php?login_error=wrong');
    }

    if(isset($_GET['id']))
    {
        $UserID = $_GET['id']; //
        $query = " delete from users where ID = '$UserID'";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo "<script type='text/javascript'> document.location = 'addmavro.php?deleted'; </script>";
            header("location:all_users.php");
        }
        else
        {
            echo ' Please Check Your Query ';
        }
   }
    else
    {
        header("location:all_users2.php");
    }
?>