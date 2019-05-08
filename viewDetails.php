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
        text-align:right;}
		
		table{
			text-align:left;
			border-collapse: collapse;
			border:1px solid white;
		}
		h2{
			color:white;
			text-align:center;
		}
		h3{
			color:purple;
			text-align:center;
		}
		.logout{
			text-align=right;
		}
		.tableW{
			color: white;
		}
		h6{
			color:white;
			text-align:left;
		}
		.rating{
			
			color:white;
			text-align:left;
			vertical-align: text-bottom;
		
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
<h3>SHOWS | REVIEWS | RATINGS | AND MORE...</h3>
</div>

<h3>Welcome <?php echo $user_name ?> !! </h3>
<h3> Show Ratings and Reviews! </h3>
<div  class ="logout" >
<a href="logout.php" align="right" class="btn btn-danger">Log Out</a>
</div>


<div class ="tableW">
<?php
$WID= $_GET['web_id'];

		
		$sql3 ="SELECT  name, description FROM ShowDetails WHERE web_id =$WID ";

		$resultShowName = $database->query($sql3);
		$row1 = $resultShowName->fetch_array();
		$showName= $row1['name'];

?>


 <table border = "2" cellpadding = "3" cellspacing = "2" style = "background-color: ADD8E6" align="left" padding="50px">
	   
	   <tr>
	   	<td><strong><?php echo $showName;?></strong> Reviews!!</td>
		</tr>
<?php			
$url=""; 
		$sql2="SELECT avg(ReviewDetails.show_rating) as total_rating FROM ReviewDetails JOIN ShowReview ON (ReviewDetails.review_id =ShowReview.review_id)
		WHERE ShowReview.web_id = $WID";

		$result2 = $database->query($sql2);
		$row2 =$result2->fetch_array();
		$cuRating = $row2['total_rating'];
		//$pastRating= $row2['past_rating'];
		
		echo "<h6>"."Show Current Rating ".$cuRating."/5"."</h6>";
		//echo "<h6>"."Past Rating ".$pastRating."/5"."<h6>";
		
			$sql = "SELECT UserProfile.user_id, UserProfile.user_name, ReviewDetails.comment FROM UserProfile JOIN UserReviews On (UserProfile.user_id = UserReviews.user_id)
						Join ReviewDetails ON (UserReviews.review_id = ReviewDetails.review_id)
						Join ShowReview ON (ReviewDetails.review_id = ShowReview.review_id)
						Where ShowReview.web_id=$WID";
				
			if (! ($result = $database->query($sql) ) ) {
				echo ("Could not execute query! <br>");
				die("Terminating");
			}
			while($row = $result->fetch_array()) {

										echo "<tr>";
										//echo "<td>" . "Show Name:". $row['name'] . "<br>";
										 echo  "<td>".$row['user_name'] . ":";
                                        echo   $row['comment'] . "<br>";
										echo "</td>";
                                        echo "</tr>";
										
			}
    $database->close(); 
?>
</div>

<div  class="rating">
<form method="post" action="http://palak123.psjconsulting.com/addComments.php?showID=<?php echo $WID; ?>">
<label>Choose Rating</label>
<input type="radio" name="rating" value="1"> 1
<input type="radio" name="rating" value="2"> 2
<input type="radio" name="rating" value="3"> 3
<input type="radio" name="rating" value="4"> 4
<input type="radio" name="rating" value="5"> 5
<br>
<label>Write your review</label><br>
<input type="text" name="review"><br>
<input type="submit" value="Add views" class="btn btn-primary">
</form>

</div>
<a href="webDetails.php" class="btn btn-primary">View All Shows</a>
</body>
</html>