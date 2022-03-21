<?php
  	$name =  trim($_REQUEST['name']);
	$phone =  trim($_REQUEST['phone']);
	$year = trim($_REQUEST['year']);
	$email = trim($_REQUEST['email']);
	$dt = date("Y-m-d H:i:s", strtotime('+5 hours +30 minutes'));
	if($name && $phone && $year && $email) {
		// servername => localhost
		// username => root
		// password => empty
		// database name => staff
		$conn = mysqli_connect("localhost", "ad_ldus", "umWs78#9", "lead_prod");

		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. " 
				. mysqli_connect_error());
		}

		// Taking all 5 values from the form data(input)
		

		// Performing insert query execution
		// here our table name is college
		$sql = "INSERT INTO leads (`name`, `phone`, `email`, `year`, `created_at`, `updated_at`) VALUES 
		('$name','$phone','$email','$year','$dt','$dt' )";

		if(mysqli_query($conn, $sql)){
			echo "<script LANGUAGE='JavaScript'>
			window. alert('Thank you for connecting. We will contact you soon.');
			window. location. href='thank-you.html';
			</script>"; 

		} else{
			echo "<script LANGUAGE='JavaScript'>
			window. alert('Sorry! Try again later');
			window. location. href='index.html';
			</script>"; 
			//echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
		}

		// Close connection
		mysqli_close($conn);
	}else{
		echo "<script LANGUAGE='JavaScript'>
			window. alert('Sorry! some fields are empty');
			window. location. href='index.html';
			</script>"; 
		//echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}
?>