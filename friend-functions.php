<?php
function addfriend($email, $addfriendemail, $mysqli) {

	if ($stmt = $mysqli->prepare("SELECT Email FROM userdetails WHERE email = ?")) {
		$stmt->bind_param('s', $addfriendemail);  
        $stmt->execute();    
        $stmt->store_result();
 
        $stmt->bind_result($user_email);
        $stmt->fetch();
        
        if ($stmt->num_rows == 1) {
        	$stmt->close();
        	if ($user_email == $email) {
        		 echo '<script language="javascript">';
					echo 'alert ( "You cannot be your own friend mate." ); ';
					echo '</script>';
        		return false;
        	}

        	if (fetchfriends($email, $mysqli, $addfriendemail)) {
        		echo "You are already friends with ".$addfriendemail.". <br>";
        		return false;
        	}

        	$stmt = $mysqli->prepare("INSERT INTO friendship (friendoneemail, friendtwoemail) VALUES (?, ?)");
        	$stmt->bind_param("ss", $email, $addfriendemail);
            $stmt->execute();
            $stmt->close();
            return true;

        } else {
        	 echo '<script language="javascript">';
					echo 'alert ( "Entered user does not use E-Shaz chat!" ); ';
					echo '</script>';
			
        	return false;
        }
	}
}

function fetchfriends($email, $mysqli, $currfriendemail) {
	$prep_stmt = "SELECT f.friendtwoemail, u.firstname, u.lastname FROM friendship f INNER JOIN userdetails u ON f.FriendTwoEmail = u.Email WHERE f.friendoneemail = ?";
	$stmt = $mysqli->prepare($prep_stmt);

	if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($friend_email, $friend_firstname, $friend_lastname);

        while ($stmt->fetch()) {
        	if ($currfriendemail == $friend_email) {
        		return false;
        	}

        	echo $friend_firstname." ".$friend_lastname.", ".$friend_email."<br>";
        }
    } 
    $stmt->close();

    $prep_stmt = "SELECT f.friendoneemail, u.firstname, u.lastname FROM friendship f INNER JOIN userdetails u ON f.FriendOneEmail = u.Email WHERE f.friendtwoemail = ?";
	$stmt = $mysqli->prepare($prep_stmt);

	if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($friend_email, $friend_firstname, $friend_lastname);

        while ($stmt->fetch()) {
        	if ($currfriendemail == $friend_email) {
        		
        		return false;
        	}
        	echo $friend_firstname." ".$friend_lastname.", ".$friend_email."<br>";
        }
       	$stmt->close();
    }
}

function isfriendswith($email, $mysqli, $currfriendemail) {
    $prep_stmt = "SELECT f.friendtwoemail, u.firstname, u.lastname FROM friendship f INNER JOIN userdetails u ON f.FriendTwoEmail = u.Email WHERE f.friendoneemail = ?";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($friend_email, $friend_firstname, $friend_lastname);

        while ($stmt->fetch()) {
            if ($currfriendemail == $friend_email) {
                return true;
            }
        }
    } 
    $stmt->close();

    $prep_stmt = "SELECT f.friendoneemail, u.firstname, u.lastname FROM friendship f INNER JOIN userdetails u ON f.FriendOneEmail = u.Email WHERE f.friendtwoemail = ?";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($friend_email, $friend_firstname, $friend_lastname);

        while ($stmt->fetch()) {
            if ($currfriendemail == $friend_email) {
                
                return true;
            }
            echo $friend_firstname." ".$friend_lastname.", ".$friend_email."<br>";
        }
        $stmt->close();
    }
    return false;
}


?>
