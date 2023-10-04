<?php session_start();
     if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { //TO CHECK IF LAST REQUEST WAS MORE THAN 30 SECONDS AGO
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // UPDATE LAST ACTIVITY STAMP
    ?>
