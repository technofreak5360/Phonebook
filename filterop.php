<?php

$search_value = $_POST["query"];

$conn = mysqli_connect("localhost","root","","addressbook") or die("Connection Failed");

$sql = "SELECT * FROM contacts WHERE name LIKE '%{$search_value}%' OR phone LIKE '%{$search_value}%'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
    <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>

    </tr>';

    while($row = mysqli_fetch_assoc($result)){
      $output .= "<tr><td>{$row["name"]}</td><td align='center'>{$row["email"]}</td><td align='center'>{$row["phone"]}</td></tr>";
    }
$output .= "</table>";

mysqli_close($conn);

echo $output;
}else{
echo "<h2>No Record Found.</h2>";
}


?>
