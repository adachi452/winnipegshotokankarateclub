<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <title>New User</title>
    <link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">New User</a></h1>
        </div> 
<ul id="menu">
    <li><a href="admin.php" >Home</a></li>
    <li><a href="create.php" class='active'>New User</a></li>
</ul> 
<div id="all_blogs">
  <form action="insert.php" method="post">
    <fieldset>
      <legend>Create New User</legend>
      <p>
        <label for="username">Username</label>
        <input name="username" id="username" type="text" required="text" />
      </p>
      <p>
        <label for="password">Password</label>
        <input name="password" id="password" type="password" required="text" />
      </p>
      <p>
        <label for="repassword">Re-Type Password</label>
        <input name="repassword" id="repassword" type="password" required="text" />
      </p>
      <p>
        <label for="email">Email</label>
        <input name="email" id="email" type="text" required="text"/>
      </p>
      <p>
        <label for="userlevel">User Level</label>
        <input name="userlevel" id="userlevel" type="text" required="text"/>
      </p>   
      <p>
        <input type="submit" name="command" value='Create User' />
      </p>
    </fieldset>
  </form>
</div>
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