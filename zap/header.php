<!DOCTYPE html>
<html>

<head>
  <title>HSBCA | Always giving you extra</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../queries.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="../jquery-ui-1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../jquery-ui-1.12.1/jquery-ui.structure.css">
  <link rel="stylesheet" href="../jquery-ui-1.12.1/jquery-ui.theme.css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
  <script src="../script.js"></script>
  <script src="../jquery-ui-1.12.1/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<script>
  function handleShow() {
    const btn = document.getElementById("trans");
    btn.style.display = "block"
  }

  function handleHide() {
    const btn = document.getElementById("trans");
    btn.style.display = "none"
  }
</script>
<style>
  * {
    box-sizing: border-box;
    margin: 0px;
  }

  body {
    font-family: 'Roboto', sans-serif;
  }

  .resend-otp:disabled {
    color: red;
    padding: 10px;
    background-color: blue;
  }

  /*
  input[type=text],
  select {
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
  } */

  input[type=text],
  select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;

  }

  input[type=text]:focus {
    background-color: #005eb8;
    color: white;
  }

  textarea {
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

  div .pgd {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    flex-direction: row;
    flex-wrap: nowrap;
    margin-top: 50px;
    margin-bottom: 30px;
    background-color: #f8f9fc;
    padding: 16px;
    border-radius: 6px;
    color: blach;
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

  .div1,
  .div2,
  .div3,
  .div4 {
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
    flex-grow: 1;
  }

  .name-bar {
    margin-top: 20px;
    padding: 10px;
  }

  .top-bar {
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px
  }

  th {
    background-color: rgba(220, 0, 0, 0.5);
    color: white
  }



  @media only screen and (max-width: 700px) {

    .div1,
    .div2,
    .div3,
    .div4 {
      width: 40%;
      margin-right: 3px;
    }

    .dashboard-container {
      flex-direction: row;
    }
  }

  @media only screen and (max-width: 450px) {

    .div1,
    .div2,
    .div3,
    .div4 {
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


  .earning {
    margin-bottom: 5px;
  }

  h5 {
    font-weight: 600;
  }

  a:hover {
    text-decoration: none;
    color: blue;
  }

  .profilebtns {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .delete_acct {
    background-color: red;
  }

  .logincontainer {
    width: 80%;
    height: 50%;
    pad: 16px;
  }

  .bg-login-image {

    background-position: center;
    background-size: cover;
  }

  .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
  }

  .card>hr {
    margin-right: 0;
    margin-left: 0;
  }

  .card>.list-group {
    border-top: inherit;
    border-bottom: inherit;
  }

  .card>.list-group:first-child {
    border-top-width: 0;
    border-top-left-radius: calc(0.35rem - 1px);
    border-top-right-radius: calc(0.35rem - 1px);
  }

  .card>.list-group:last-child {
    border-bottom-width: 0;
    border-bottom-right-radius: calc(0.35rem - 1px);
    border-bottom-left-radius: calc(0.35rem - 1px);
  }

  .card>.card-header+.list-group,
  .card>.list-group+.card-footer {
    border-top: 0;
  }

  .card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
  }

  .card-title {
    margin-bottom: 0.75rem;
  }

  .card-subtitle {
    margin-top: -0.375rem;
    margin-bottom: 0;
  }

  .card-text:last-child {
    margin-bottom: 0;
  }

  .card-link:hover {
    text-decoration: none;
  }

  .card-link+.card-link {
    margin-left: 1.25rem;
  }

  .card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
  }

  .card-header:first-child {
    border-radius: calc(0.35rem - 1px) calc(0.35rem - 1px) 0 0;
  }

  .card-footer {
    padding: 0.75rem 1.25rem;
    background-color: #f8f9fc;
    border-top: 1px solid #e3e6f0;
  }

  .card-footer:last-child {
    border-radius: 0 0 calc(0.35rem - 1px) calc(0.35rem - 1px);
  }

  .card-header-tabs {
    margin-right: -0.625rem;
    margin-bottom: -0.75rem;
    margin-left: -0.625rem;
    border-bottom: 0;
  }

  .card-header-pills {
    margin-right: -0.625rem;
    margin-left: -0.625rem;
  }

  .card-img-overlay {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    padding: 1.25rem;
    border-radius: calc(0.35rem - 1px);
  }

  .card-img,
  .card-img-top,
  .card-img-bottom {
    flex-shrink: 0;
    width: 100%;
  }

  .card-img,
  .card-img-top {
    border-top-left-radius: calc(0.35rem - 1px);
    border-top-right-radius: calc(0.35rem - 1px);
  }

  .card-img,
  .card-img-bottom {
    border-bottom-right-radius: calc(0.35rem - 1px);
    border-bottom-left-radius: calc(0.35rem - 1px);
  }

  .card-deck .card {
    margin-bottom: 0.75rem;
  }

  @media (min-width: 576px) {
    .card-deck {
      display: flex;
      flex-flow: row wrap;
      margin-right: -0.75rem;
      margin-left: -0.75rem;
    }

    .card-deck .card {
      flex: 1 0 0%;
      margin-right: 0.75rem;
      margin-bottom: 0;
      margin-left: 0.75rem;
    }
  }

  .card-group>.card {
    margin-bottom: 0.75rem;
  }

  @media (min-width: 700px) {
    .txt {
      text-align: left;
    }
  }

  .card-group>.card {
    flex: 1 0 0%;
    margin-bottom: 0;
  }

  .card-group>.card+.card {
    margin-left: 0;
    border-left: 0;
  }

  .card-group>.card:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .card-group>.card:not(:last-child) .card-img-top,
  .card-group>.card:not(:last-child) .card-header {
    border-top-right-radius: 0;
  }

  .card-group>.card:not(:last-child) .card-img-bottom,
  .card-group>.card:not(:last-child) .card-footer {
    border-bottom-right-radius: 0;
  }

  .card-group>.card:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  .card-group>.card:not(:first-child) .card-img-top,
  .card-group>.card:not(:first-child) .card-header {
    border-top-left-radius: 0;
  }

  .card-group>.card:not(:first-child) .card-img-bottom,
  .card-group>.card:not(:first-child) .card-footer {
    border-bottom-left-radius: 0;
  }
  }

  .card-columns .card {
    margin-bottom: 0.75rem;
  }

  @media (min-width: 576px) {
    .card-columns {
      -moz-column-count: 3;
      column-count: 3;
      -moz-column-gap: 1.25rem;
      column-gap: 1.25rem;
      orphans: 1;
      widows: 1;
    }

    .card-columns .card {
      display: inline-block;
      width: 100%;
    }
  }

  .accordion {
    overflow-anchor: none;
  }

  .accordion>.card {
    overflow: hidden;
  }

  .accordion>.card:not(:last-of-type) {
    border-bottom: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .accordion>.card:not(:first-of-type) {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .accordion>.card>.card-header {
    border-radius: 0;
    margin-bottom: -1px;
  }

  .o-hidden {
    overflow: hidden !important;
  }

  .border-0 {
    border: 0 !important;
  }

  .shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
  }

  .my-5 {
    margin-top: 3rem !important;
  }

  .mb-5,
  .my-5 {
    margin-bottom: 3rem !important;
  }

  .d-none {
    display: none !important;
  }

  .d-lg-block {
    display: block !important;
  }

  .p-5 {
    padding: 3rem !important;
  }

  .text-center {
    text-align: center !important;
  }

  .text-gray-900 {
    color: #3a3b45 !important;
  }

  .mb-4,
  .my-4 {
    margin-bottom: 1.5rem !important;
  }

  .form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6e707e;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d1d3e2;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  form.user .form-control-user {
    font-size: 0.8rem;
    border-radius: 10rem;
    padding: 1.5rem 1rem;
  }


  .was-validated .custom-control-input:valid~.custom-control-label,
  .custom-control-input.is-valid~.custom-control-label {
    color: #1cc88a;
  }

  .was-validated .custom-control-input:valid~.custom-control-label::before,
  .custom-control-input.is-valid~.custom-control-label::before {
    border-color: #1cc88a;
  }

  .was-validated .custom-control-input:valid:checked~.custom-control-label::before,
  .custom-control-input.is-valid:checked~.custom-control-label::before {
    border-color: #34e3a4;
    background-color: #34e3a4;
  }

  .was-validated .custom-control-input:valid:focus~.custom-control-label::before,
  .custom-control-input.is-valid:focus~.custom-control-label::before {
    box-shadow: 0 0 0 0.2rem rgba(28, 200, 138, 0.25);
  }

  .was-validated .custom-control-input:valid:focus:not(:checked)~.custom-control-label::before,
  .custom-control-input.is-valid:focus:not(:checked)~.custom-control-label::before {
    border-color: #1cc88a;
  }

  .custom-control-input:checked~.custom-control-label::before {
    color: #fff;
    border-color: #4e73df;
    background-color: #4e73df;
  }

  .custom-control-input:focus~.custom-control-label::before {
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
  }

  .restricted {
    color: red;
  }

  .allowed {
    color: green;

  }

  .profilebtn {
    margin: 10px;
    padding: 4px 8px;
  }

  .profilebtn:hover {
    background-color: grey;
    box-shadow: 1px 1px 1px black;
  }

  .restore {
    background-color: green;
    color: white;
    border-radius: 4px;
    border: none;
  }

  .limit {
    background-color: red;
    color: white;
    border-radius: 4px;
    border: none;
  }
</style>

<body>

  <header>

    <nav class="navbar navbar-inverse" style="background-color: white;">
      <div class="container-fluid;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"
            style="background-color: red;">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="index.php"><img src="../images/HSBC_UK.png" width="100px" height="50px"
              style="margin-top: -14;" alt="HSBCA" class="logo"></a>-->
        </div>



        <?php
                    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
                        echo '
                        <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
        <li><a href="index.php" class="btn" style="color: black">Dashboard</a></li>
        <li><a href="fund_client.php" class="btn" style="color: black">Fund Client</a></li>
      <!--<li><a href="debit_client.php" class="btn">Debit Client</a></li>-->
      <li><a href="blockuser.php" class="btn" style="color: black">Restrict Client</a></li>
      <li><a href="addtransaction.php" class="btn" style="color: black">Add Transactions</a></li>
      <li><a href="all_users.php" class="btn" style="color: black">View Users</a></li>
      <li><a href="transfers.php" class="btn" style="color: black">Withdrawal Request</a></li>
      <li><a href="logout.php" style="color: black"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      
      </ul>
      ';
                    } else {
                    }
        ?>

      </div>
      </div>
    </nav>
  </header>
</body>

</html>