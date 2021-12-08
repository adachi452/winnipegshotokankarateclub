<?php

    session_start();

    require('connect.php');

    $query2 = "SELECT * FROM categories";

        // A PDO::Statement is prepared from the query.
        $statement2 = $db->prepare($query2);

        // Execution on the DB server is delayed until we execute().
        $statement2->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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
            <h1><a href="index.php">New Post</a></h1>
        </div> 
<ul id="menu">
    <li><a href="news.php" >Home</a></li>
    <li><a href="create.php" class='active'>New Post</a></li>
</ul> 
<div id="all_blogs">
  <form action="insert.php" method="post">
    <fieldset>
      <legend>New Post</legend>

      <label for="categories">Choose a Category:</label>

    <select name="categories" id="categories">
        <?php while($row = $statement2->fetch()): ?>    
            <option value=<?= $row['categoryid'] ?>><?= $row['categoryname']?></option>
        <?php endwhile ?>
    </select>
      <p>
        <label for="Title">Title</label>
        <input name="Title" id="Title" type="text" required/>
      </p>
      <p>
        <label for="Content">Content</label>
        <textarea name="Content" id="Content" required></textarea>
      </p>
      <p>
        <input type="submit" name="command" value='Create' />
      </p>
    </fieldset>
  </form>
</div><br>

<script>CKEDITOR.replace('Content');</script>

<footer>
    <div id="links2">
        <a href="index.php" class = "links2"> Home | </a>
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
    </div> 
</body>
</html>