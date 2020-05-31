<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO contacts (name,email,phone) VALUES ('".$_POST["name"]."', '".$_POST["email"]."','".$_POST["phone"]."')";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM contacts WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name'] = $row['name'];
			$output['email'] = $row['email'];
			$output['phone'] = $row['phone'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE contacts 
		SET name = '".$_POST["name"]."', 
		email = '".$_POST["email"]."',
		phone = '".$_POST["phone"]."' 
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
		
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM contacts WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
		
	}
	
}

?>