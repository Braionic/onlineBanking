<!DOCTYPE html>
<html>

<head>
    <title>CDF Banking | Always giving you extra</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../queries.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../jquery-ui-1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="../jquery-ui-1.12.1/jquery-ui.structure.css">
    <link rel="stylesheet" href="../jquery-ui-1.12.1/jquery-ui.theme.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
    <script src="../script.js"></script>
    <script src="../jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
</head>
<style>
  * {
    box-sizing: border-box;
    margin: 0px;
  }
    body{
        font-family: 'Roboto', sans-serif;
    }

input[type=text], select{
  width: 45%;
  padding: 8px 20px;
  margin: 8px 16px;
  display: inline-block;
  border-top: none;
  border-left: none;
  border-right: none;
  border-radius: 4px;
  color: #45a049;
  outline: none;
}
input[type=text]:focus{
 background-color: #005eb8;
 color: white;
}
textarea{
  width: 45%;
  height: 10%;
  padding: 8px 20px;
 
  display: inline-block;
  border-top: none;
  border-left: none;
  border-right: none;
  border-radius: 4px;
  
  outline: none;
}
input[type=submit] {
  width: 30%;
  background-color: #4CAF50;
  color: white;
  padding: 8px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div .form {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
div .pgd{
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    flex-direction: row;
    flex-wrap: nowrap;
    margin-top: 50px;
    margin-bottom: 30px;
    background-color: grey;
    padding: 16px;
    border-radius: 6px;
    color: white;
}
.dashboard-container {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    background-color: #f8f9fc;
    margin-top: 30px;
    margin-bottom: 30px;
    padding: 10px;
}
.div1, .div2, .div3, .div4 {
    width: 24%;
    height: 100px;
   padding: 12px;
   background-color: white;
   margin: 10px 5px;
   border-radius: 6px;
   text-align: center;
   color: grey;
   border-left: 4px solid blue;
   box-shadow: 3px 3px 6px #858796;
}

@media only screen and (max-width: 700px){
    .div1, .div2, .div3, .div4 {
        width: 40%;
        margin-right: 3px;
    }
    .dashboard-container {
        flex-direction: row;
    }
}
@media only screen and (max-width: 450px){
    .div1, .div2, .div3, .div4 {
        width: 100%;
        margin-right: 3px;
    }
    .dashboard-container {
        flex-direction: column;
    }
}
.divall {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 10px;
}
.details {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;

}
.earning{
 margin-bottom: 5px;
}
</style>

<body>

    <header>
    <nav class="navbar navbar-inverse" style="background-color: #005eb8; color: white;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=""><img src="https://i.ibb.co/pK6BfqV/CDFBank-Logo-Original-5000x5000-2-3.png" alt="CDFB" class="logo"></a><br>
    </div>
    <ul class="nav navbar-nav">
    <?php
                    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
                            echo '
      <li><a href="index.php" class="btn">Home</a></li>
      <li><a href="fund_client.php" class="btn">Fund Client</a></li>
      <li><a href="debit_client.php" class="btn">Debit Client</a></li>
      <li><a href="blockuser.php" class="btn">Restrict Client</a></li>
      <li><a href="addtransaction.php" class="btn">Add Transactions</a></li>
      <li><a href="all_users.php" class="btn">View Users</a></li>
      <li><a href="gh.php" class="btn">Withdrawal Request</a></li>
      <li><a href="logout.php" class="btn">Logout</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">More <span class="caret"></span></a>
        <ul class="dropdown-menu">
                
                                <li><a href="transfers.php">Transfer Requests</a></li>
                                    ';
                        } else{
                           
                        }
                    ?>
           </div>
</nav>
  

    </header>
</body>

</html>
