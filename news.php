<?php
	session_start();

    require('connect.php');

    $format = 'F d, Y, g:i a';  

    $query2 = "SELECT * FROM categories";

        // A PDO::Statement is prepared from the query.
        $statement2 = $db->prepare($query2);

        // Execution on the DB server is delayed until we execute().
        $statement2->execute(); 

    $query3 = "SELECT * FROM comments";

        // A PDO::Statement is prepared from the query.
        $statement3 = $db->prepare($query3);

        // Execution on the DB server is delayed until we execute().
        $statement3->execute();        
        	
        $row3 = $statement3->fetch();    	




if ($_GET['categoryid'] == 1) 
    {
    	$query = "SELECT * FROM blog WHERE categoryid =:categoryid ORDER BY Time DESC LIMIT 5";

        // A PDO::Statement is prepared from the query.
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryid', $_GET['categoryid']);

        // Execution on the DB server is delayed until we execute().
        $statement->execute(); 
    }
    elseif ($_GET['categoryid'] == 2) 
    {
        $query = "SELECT * FROM blog WHERE categoryid =:categoryid ORDER BY Time DESC LIMIT 5";

        $statement = $db->prepare($query);
        $statement->bindValue(':categoryid', $_GET['categoryid']);

        $statement->execute();
    }
    elseif ($_GET['categoryid'] == 3) 
    {
        $query = "SELECT * FROM blog WHERE categoryid =:categoryid ORDER BY Time DESC LIMIT 5";

        $statement = $db->prepare($query);
        $statement->bindValue(':categoryid', $_GET['categoryid']);

        $statement->execute();
    }
    elseif ($_GET['categoryid'] == 4)
    {
  	 // SQL is written as a String.
     $query = "SELECT * FROM blog ORDER BY Time DESC LIMIT 5";

     // A PDO::Statement is prepared from the query.
     $statement = $db->prepare($query);

     // Execution on the DB server is delayed until we execute().
     $statement->execute(); 
    }
    else
    {
        return false;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>News</title>
	<link rel="stylesheet" type="text/css" href="shotokanstyles.css" />

</head>
<body>

	<header>
		<h1>Shotokan Karate</h1>
	</header>

	<!-- USER LEVEL IS 2 -->

	<?php if(isset($_SESSION['login']) && $_SESSION['userlevel'] == 2): ?>
    <nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "logout.php">Logout</a></li>
		</ul>
	</nav>

	<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>

	<div id="wrapper">
        <div id="header">
            <h3>Weekley News</h3>
        </div>
    </div>

    <fieldset>

	<nav id = "categories">
		<ul>
	<?php while($row = $statement2->fetch()): ?>
			<li><a href = <?= "news.php?categoryid=" . $row['categoryid'] ?> ><?= $row['categoryname']?></a></li>
	<?php endwhile ?>
			<li><a href="addcategory.php">New Category</a></li>
		</ul>
	</nav>

	<ul id="menu">
    	<li><a href="create.php" >New Post</a></li>
	</ul>  

<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No posts found.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
            
            <div class="blog_post">
                <h2><a href="show.php?id=<?= $row['postid'] ?>"><?= $row['Title'] ?></a></h2>
                <p><small><?= $date = date($format, strtotime($row['Time'])) . " - " ?><a href="edit.php?id=<?= $row['postid'] ?>">edit</a> <?= " - "?><a href="comment.php?id=<?= $row['postid'] ?>">comment</a></small></p>
            <div class='blog_content'>
                <?php if (strlen($row['Content']) > 200) : ?>
                    <?=$row['Content'] = substr($row['Content'], 0, 200) . "..."?> <a href="show.php?id=<?= $row['postid'] ?>">Read More</a>

                <?php else: ?> 
                    <?=$row['Content']?>             

            <?php endif ?>
            </div>
            </div>
        <?php endwhile ?>
    
    <?php endif ?>
</div>
</div>
</div>

</fieldset>
	
	<!-- USER LEVEL IS 3 -->

	<?php elseif (isset($_SESSION['login']) && $_SESSION['userlevel'] == 3) : ?>  
	<nav>
		<ul>
			<li><a href = "admin.php">Admin</a></li>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "logout.php">Logout</a></li>
		</ul>
	</nav> 	 
		<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>

		<div id="wrapper">
        <div id="header">
            <h3><a href="news.php">Weekley News</a></h3>
        </div>
    </div>

    <fieldset>

	<nav id = "categories">
		<ul>
	<?php while($row = $statement2->fetch()): ?>
			<li><a href = <?= "news.php?categoryid=" . $row['categoryid'] ?> ><?= $row['categoryname']?></a></li>
	<?php endwhile ?>
			<li><a href="addcategory.php">New Category</a></li>
		</ul>
	</nav>

	<ul id="menu">
    	<li><a href="create.php" >New Post</a></li>
	</ul>  

<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No posts found.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
            
            <div class="blog_post">
                <h2><a href="show.php?id=<?= $row['postid'] ?>"><?= $row['Title'] ?></a></h2>
                <p><small><?= $date = date($format, strtotime($row['Time'])) . " - " ?><a href="edit.php?id=<?= $row['postid'] ?>">edit</a> <?= " - "?><a href="comment.php?id=<?= $row['postid'] ?>">comment</a></small></p>
            <div class='blog_content'>
                <?php if (strlen($row['Content']) > 200) : ?>
                    <?=$row['Content'] = substr($row['Content'], 0, 200) . "..."?> <a href="show.php?id=<?= $row['postid'] ?>">Read More</a>
                <?php else: ?> 
                    <?=$row['Content']?>
            <?php endif ?>
            </div>
            </div>
        <?php endwhile ?>
    
    <?php endif ?>

</div>
</div>
</div>

</fieldset>   

	<!-- USER LEVEL IS 1 -->

	<?php else: ?>

	<nav>
		<ul>
			<li><a href = "index.php">Home Page</a></li>
			<li><a href = "news.php?categoryid=4">News</a></li>
			<li><a href = "instructors.php">Instructors</a></li>
			<li><a href = "logout.php">Logout</a></li>
		</ul>
	</nav>

	<h2>Welcome, <?= $_SESSION['login'] . "!"?></h2>

	<div id="wrapper">
        <div id="header">
            <h3>Weekley News</h3>
        </div>
    </div>

    <fieldset>

	<nav id = "categories">
		<ul>
	<?php while($row = $statement2->fetch()): ?>
			<li><a href = <?= "news.php?categoryid=" . $row['categoryid'] ?> ><?= $row['categoryname']?></a></li>
	<?php endwhile ?>
		</ul>
	</nav>

	<ul id="menu">
    	<li><a href="create.php" >New Post</a></li>
	</ul>  

<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No posts found.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
             
            <div class="blog_post">
                <h2><a href="show.php?id=<?= $row['postid'] ?>"><?= $row['Title'] ?></a></h2>
                <p><small><?= $date = date($format, strtotime($row['Time'])) . " - " ?></a><a href="comment.php?id=<?= $row['postid'] ?>">comment</a></small></p>
            <div class='blog_content'>
                <?php if (strlen($row['Content']) > 200) : ?>
                    <?=$row['Content'] = substr($row['Content'], 0, 200) . "..."?> <a href="show.php?id=<?= $row['postid'] ?>">Read More</a>

                <?php else: ?> 
                    <?=$row['Content']?>       

            <?php endif ?>
            </div>
            </div>
        <?php endwhile ?>

    <?php endif ?>
    <?php endif ?>
</div>
</div>
</div>

</fieldset>



<br>
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