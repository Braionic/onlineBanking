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
                        
<div class="container">
    <?php //DELETE FROM PROVIDE TABLE BEGINS

  if(isset($_GET['deleted'])) {

 echo '<div class="alert alert-danger text-center alert-dismissable">

 <button type="button" class="close" data-dismiss="alert">&times;</button>

 <strong>Row Deleted successfully</strong></div>';

    }

?>
<h2 class="">Transfer Requests</h2>
<table class="table table-striped">
  <tr class="table-success">
    <td style= "background-color: #fdc600;">No.</td>
    <td style= "background-color: #fdc600;">Client Name</td>
      <td style= "background-color: #fdc600;">Beneficiary Name</td>
      <td style= "background-color: #fdc600;">Transaction Amount</td>
    <td style= "background-color: #fdc600;">Bank Name</td>
    <td style= "background-color: #fdc600;">Account Number</td>
    <td style= "background-color: #fdc600;">Description</td>
    <td style= "background-color: #fdc600;">Address</td>
    <td style= "background-color: #fdc600;">Last Updated</td>
      <td style= "background-color: #fdc600;">Client ID</td>
      <td style= "background-color: #fdc600;">Action</td>
  </tr>

<?php


$records = mysqli_query($conn,"Select * from int_transfer ORDER BY last_updated DESC"); // fetch data from database
$i = 1;
while($data = mysqli_fetch_array($records))
{ $i++;
?>
  <tr>
      
    <td><?php echo $i; ?></td>
    <td><?php echo $data['name']; ?></td>
      <td><?php echo $data['b_name']; ?></td>
      <td><?php echo $data['amount']; ?></td>
<td><?php echo $data['bank_name']; ?></td>
<td><?php echo $data['b_acct']; ?></td>
<td><?php echo $data['description']; ?></td>
<td><?php echo $data['address']; ?></td>
    <td><?php echo $data['last_updated']; ?></td>
    <td><?php echo $data['user_id']; ?></td>
    <td class="btn btn-warning delete_acct"><a href='delete1.php?rn=<?php echo $data['ID']; ?>'>delete</a></td>
  </tr>	
<?php
}
?>
</table>
</div>

                        <?php include 'footer.php' ?>
    </body>