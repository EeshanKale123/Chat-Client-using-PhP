<?php
include_once 'db_connect.php';
include_once 'register-validate.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>E-Shaz Chat</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
	
	<div id="createAccount" style="background-color:lightblue">
        <h1>Chat Register</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
                method="post" 
                name="registration_form">
            First name: <input type='text' 
                name='firstname' 
                id='firstname' /><br>
				</br>
            Last name: <input type='text' 
            	name='lastname' 
            	id='lastname' /><br></br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: <input type="text" name="email" id="email" /><br></br>
            &nbsp;&nbsp;Password: <input type="password"
                             name="password" 
                             id="password"/><br></br>
            &nbsp;&nbsp;&nbsp;Re-enter : <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /><br></br>
            <input type="submit" 
                   value="Register" /> 
        </form>
		<p>Return to the <a href="/chatapp/login.php">login page</a>.</p>
		
    </body>
</html>
