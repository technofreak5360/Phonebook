<?php 
session_start();

$mysqli = new mysqli('localhost','root','','phone') or die(mysqli_error($mysqli));

$name = "";
$email = "";
$phone = "";

if(isset($_POST['save']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['mobile'];


    $mysqli->query("INSERT into contacts(name,email,phone) VALUES('$name','$email','$phone')") or die($mysqli->error);
    

    $_SESSION['msg'] = "Details has been saved :)";
    $_SESSION['msg_type'] = "success";

    header('Location: index.php');
}

if(isset($_GET['delete']))
{
$id = $_GET['delete'];
 $mysqli->query("DELETE FROM contacts where id=$id") or die($mysqli->error);

 $_SESSION['msg'] = "user Data has been deleted";
 $_SESSION['msg_type'] = "danger";

 header('Location: index.php');
}

if(isset($_GET['edit']))
{
$id = $_GET['edit'];
 $result = $mysqli->query("SELECT * FROM contacts where id=$id") or die($mysqli->error);
 if($result->num_rows){
    $row = $result->fetch_array();
    $name = $row['name'];
    $email =  $row['email'];
    $phone =  $row['phone'];
   // header('Location: index.php');
 }
 
}

?>