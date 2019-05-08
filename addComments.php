<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.html");
    exit;
}else{
	$user_id =$_SESSION["id"];
	$user_name = $_SESSION["username"];
}
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	$user_rating = $_POST["rating"];
	$user_review = $_POST["review"];
	//echo $user_name;
}else{
	echo "fails";
}
	
?>
<!-- addComments.php                 -->
<!-- Read information sent from addcomment.html -->
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
<title>Reviews</title>
</head>

<body>
<p >Your Rating </p>
<p>Your Review</p>

<?php
$database = new mysqli('localhost', 'palak123', 'palak12384', 'g1');
if ($database->connect_error) {
die("Connection failed: " . $database->connect_error);
}



$sql= "INSERT INTO ReviewDetails(comment, show_rating ) VALUES ('$user_review','$user_rating')";

 $result = $database->query ($sql);

 if(!($result)){
 	echo "error";
 }

$sql1= "SELECT count(*) as reviewCount  FROM ReviewDetails";
$result1 = $database->query ($sql1);
$rowCount=0;

if($result1){
while($rCount= $result1->fetch_array()){
	$rowCount =  $rCount['reviewCount'];
	$rowCount = $rowCount+1;
}
//echo $rowCount;
}

 $sID =$_GET["showID"];	
 echo  $sID;


$sql2= "INSERT INTO ShowReview (web_id, review_id) VALUES ('$sID','$rowCount');";
$result2 = $database->query ($sql2);

if(!(result2)){
	echo "error in inserting";
}

$sql3 = "INSERT INTO UserReviews(user_id, review_id) VALUES ('$user_id','$rowCount');";
$result3 = $database->query ($sql3);

if(!result3){
	echo "error in inserting";
}
else{
	header("location: viewDetails.php?web_id=$sID");
}

?>
</body>
</html>