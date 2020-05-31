<?php

//fetch.php

include("database_connection.php");

$query = "SELECT * FROM contacts";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
<table class="table table-striped table-bordered">
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>PHONE</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td width="40%">'.$row["name"].'</td>
			<td width="40%">'.$row["email"].'</td>
			<td width="40%">'.$row["phone"].'</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-m edit" id="'.$row["id"].'">Edit</button>
			</td>
			<td width="10%">
				<button type="button" name="delete" class="btn btn-danger btn-m delete" id="'.$row["id"].'">Delete</button>
			</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="5" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>