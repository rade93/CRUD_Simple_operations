<?php 
	session_start();
	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$edit_state = false;

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'crud');

	// if save button is clicked
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];

		$query = "INSERT INTO info (name, address) VALUES ('$name', '$address')";
		mysqli_query($db, $query);
		$_SESSION['msg'] = "Address saved!";
		header('location: index.php'); // redirect to index page after inserting
	}

	// update records
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$address = $_POST['address'];

		mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
		$_SESSION['msg'] = "Address updated!"; 
		header('location: index.php');
	}

	// delete records
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM info WHERE id=$id");
		$_SESSION['msg'] = "Address deleted!"; 
		header('location: index.php');
	}

	// retrieve records
	$results = mysqli_query($db, "SELECT * FROM info");

?>