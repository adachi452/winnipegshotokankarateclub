<?php

    session_start();

    require('connect.php');
    
     // SQL is written as a String.
     $query = "SELECT * FROM users ORDER BY userlevel DESC";

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
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            <li><a href = "logout.php">Logout</a></li>
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
            <li><a href = "logout.php">Logout</a></li>
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

    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">User Accounts</a></h1>
        </div>

    <ul id="menu">
    <li><a href="admin.php" class='active'>Back</a></li>
    <li><a href="createusers.php" >New User</a></li>
</ul>  
<div id="all_blogs">
    <div class="blog_post">
    <?php if($statement->rowCount() == 0): ?>
        <h1>No users found.</h1>
    <?php else: ?>    
    
        <?php while($row = $statement->fetch()): ?>
            
            <div class="blog_post">
                <h2><small><?= "Username: " . $row['username'] . " (" . $row['userlevel']. ") "?><a href="editusers.php?id=<?= $row['userid'] ?>">edit</a> </small></h2>
                
            <div class='blog_content'>
            </div>
            </div>
        <?php endwhile ?>
    
    <?php endif ?>
</div>
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