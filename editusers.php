 <?php

    session_start();

        require('connect.php');
    
    // SQL is written as a String.
     $query = "SELECT * FROM users WHERE userid = :id LIMIT 1";

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
    <title>Edit Users - Edit</title>
    <link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
  <?= $statement->rowCount() ?>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Edit Users</a></h1>
        </div> 
<ul id="menu">
    <li><a href="admin.php" >Back</a></li>
    <li><a href="create.php" >New User</a></li>
</ul> <!-- END div id="menu" -->
  <div id="all_blogs">
    <form action="insert.php" method="post">
    <fieldset>
      <legend>Selected User</legend>
      <p>
        <label for="username">Username</label>
        <input name="username" id="username" type="text" required="text" value="<?= $row['username'] ?>" />
      </p>
      <p>
        <label for="password">Password</label>
        <input name="password" id="password" type="password" required="text" value="<?= $row['password'] ?>" />
      </p>
      <p>
        <label for="email">Email</label>
        <input name="email" id="email" type="text" required="text" value="<?= $row['email'] ?>" />
      </p>
      <p>
        <label for="userlevel">User Level</label>
        <input name="userlevel" id="userlevel" type="text" required="text" value="<?= $row['userlevel'] ?>" />
      </p>         
      <p>
        <input type="hidden" name="id" value="<?= $row['userid'] ?>" />
        <input type="submit" name="command" value='Update User' />
        <input type="submit" name="command" value='Delete User' onclick="return confirm('Are you sure you wish to delete this user?')" />
      </p>
    </fieldset>
  </form>
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
    </div> 
</body>
</html>