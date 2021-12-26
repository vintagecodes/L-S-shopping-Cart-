<?php
require('connection.inc.php');
// Declaring and hoisting the variables
$username = "";
$email    = "";
$errors = array();
$_SESSION['success'] = "";

   
// Registration code
if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $repassword = mysqli_real_escape_string($con,$_POST['repassword']);

    
   
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if(empty($repassword)){ array_push($errors, "Password is required");}
   
    if (count($errors) == 0) {

    	if($password!=$repassword){
    		echo '<script>alert("Password not matched ")</script>'; 
    	}
          
        // Password encryption to increase data security
          
        // Inserting data into table
        $query = "INSERT INTO admin_users (username, email, password, repassword) 
                  VALUES('$username', '$email', '$password', $repassword)"; 
          
        mysqli_query($con, $query);
   
        // Storing username of the logged in user,
        // in the session variable
        $_SESSION['username'] = $username;
          
        // Welcome message
        $_SESSION['success'] = "You have logged in";
          
        // Page on which the user will be 
        // redirected after logging in
        header('location: homepage.php'); 
    }
}