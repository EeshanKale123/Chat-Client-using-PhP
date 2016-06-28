<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include_once 'db_connect.php';
include_once 'chat-functions.php';

if(isset($_COOKIE['email']) && isset($_COOKIE['chatfriendemail'])){
	$myid = $_COOKIE['email'];
	$fid = $_COOKIE['chatfriendemail'];
}

if(isset($_POST['msg'])) {
	$message = $_POST['msg'];
	sendmessage($myid, $fid, $message, $mysqli);
}
echo "<br>".$_COOKIE["username"]."'s chat,<br><br>";
?>

<title>Chat</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
        <div id="content" class = "ScrollStyle"></div>
<script>
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            document.getElementById('content').innerHTML = ajax.responseText;
        }
    }
    function updateText() {
        ajax.open('GET', 'ajax.php');
        ajax.send();
    }

    setInterval(function(){
        updateText();
    }, 1000);

</script>

	<br><br>
	<div class="container">
      <div class="chat" id="chat">
        <div class="stream" id="cstream">

      </div>
      </div>
      <div class="msg">
          <form method="post" id="msenger" action="">
		  
            <textarea name="msg" id="msg-min" cols="50"></textarea>
            <input type="hidden" name="mid" value="<?php echo $myid;?>">
            <input type="hidden" name="fid" value="<?php echo $fid;?>">
            <input type="submit" value="Send">
          </form>
		  
      </div>
      <div id="dataHelper" last-id=""></div>
	  <p><a href='/chatapp/logout-function.php'>Log out</a></p>
  </div>

</body>
</html>
