<?php

function login($email, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT Email, FirstName, LastName, Password FROM userdetails WHERE email = ?")) {
        
        $stmt->bind_param('s', $email);  
        $stmt->execute();    
        $stmt->store_result();
 
        $stmt->bind_result($user_email, $firstname, $lastname, $db_password);
        $stmt->fetch();
        
        if ($stmt->num_rows == 1) {
            
            if ($db_password == $password) {
                
                setcookie('username', $firstname, false, '/');
                setcookie('email', $_POST['email'], false, '/');

                return true;
            } else {
                return false;
            }
        }
        else {
            // No user exists.
            return false;
        }
        $stmt->close();
    } else {
        echo "Not Working";
    }
}

function login_check() {
    if(isset($_COOKIE['username']) && isset($_COOKIE['email'])) {
        return true;
    } else {
        return false;
    }
}

?>
