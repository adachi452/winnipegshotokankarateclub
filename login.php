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
	<title>Login</title>
	<link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
	<script src="formValidate.js"></script>
</head>
<body>

	<header>
		<h1>Shotokan Karate</h1>
	</header>
<?php if(isset($_SESSION['login'])): ?>
        	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Login</a></li>
		</ul>
	</nav>
    <?php else: ?>    
	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Login</a></li>
		</ul>
	</nav>
	<?php endif ?>

	<form id="orderform" 
		action="insert.php" 
		  method="post">

		  <fieldset id="contact">
				<div class="left">
					<a id ="customerinfo"><h3>Login</h3></a>
					<ul>
						<li>
							<label for="username">Username</label>
							<input id="username" name="username" type="text" />
							<p class="error" id="username_error">* Required field</p>
						</li>
						<li>
							<label for="password">Password</label>
							<input id="password" name="password" type="password" />
							<p class="error" id="password_error">* Required field</p>
						</li>
					
					</ul>
				</div>
			</fieldset>
			<div class="clear"></div>
				<p class="center">
					<input type="submit" name="command" value='Login' />
					<button type="reset" id="clear">Clear Form</button>
					<a href="register.php" class = "links2"> Click here to register...</a>
				</p>
		</form>

		<footer>
	<div id="links2">
		<a href="index.html" class = "links2"> Home | </a>
		<a href="news.php?categoryid=0" class = "links2">News | </a>
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