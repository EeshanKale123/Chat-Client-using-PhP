<?php
function sendmessage($myemail, $friendemail, $message, $mysqli) {
	$stmt = $mysqli->prepare("INSERT INTO chat(sendbyemail, sendtoemail, timesent, message) VALUES (?, ?, ?, ?)");
	$timestamp = date('Y-m-d G:i:s');
	$stmt->bind_param("ssss", $myemail, $friendemail, $timestamp, $message);
    $stmt->execute();
    $stmt->close();
}

function fetchmessages($myemail, $friendemail, $mysqli) {
	if ($stmt = $mysqli->prepare("SELECT u1.firstname, u1.lastname, c1.sendbyemail, c1.message, c1.timesent FROM chat c1 INNER JOIN userdetails u1 ON u1.email = c1.SendByEmail WHERE c1.sendbyemail = ? AND c1.sendtoemail = ? UNION SELECT u2.firstname, u2.lastname, c2.sendbyemail, c2.message, c2.timesent FROM chat c2 INNER JOIN userdetails u2 ON u2.email = c2.SendByEmail WHERE c2.sendtoemail = ? AND c2.sendbyemail = ? ORDER BY timesent")) {
		$stmt->bind_param('ssss', $myemail, $friendemail, $myemail, $friendemail);
        $stmt->execute();
        $stmt->bind_result($firstname, $lastname, $sendbyemail, $message, $timesent);

        while ($stmt->fetch()) {
        	?> <h4> <?php echo $firstname." ".$lastname.": ".$timesent." - ".$message."<br>"; ?> </h4> <?php
        }
	}

}

?>
