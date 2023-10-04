<?php include '../includes/timeoutable.php' ?>

    <body>
        <?php include '../includes/db.php'; ?>
            <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
      //  header('Location: login.php?login_error=wrong');
    }

    if(isset($_GET['Del']))
    {
        $UserID = $_GET['Del']; //
        $query = " delete from mavro where ID = '$UserID'";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo "<script type='text/javascript'> document.location = 'addmavro.php?deleted'; </script>";
           // header("location:addmavro.php");
        }
        else
        {
            echo ' Please Check Your Query ';
        }
   }
    else
    {
        header("location:addmavro.php");
    }
?>
<?php
if(isset($_GET['edit'])){
$id = $_GET['edit'];
$sql = "SELECT * FROM users WHERE ID = '$id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 1){
    while($rows = mysqli_fetch_array($result)){
        $mavro = $rows['mavro'];
        $mavro2 = $rows['mavro2'];
    }

}

}

?>