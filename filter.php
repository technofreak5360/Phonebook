<?php 
function filter()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "addressbook";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM contacts";
    $result = $conn->query($sql);
    return $result;
}
?>