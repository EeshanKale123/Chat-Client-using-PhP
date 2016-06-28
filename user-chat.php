
<div id="chatArea" style="background-color:lightblue">
<?php
	include_once 'db_connect.php';
	include_once 'friend-functions.php';

	

	$email = $_COOKIE["email"];

	if (isset($_POST['addfriendemail'])) {    
	    $friendemail = $_POST['addfriendemail'];
	    
	    if (addfriend($email, $friendemail, $mysqli) == true) {

	        echo "<br><br>Add Friend Success. Your new friend is: ".$friendemail."<br>";
	    } else {

	         echo '<script language="javascript">';
					echo 'alert ( "Add Friend Failed." ); ';
					echo '</script>';
	    }
	}

	if (isset($_POST['addchatfriendemail'])) {
		$chatfriendemail = $_POST['addchatfriendemail'];
		if(isfriendswith($email, $mysqli, $chatfriendemail) == true) {
			setcookie('chatfriendemail', $chatfriendemail, false, '/');
			header('Location: /chatapp/chat.php');
		}
	}

	echo "<br>Welcome, ".$_COOKIE["username"]."<br><br>";
	
	echo "Your friends are: <br>";
	echo '<div id="ScrollStyle">';
	fetchfriends($email, $mysqli, "");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-Shaz Chat</title>
         <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body id>
	
    	<br><br><br><br>
		        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" name="add_friend_form">                      
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Friend's Email Address: <input type="text" name="addfriendemail" />
            
            <input type="submit" 
                   value="Add Friend" /> 
        </form>

        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" name="chat_friend_form">                      
            Friend's Email Address to chat with: <input type="text" name="addchatfriendemail" />
            
            <input type="submit" 
                   value="Chat Friend" /> 
        </form>
 

 		<p><a href='/chatapp/logout-function.php'>Log out</a></p>
		
    </body>
</html>
