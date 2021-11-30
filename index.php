<?php

	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Home Page</title>
	<link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
</head>
<body>

	<header>
		<h1>Shotokan Karate</h1>
	</header>
	<?php if(isset($_SESSION['login']) && $_SESSION['userlevel'] <= 2): ?>
        	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Logout</a></li>
		</ul>
	</nav>
	<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>

	<?php elseif (isset($_SESSION['login']) && $_SESSION['userlevel'] = 3) : ?>  
	        	<nav>
		<ul>
			<li><a href = "admin.php">Admin</a></li>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Logout</a></li>
		</ul>
	</nav>  
		<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>

    <?php else: ?>    
	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Login</a></li>
		</ul>
	</nav>
	<?php endif ?>


	<h4><img src = "images/Shotokan_logo.png" alt = "Logo" /></h4>

<h2>
	Welcome to a page about <span class = "bold">Shotokan Karate</span>. <br> 
	Below you will find links on Shotokan Karate's history, belt ranking system, as well as a local dojo to sign up for classes. <br>
	If you have anymore question, please contact me by <a href = "mailto:ahildebrand36@rrc.ca">E-mail</a> for more information.

</h2>


<h3>Karate Links:</h3>
<ul>
	<li><a href = "https://en.wikipedia.org/wiki/Shotokan">What is Shotokan Karate</a></li>
	<li><a href = "http://www.karatewinnipeg.ca/">Winnipeg Shotokan Dojo</a></li>
	<li><a href = "https://blackbeltwiki.com/shotokan-belt-levels-systems">Belt Ranks</a></li>
</ul>

<h3><img src="images/belts.jpg" alt = "beltstyles"></h3>



<div id= "dojokun">
<h3><span class = "bold">Dojo-kun</span><br>
	<img src="images/dojokun.jpg" alt = "dojo_kun"></h3>

<ol>
	<li>Seek perfection of character
	<li>Be faithful
	<li>Endevour to excel
	<li>Respect others 
	<li>Refrain from violent behavior
</ol>
</div>

<footer>
	<div id="links2">
		<a href="index.html" class = "links2"> Home | </a>
		<a href="products.html" class = "links2">Products | </a>
		<a href="index.html" class = "links2">Contact  </a>
	</div>	
	<div id="line2">
		<p class = "line2"> Copyright © 2021 <a href="https://iskf.com/club-directory/pan-america/canada/" class="link3"> International Shotokan Karate Federation</a> </p>
	</div>	
	<div id="line3">
		<p class = "line3"> Monica's Danz Gym Unit #4-25 Scurfield Blvd, Winnipeg, Manitoba, Canada </p>
	</div>	
</footer>

</body>
</html>