<?php
    
    session_start();

    require('connect.php');
    
     // SQL is written as a String.
     $query = "SELECT * FROM blog WHERE postid = :id LIMIT 1";

     // A PDO::Statement is prepared from the query.
     $statement = $db->prepare($query);

     $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

     // Execution on the DB server is delayed until we execute().
      $statement->bindValue('id', $id, PDO::PARAM_INT);
      $statement->execute(); 

     // Fetch the row selected by primary key id.
     $row = $statement->fetch();

     // SQL is written as a String.
     $query2 = "SELECT * FROM comments WHERE postid = {$_GET['id']}";
     

     // A PDO::Statement is prepared from the query.
     $statement2 = $db->prepare($query2);


      $statement2->execute(); 

     // Fetch the row selected by primary key id.


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>News</title>
    <link rel="stylesheet" type="text/css" href="shotokanstyles.css" />
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <header>
        <h1>Shotokan Karate</h1>
    </header>
    <?php if(isset($_SESSION['login'])): ?>
            <nav>
        <ul>
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
            <h1><a href="index.php">News</a></h1>
        </div>
    <?php if($_SESSION['userlevel'] > 1): ?>
<ul id="menu">
    <li><a href="news.php?categoryid=4" >Back</a></li>
    <li><a href="create.php" >New Post</a></li>
</ul> <!-- END div id="menu" -->
  <div id="all_blogs">
    <div class="blog_post">
      <h2><?= $row['Title'] ?></h2>
      <p><small><?= $row['Time'] . " - " ?><a href="edit.php?id=<?= $row['postid'] ?>">edit</a> </small></p>
      <div class='blog_content'>
    <?= $row['Content'] ?>    
            </div>
            </div>
          </div>
<?php while($row2 = $statement2->fetch()): ?>
          <div id="all_blogs">
    <div class="blog_post">
      <p><small><?= $row2['username'] . " - " . $row2['time'] . " - " ?><a href="deleteComment.php?id=<?= $row2['postid'] ?>">delete</a> </small></p>
      <div class='blog_content'>
    <?= $row2['comment'] ?>    
            </div>
            </div>
          </div>
<?php endwhile ?>
    <?php else: ?> 
    <ul id="menu">
    <li><a href="news.php?categoryid=4" >Back</a></li>
</ul> <!-- END div id="menu" -->
  <div id="all_blogs">
    <div class="blog_post">
      <h2><?= $row['Title'] ?></h2>
      <p><small><?= $row['Time'] ?></small></p>
      <div class='blog_content'>
    <p><?= $row['Content'] ?> </p>
            </div>
            </div>
          </div>
<?php while($row2 = $statement2->fetch()): ?>
          <div id="all_blogs">
    <div class="blog_post">
      <p><small><?= $row2['username'] . " - " . $row2['time']?></small></p>
      <div class='blog_content'>
    <p><?= $row2['comment'] ?></p> 
            </div>
            </div>
          </div>
<?php endwhile ?>
<?php endif ?>
<br>
<footer>
    <div id="links2">
        <a href="index.php" class = "links2"> Home | </a>
        <a href="news.php?categoryid=4" class = "links2">News | </a>
        <a href="contact.html" class = "links2">Contact  </a>
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