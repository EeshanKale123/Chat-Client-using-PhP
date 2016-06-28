<?php
include_once 'db_connect.php';
 
$error_msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['confirmpwd'])) {
        
        $password = $_POST['password'];
        $confirmpwd = $_POST['confirmpwd'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        if ($password != "" && $confirmpwd != "" && $email != "" && $firstname != "" && $lastname != "") {

            if($password != $confirmpwd) {
                $error_msg .= '<p class="error">Passwords do not match.</p>';
            }   
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_msg .= '<p class="error">Not a correct email address.</p>';
            }
         
            $prep_stmt = "SELECT email FROM userdetails WHERE email = ? LIMIT 1";
            $stmt = $mysqli->prepare($prep_stmt);
         
            if ($stmt) {
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();
         
                if ($stmt->num_rows == 1) {
                    $error_msg .= '<p class="error">A user with this email address already exists.</p>';
                    $stmt->close();
                }
                $stmt->close();
            } 

            if (empty($error_msg)) {
                $stmt = $mysqli->prepare("INSERT INTO userdetails(email, password, firstname, lastname) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $email, $password, $firstname, $lastname);
                $stmt->execute();
                $stmt->close();
                 echo '<script language="javascript">';
					echo 'alert ( "New record created successfully." ); ';
					echo '</script>';
            }

        } else {
            $error_msg .= '<p class="error">All fields are mandatory.</p>';
        }
    }
}
