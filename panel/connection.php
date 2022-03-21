<?php  
    $conn = mysqli_connect("localhost", "ad_ldus", "umWs78#9", "lead_prod");
    if (! $conn) {  
    	die("Connection failed" . mysqli_connect_error());  
    }  
    else {  
    		mysqli_select_db($conn, 'pagination');  
    }  
?>  