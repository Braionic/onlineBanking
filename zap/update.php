<?php include '../includes/timeoutable.php' ?>

    <body>
        <?php include '../includes/db.php'; ?>
            <?php 
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
    } else { //IF NO USER LOGGED IN
        echo "<script type='text/javascript'> document.location = 'login.php?login_error=wrong'; </script>";
      //  header('Location: login.php?login_error=wrong');
    }
?>
                <?php include 'header.php';  ?>
                <?php

if(isset($_POST['update']))
{
    $id = $_POST['user_id']; //
    $mavro = $_POST['mavro'];
    $mavro2 = $_POST['mavro2'];
    $query = " UPDATE mavro SET mavro = $mavro, mavro2 = $mavro2 where ID = '$id'";
    $result = mysqli_query($conn,$query);
    if($result)
    {
        echo "<script type='text/javascript'> document.location = 'update.php?succes'; </script>";
       // header("location:addmavro.php");
    }
    else
    {
        echo ' Please Check Your Query ';
    }
}
else
{
    header("location:update.php");
}
                
                    ?>
        
                        <h3 class="text-center">Fund account</h3>
                        <div ng-app="">
                            <form method="POST" action="update.php" class="form-horizontal well text-center" enctype="multipart/form-data" role="form" name="myForm">
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="user_id"><p>Receiver ID</p>
                                    </label>
                                    <input type="text" name="user_id" id="user_id" value="<?php echo $_GET['edit'] ?>" placeholder="Enter Receiver" class="col-sm-3 col-xs-3" ng-model="user_id" required>
                                    <span style="color:red" ng-show="myForm.user_id.$touched && myForm.user_id.$invalid">
                                <span ng-show="myForm.user_id.$error.required"><P>Receiver Id is required.</P></span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="mavro"><P>Amount in Dollars</P>
                                    </label>
                                    <input type="text" name="mavro" id="mavro" value="<?php echo $row['mavro']; ?>"  class="col-sm-3 col-xs-3" ng-model="mavro" required>
                                    <span style="color:red" ng-show="myForm.mavro.$touched && myForm.mavro.$invalid">
                                <span ng-show="myForm.mavro.$error.required">Amount is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 col-xs-6" for="mavro"><P>Amount in Bitcoin</P>
                                    </label>
                                    <input type="text" name="mavro2" id="mavro2" value="<?php echo $row['mavro2']; ?>" placeholder="enter amount(B)" class="col-sm-3 col-xs-3" ng-model="mavro2" required>
                                    <span style="color:red" ng-show="myForm.mavro.$touched && myForm.mavro.$invalid">
                                <span ng-show="myForm.mavro.$error.required">Amount is required.</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6" for="match_mavro">
                                    </label>
                                    <input type="submit" name="update1" id="update" value="UPDATE" class="btn btn-primary cc" class="col-sm-6 col-xs-6">
                                </div>
                            </form>
                        </div>
                        
<div class="container">
<h2 class="">USERS Wallets</h2>
<table class="table table-striped">
  <tr>
    <td>Sr.No.</td>
    <td>Full Name</td>
    <td>USD</td>
    <td>BTC</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>

<?php


$records = mysqli_query($conn,"select * from mavro ORDER BY ID DESC"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['ID']; ?></td>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['mavro']; ?></td>
    <td><?php echo $data['mavro2']; ?></td>   
    <td><a href="update.php?edit=<?php echo $data['ID']; ?>">Edit</a></td>
    <td class="btn btn-warning"><a href="delete.php?Del=<?php echo $data['ID']; ?>">Delete</a></td>
  </tr>	
<?php
}
?>
</table>
</div>

                        <?php include 'footer.php' ?>
    </body>