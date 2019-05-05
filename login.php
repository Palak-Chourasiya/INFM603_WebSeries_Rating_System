<?php
$mysqli = new mysqli('localhost', 'palak123', 'palak12384', 'g1');
 
// Check connection
if($mysqli === false){
    die("Could not connect to database!!!" . $mysqli->connect_error);
}
?>
<?php
// start session
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	$userID=$_SESSION["id"];
    header("location: webDetails.php?ID=$userID");
    exit;
}
 

$username = $password = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    
        $username = trim($_POST["username"]);
    
    
        $password = $_POST["password"];
    
    if(!empty($username) && !empty($password)){

        $sql ="SELECT  user_id ,  user_name ,  password FROM  UserProfile WHERE  user_name ='$username'";

        $result= $mysqli->query($sql);
        if(!($result)){
            echo "Couldn't Execute query";
        }
        if (count($result) == 1 ) {
            $row = mysqli_fetch_array($result);

            $dbPassword=$row['password'];
			$id=$row['user_id'];
            if(password_verify($password, $dbPassword)){
                session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            header("location: webDetails.php?ID=$id");
							
							
            echo "welcome to our rating app ".$row['user_name'];
            

        }else{
            echo "You have entered a wrong password.. ";
            echo "<a href="."http://palak123.psjconsulting.com/login.html".">Please retry here</a>";
        }
        }        
    }
    else{
            echo "You have not entered mandatory username or password fields";
            echo "<a href="."http://palak123.psjconsulting.com/login.html".">Please retry here</a>";
        }
    $mysqli->close();
}
?>
 