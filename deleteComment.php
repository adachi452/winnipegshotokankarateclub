<?php

      session_start();

      require('connect.php');
        
    
    // SQL is written as a String.
     $query = "SELECT * FROM comments WHERE postid = :id LIMIT 1";

     // A PDO::Statement is prepared from the query.
     $statement = $db->prepare($query);

     $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

     // Execution on the DB server is delayed until we execute().
      $statement->bindValue('id', $id, PDO::PARAM_INT);
      $statement->execute(); 

     // Fetch the row selected by primary key id.
     $row = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit</title>
    <link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
  <header>
    <h1>Shotokan Karate</h1>
  </header>
  <?php if(isset($_SESSION['login']) && $_SESSION['userlevel'] <= 2): ?>
          <nav>
    <ul>
      <li><a href = "index.php">Home Page</a></li>
      <li><a href = "news.php">News</a></li>
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
      <li><a href = "news.php">News</a></li>
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
  <?= $statement->rowCount() ?>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Edit Comment</a></h1>
        </div> 
<ul id="menu">
    <li><a href="news.php?categoryid=4" >Back</a></li>
</ul> <!-- END div id="menu" -->
  <div id="all_blogs">
    <form action="insert.php" method="post">
    <fieldset>
      <legend>Edit Comment</legend>
      <p>
        <label for="content">Comment</label>
        <textarea name="content" id="content" type="text" required="text" /><?= $row['comment'] ?></textarea>
      </p>   
      <p>
        <input type="hidden" name="id" value="<?= $row['postid'] ?>" />
        <input type="submit" name="command" value='Delete Comment' onclick="return confirm('Are you sure you wish to delete this post?')" />
      </p>
    </fieldset>
  </form>
    </div>
    <br>
  <footer>
    <div id="links2">
        <a href="index.php" class = "links2"> Home | </a>
        <a href="news.php" class = "links2">News | </a>
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