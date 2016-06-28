<?php
include_once 'db_connect.php';
include_once 'login-functions.php';

if (login_check() == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if (isset($_POST['email'], $_POST['pass'])) {
    
    $email = $_POST['email'];
    $password = $_POST['pass']; 

 
    if (login($email, $password, $mysqli) == true) {
        header('Location: /chatapp/user-chat.php');
    } else {
        // Login failed 
        // header('Location: ../index.php?error=1');
        echo '<script language="javascript">';
					echo 'alert ( "Please enter valid data." ); ';
					echo '</script>';
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-Shaz Chat</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
	<div id="container" style="background-color:lightblue">
		<div id="userLogIn" style="background-color:lightblue">
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" name="login_form">                      
			</br></br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: <input type="text" name="email" />
			</br></br>
            Password: <input type="password" 
                             name="pass" 
                             id="pass"/>
							 </br></br>
            <input type="submit" 
                   value="Login" /> 
        </form>
		
 
<?php
        if (login_check() == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_COOKIE['username']) . '.</p>';
 
            echo '<p>Change user? <a href="/chatapp/logout-function.php">Log out</a>.</p>';
        } else {
                        echo '<p>Currently logged ' . $logged . '.</p>';
                        echo "<p>If you don't have a login, please <a href='/chatapp/register.php'>register</a></p>";
                }
?>      
    </body>
</html>
