<?php 
    //start a session - users browser
    session_start();

    //setting a cookie
    $sessionID = session_id(); //storing session id

    //generate CSRF token
    if(empty($_SESSION['key']))
    {
        $_SESSION['key']=bin2hex(random_bytes(32));
    }

    $token = hash_hmac('sha256',$sessionID,$_SESSION['key']);
    

    setcookie("session_id_as2",$sessionID,time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
    setcookie("csrftoken",$token,time()+3600,"/","localhost",false,true); //csrf token cookie


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title> ASSIGNMENT 02 Double Submit Cookies Patterns</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="configuer.js"> </script>	
</head>
    <body>
    <div class="login-box">
    <img src="avatar.png" class="avatar">
        <h1>Login Here</h1>
            <form  method="POST" action="serve.php">
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Email">
            <p>Password</p>
            <input type="password" name="userpassword" placeholder="Enter Password">
            <input type="submit" name="submit" id = "submit" value="Login">
            <a href="#">Forget Password</a>    
            </form>
        
        
        </div>
		
<!-- Assign CSRF token to hidden variable -->
<script> document.getElementById("csToken").value = '<?php echo $token; ?>' </script>

    
    </body>
</html>


