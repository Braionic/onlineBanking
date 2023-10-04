<?php 
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'cdb';
    /*
        $username = 'u614042091_mycdfb';
    $password = 'Welcome1304';
    $db = 'u614042091_cdfb';
    */
    $conn = mysqli_connect($server,$username,$password,$db);
    if(!$conn){
    die("Connection Failed!:".mysqli_connect_error());
}
?>



