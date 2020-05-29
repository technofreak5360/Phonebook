
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Phonebook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">

<?php 
if(isset($_SESSION['msg'])):
?>

<div class="alert alert-<?php=$_SESSION['msg_type'] ?>">
<?php 
echo $_SESSION['msg'];
unset($_SESSION['msg']);

?>
</div>
<?php endif ?>


  <h2>Phonebook</h2>

  <?php require_once 'savedata.php';  ?>

   <?php 
   function pre_r($array)
   {
     echo '<pre>';
     print_r($array);
     echo '<pre>';
   }
   
   ?>
  <!-- Trigger the modal with a button -->
  <a data-toggle="modal" data-target="#myModal"><img src="add.jpg"  height="55px" src="add.jpg" /></a>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <form action="savedata.php" method="post">
          <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input type="text" name="name" class="form-control"  value="<?php echo $name; ?>" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" aria-describedby="emailHelp"  value="<?php echo $email; ?>" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputphone">Phone Number</label>
    <input type="text" name="mobile" class="form-control"  value="<?php echo $phone; ?>" placeholder="Phone Number">
  </div>
  <button type="submit" name="save" class="btn btn-primary">Save</button>
</form>
        </div>
      </div>
      
    </div>
  </div>
  
<div class=" row justify-content-center">
<table class="table">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th colspan="2">action</th>
</tr>
</thead>
<?php 
require 'fetchdata.php';
$result = fetchdata();
while($row = $result->fetch_assoc()):

?>
<tr>
<td> <?php echo $row['name'] ?> </td>
<td> <?php echo $row['email'] ?> </td>
<td> <?php echo $row['phone'] ?> </td>
<td> <a href="savedata.php?edit=<?php  echo $row['id']; ?> " class="btn btn-info">Edit</a> 
      <a href="savedata.php?delete=<?php  echo $row['id']; ?> " class="btn btn-danger">Delete</a>
</td>
</tr>
  <?Php endwhile; ?>
</table>

</div>
</div>
</body>
</html>
