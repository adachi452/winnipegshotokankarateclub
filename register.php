<?php

	session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
	<script src="formValidate.js"></script>
</head>
<body>

	<header>
		<h1>Shotokan Karate</h1>
	</header>

	
	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Login</a></li>
		</ul>
	</nav>


	<form id="orderform" action="insert.php" method="post">

		  <fieldset id="contact">
				<div class="left">
					<a id ="customerinfo"><h3>Register</h3></a>
					<ul>						
						<li>
							<label for="email">Email</label>
							<input id="email" name="email" type="text" />
							<p class="shippingError error" id="email_error">* Required field</p>
							<p class="shippingError error" id="emailformat_error">* Invalid email address</p>
						</li>
						<li>
							<label for="username">Username</label>
							<input id="username" name="username" type="text" />
							<p class="shippingError error" id="username_error">* Required field</p>
						</li>
						<li>
							<label for="password">Password</label>
							<input id="password" name="password" type="password" />
							<p class="shippingError error" id="password_error">* Required field</p>
						</li>
						<li>
							<label for="repassword">Re-Enter Password</label>
							<input id="repassword" name="repassword" type="password" />
							<p class="shippingError error" id="repassword_error">* Required field</p>
						</li>
						
					
					</ul>
				</div>
			</fieldset>
			<div class="clear"></div>
				<p class="center">
					<input type="submit" name="command" value='Submit' />
					<button type="reset" id="clear">Clear Form</button>
				</p>
		</form>

		<footer>
	<div id="links2">
		<a href="index.html" class = "links2"> Home | </a>
		<a href="news.php?categoryid=4" class = "links2">News | </a>
		<a href="instructors.php" class = "links2">Instructors </a>
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