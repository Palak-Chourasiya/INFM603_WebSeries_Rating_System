<?php
$mysqli = new mysqli('localhost', 'palak123', 'palak12384', 'g1');
 
// Check connection
if($mysqli === false){
    die("Could not connect to database!!!" . $mysqli->connect_error);
}
?>

<?php
$username = $password = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
 
        if(!empty($username)){
            $sql= "SELECT  user_id FROM  UserProfile WHERE  user_name = '$username';";
        
        $result = $mysqli->query($sql);

        if(!($result)){
            echo "Couldn't Execute query";
        }

        if (count($result) == 1 ) {
            $row = mysqli_fetch_array($result);
            $enteredName =$row['user_name'];
            if($enteredName === $username){
                 echo "This username is already taken.";                 
        } else{
                    $NEWusername = trim($_POST["username"]);
        }   
        }      
    }
    // Validate password
        $password = $_POST["password"];
		$FirstName= $_POST["fname"];
		$LastName = $_POST["lname"];
		$Mobile =$_POST["mobile"];
		$email = $_POST["email"];
    
    // Check input errors before inserting in database
    if(!empty($NEWusername) && !empty($password)){  
        $DBpassword = password_hash($password, PASSWORD_DEFAULT); 

        $sql= "INSERT INTO UserProfile( first_name,last_name,email_id,phone_number, user_name, password ) VALUES ('$FirstName','$LastName','$email','$Mobile','$NEWusername','$DBpassword');";
        $result =$mysqli->query($sql);
        if(!($result)){
            echo "Couldn't Execute query";
        }else{
            header("location: login.html");
        }
        }
    $mysqli->close();
}
?>