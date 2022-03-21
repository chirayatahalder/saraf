<?php
	session_start();
	if($_SESSION["name"]) {
		
	}
	else {
		header("Location:login.php");
	}
?>

	<html>   
      <head>   
        <title>Saraf Academy</title>   
        <link rel="stylesheet"  
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
        <style>   
        table {  
            border-collapse: collapse;  
        }  
            .inline{   
                display: inline-block;   
                float: right;   
                margin: 20px 0px;   
            }   
             
            input, button{   
                height: 34px;   
            }   
      
        .pagination {   
            display: inline-block;   
        }   
        .pagination a {   
            font-weight:bold;   
            font-size:18px;   
            color: black;   
            float: left;   
            padding: 8px 16px;   
            text-decoration: none;   
            border:1px solid black;   
        }   
        .pagination a.active {   
                background-color: pink;   
        }   
        .pagination a:hover:not(.active) {   
            background-color: skyblue;   
        }   
            </style>   
      </head>   
      <body>   
      <center>  
        <?php  
          
        // Import the file where we defined the connection to Database.     
            require_once "connection.php";   
        
            $per_page_record = 20;  // Number of entries to show in a page.   
            // Look for a GET variable page if not found default is 1.        
            if (isset($_GET["page"])) {    
                $page  = $_GET["page"];    
            }    
            else {    
              $page=1;    
            }    
        
            $start_from = ($page-1) * $per_page_record;     
        
            $query = "SELECT * FROM leads order by id desc LIMIT $start_from, $per_page_record";     
            $rs_result = mysqli_query ($conn, $query);    
        ?>    
      
        <div class="container">   
          <br>   
		  <a href="logout.php" style="float: right; border: 1px solid; border-radius: 4px; padding: 5px;">Logout</a>
          <div>   
            <img src="../images/top-logo.png" alt="Saraf" style="width: 100px;" class="img-responsive img-logo">   
            <p>Lead Management 
            </p>   
			  
            <table class="table table-striped table-condensed    
                                              table-bordered">   
              <thead>   
                <tr>   
                  <th width="10%">#</th>   
                  <th>Name</th>   
                  <th>Email</th>   
                  <th>Phone</th>   
                  <th>Last Qualification</th>  
                  <th>Received On</th>   
                </tr>   
              </thead>   
              <tbody>   
        <?php     
                while ($row = mysqli_fetch_array($rs_result)) {    
                      // Display each field of the records.    
                ?>     
                <tr>     
                 <td><?php echo $row["id"]; ?></td>     
                <td><?php echo $row["name"]; ?></td>   
                <td><?php echo $row["email"]; ?></td>   
                <td><?php echo $row["phone"]; ?></td>     
                <td><?php echo $row["year"]; ?></td> 
                <td><?php echo $row["created_at"]; ?></td> 
                </tr>     
                <?php     
                    };    
                ?>     
              </tbody>   
            </table>   
      
         <div class="pagination">    
          <?php  
            $query = "SELECT COUNT(*) FROM leads";     
            $rs_result = mysqli_query($conn, $query);     
            $row = mysqli_fetch_row($rs_result);     
            $total_records = $row[0];     
              
        echo "</br>";     
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);     
            $pagLink = "";       
          
            if($page>=2){   
                echo "<a href='index.php?page=".($page-1)."'>  Prev </a>";   
            }       
                       
            for ($i=1; $i<=$total_pages; $i++) {   
              if ($i == $page) {   
                  $pagLink .= "<a class = 'active' href='index.php?page="  
                                                    .$i."'>".$i." </a>";   
              }               
              else  {   
                  $pagLink .= "<a href='index.php?page=".$i."'>   
                                                    ".$i." </a>";     
              }   
            };     
            echo $pagLink;   
      
            if($page<$total_pages){   
                echo "<a href='index.php?page=".($page+1)."'>  Next </a>";   
            }   
      
          ?>    
          </div>  
      
      
          <div class="inline">   
          <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   
          placeholder="<?php echo $page."/".$total_pages; ?>" required>   
          <button onClick="go2Page();">Go</button>   
         </div>    
        </div>   
      </div>  
    </center>   
      <script>   
        function go2Page()   
        {   
            var page = document.getElementById("page").value;   
            page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
            window.location.href = 'index.php?page='+page;   
        }   
      </script>  
      </body>   
    </html>  