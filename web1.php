<!doctype html>
<html>
<head>
	<title>WEB SERIES RATINGS SYSTEM</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="\css\myStyles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<?php
		
		$database = new mysqli("localhost", "palak123", "palak12384", "g1");
	    // Check connection
       if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
      }
	   ?>

<div class="container-fluid">
<h2>THE #1 WEBSITE FOR ALL YOUR FAVOURITE WEB-SERIES</h2>
<h3>SHOWS | REVIEWS | TRENDING | RATINGS | AND MORE...</h3>
</div>

<h3> All your favourite web-series can be viewed here! </h3>

 <table border = "2" cellpadding = "3" cellspacing = "2" style = "background-color: ADD8E6" padding="50px">
	   
	   <tr>
	    <td>Images</td> 
	   	<td>Web ID</td>
		 <td>Series</td>	
		 <td>Current Rating</td>
		 <td>Past Rating</td>	
		<td>Description</td>
		<td>Reviews</td>
		</tr>
<?php
		$url=""; 
		$sql = "SELECT ShowDetails.web_id, ShowDetails.name, ShowDetails.current_rating, ShowDetails.past_rating, ShowDetails.Description,
		        ReviewDetails.comment from ShowDetails JOIN ShowReview ON ShowDetails.web_id = ShowReview.web_id JOIN ReviewDetails ON 
				ShowReview.review_id = ReviewDetails.review_id WHERE 1";

			if (! ($result = $database->query($sql) ) ) {
				echo ("Could not execute query! <br>");
				die("Terminating");
			}
			while($row = $result->fetch_array()) {

										echo "<tr>";
										echo "<td>" . $row['Images'] . "</td>"; 
										echo "<td>" . $row['web_id'] . "</td>";
										echo "<td>" . $row['name'] . "</td>";
										echo "<td>" . $row['current_rating'] . "</td>";
										echo "<td>" . $row['past_rating'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['comment'] . "</td>";
                                        $url= "update.php?current_rating=". $row['current_rating']."&comment=".$row['comment'];
										echo "<td>";
										echo "<a href=".$url.">Update Record</a>";
										echo "</td>";
                                        echo "</tr>";
										
			}
    $database->close(); 
?>
</div>

</body>
</html>