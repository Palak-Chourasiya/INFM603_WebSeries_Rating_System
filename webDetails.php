<!doctype html>
<html>
<head>
	<title>WEB SERIES RATINGS SYSTEM</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="\css\myStyles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>

<style>
        body {background-color: black;
        color: powderblue;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 20px;
        text-align:center;}
		
		table{
			text-align:left;
			border-collapse: collapse;
			border:1px solid white;
		}
		h2{
			color:white;
		}
		h3{
			color:purple;
		}
		.logout{
			align=right;
		}
		.tableW{
			color: white;
		}
</style>
<?php
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.html");
    exit;
}else{
	$user_id =$_SESSION["id"];
	$user_name = $_SESSION["username"];
}
		$database = new mysqli('localhost', 'palak123', 'palak12384', 'g1');
	    // Check connection
       if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
      }
	   ?>

<div class="container-fluid">
<h2>THE #1 WEBSITE FOR ALL YOUR FAVOURITE WEB-SERIES</h2>
<h3>SHOWS | REVIEWS | RATINGS | AND MORE...</h3>
</div>

<h3>Welcome <?php echo $user_name ?> !! </h3>
<h3> All your favorite web-series can be viewed here! </h3>
<div  class ="logout" >
<a href="logout.php" align="right" class="btn btn-danger">Log Out</a>
</div>
<div class ="tableW">
 <table border = "2" cellpadding = "3" cellspacing = "2" style = "background-color: ADD8E6" align="left" padding="50px">
	   
	   <tr>
	   	<td>Web Series</td>
		</tr>
<?php
		$url=""; 
		$sql = "SELECT  ShowDetails.web_id, ShowDetails.name,ShowDetails.Description from ShowDetails WHERE 1";

			if (! ($result = $database->query($sql) ) ) {
				echo ("Could not execute query! <br>");
				die("Terminating");
			}
			while($row = $result->fetch_array()) {

										echo "<tr>";
										echo "<td>" . "Show Name:". $row['name'] . "<br>";
                                        echo   $row['Description'] . "<br>";
										$url= "viewDetails.php?web_id=". $row['web_id']."&uid=".$user_id;
										echo "<a href=".$url.">View Comments and Ratings</a>";
										echo "</td>";
                                        echo "</tr>";
										
			}
    $database->close(); 
?>
</div>

</body>
</html>