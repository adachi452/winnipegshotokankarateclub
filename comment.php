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



?>


<!DOCTYPE html>
<html lang="en">
<head> 
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Comment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script type="text/javascript">


 var refreshButton = document.querySelector(".refresh-captcha");
refreshButton.onclick = function() {
  document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();

</script>
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
    <li><a href="news.php?categoryid=4" >Home</a></li>
    <li><a href="create.php" class='active'>New Post</a></li>
</ul> 
<div id="all_blogs">
  <form action="insert.php" method="post">
    <fieldset>
      <legend>Replying to...</legend>
      <p><?= $row['Title'] ?></p>
      <p><?= $row['Content'] ?></p>
      <input type="hidden" name="id" value="<?= $row['postid'] ?>" />
      <p>
        <label for="comment">Comment</label>
        <textarea name="comment" id="comment" type="text" required="text" /></textarea>
      </p>
      <input type="hidden" name="username" value="<?= $_SESSION['login'] ?>" />
      <input type="hidden" name="userid" value="<?= $_SESSION['userid'] ?>" />
      <input type="hidden" name="captcha" value="<?= $_SESSION['captcha_text'] ?>" />

<div class="elem-group">
    <label for="captcha">Please Enter the Captcha Text</label>
    <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" pattern="[A-Z]{6}">
</div>

      <p>
        <input type="submit" name="command" value='Comment' />
      </p>

    </fieldset>
  </form>
</div><br>

<script>CKEDITOR.replace('comment');</script>


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