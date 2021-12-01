<?php
	session_start();
	
	if(isset($_SESSION['login'])){
		session_destroy();
	}else{
		$_SESSION['login'] = [];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Logout</title>
	<link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
	<script src="formValidate.js"></script>
</head>
<body>

	<header>
		<h1>Shotokan Karate</h1>
	</header>

	<h6><p>You have been logged out!</p></h6>

	<h6><a href="login.php" class = "links9"> Login </a></h6>
	<h6><a href="index.php" class = "links9"> Home </a></h6>

		<footer>
	<div id="links2">
		<a href="index.html" class = "links2"> Home | </a>
		<a href="news.php" class = "links2">News | </a>
		<a href="contact.html" class = "links2">Contact  </a>
	</div>	
	<div id="line2">
		<p class = "line2"> Copyright © 2021 <a href="https://iskf.com/club-directory/pan-america/canada/" class="link3"> International Shotokan Karate Federation</a> </p>
	</div>	
	<div id="line3">
		<p class = "line3"> Monica's Danz Gym Unit #4-25 Scurfield Blvd, Winnipeg, Manitoba, Canada</p>
	</div>	
</footer>
	</body>
</html>