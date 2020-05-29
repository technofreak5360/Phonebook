<?php 
$mysqli = new mysqli('localhost','root','','phone') or die(mysqli_error($mysqli));
if(isset($_POST['save']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['mobile'];

    $mysqli->query("INSERT into contacts(name,email,phone) VALUES('$name','$email','$phone')") or die($mysqli->error);
    
}
//$conn->close();
//header('Location: index.php');

?>