<?php

	session_start();

	 require('connect.php');

     // SQL is written as a String.
     $query = "SELECT * FROM instructors ORDER BY instructorid ASC";

     // A PDO::Statement is prepared from the query.
     $statement = $db->prepare($query);

     // Execution on the DB server is delayed until we execute().
     $statement->execute(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Instructors</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
</head>
<body>

	<header>
		<h1>Shotokan Karate</h1>
	</header>
	<?php if(isset($_SESSION['login']) && $_SESSION['userlevel'] == 2): ?>
        	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4&p=recent-posts">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Logout</a></li>
		</ul>
	</nav>
	<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>

	<p align="center"
	<br>
		<a href="addInstructor.php" >Add Instructor</a>
	</p>

	<fieldset>
 
<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No instructors listed.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
            
            <div class="blog_post" >
            	<img src=<?="uploads/" . $row['picture'] ?>>
                <h2>Name: <?= $row['fullname'] ?><small><?= " - " ?><a href="editInstructors.php?id=<?= $row['instructorid'] ?>">edit</a> </small></h2> 
                <h2>Rank: <?= $row['rank'] ?></h2>
                <h2>Mentor: <?= $row['mentor'] ?></h2>
                <h2>Karate Experience: <?= $row['karateexperience'] ?></h2>               
            
            </div>
            </div>
        <?php endwhile ?>
    
    <?php endif ?>
</div>
</div>

</fieldset><br>

	<?php elseif (isset($_SESSION['login']) && $_SESSION['userlevel'] == 3) : ?>  
	        	<nav>
		<ul>
			<li><a href = "admin.php">Admin</a></li>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4&p=recent-posts">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Logout</a></li>
		</ul>
	</nav>  
		<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>
		<p align="center"
	<br>
		<a href="addInstructor.php" >Add Instructor</a>
	</p>

	<fieldset>
 
<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No instructors listed.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
            
            <div class="blog_post" >
            	<img src=<?="uploads/" . $row['picture'] ?>>
                <h2>Name: <?= $row['fullname'] ?><small><?= " - " ?><a href="editInstructors.php?id=<?= $row['instructorid'] ?>">edit</a> </small></h2> 
                <h2>Rank: <?= $row['rank'] ?></h2>
                <h2>Mentor: <?= $row['mentor'] ?></h2>
                <h2>Karate Experience: <?= $row['karateexperience'] ?></h2>               
            
            </div>
            </div>
        <?php endwhile ?>
    
    <?php endif ?>
</div>
</div>

</fieldset><br>

<?php elseif (isset($_SESSION['login']) && $_SESSION['userlevel'] == 1) : ?>  
	        	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4&p=recent-posts">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Logout</a></li>
		</ul>
	</nav>  
		<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>

	<fieldset>
 
<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No instructors listed.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
            
            <div class="blog_post" >
            	<img src=<?="uploads/" . $row['picture'] ?> alt="Instructor">
                <h2>Name: <?= $row['fullname'] ?></h2> 
                <h2>Rank: <?= $row['rank'] ?></h2>
                <h2>Mentor: <?= $row['mentor'] ?></h2>
                <h2>Karate Experience: <?= $row['karateexperience'] ?></h2>               
            
            </div>
            </div>
        <?php endwhile ?>
    
    <?php endif ?>

</fieldset><br>

<?php else: ?> 
	     	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "login.php">Login</a></li>
		</ul>
	</nav>

	<fieldset>
 
<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No instructors listed.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
            
            <div class="blog_post" >
            	<img src=<?="uploads/" . $row['picture'] ?>>
                <h2>Name: <?= $row['fullname'] ?></h2> 
                <h2>Rank: <?= $row['rank'] ?></h2>
                <h2>Mentor: <?= $row['mentor'] ?></h2>
                <h2>Karate Experience: <?= $row['karateexperience'] ?></h2>               
            
            </div>
            </div>
        <?php endwhile ?>
    
    <?php endif ?>
</div>
</div>

</fieldset><br>

	<?php endif ?>	

	<footer>
	<div id="links2">
		<a href="index.html" class = "links2"> Home | </a>
		<li><a href = "news.php?categoryid=4&p=recent-posts" class = "links2">News | </a>
		<a href="instructors.php" class = "links2">Instructors </a>
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