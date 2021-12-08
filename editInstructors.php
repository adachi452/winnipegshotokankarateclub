<?php

    session_start();

    require('connect.php');

    // SQL is written as a String.
     $query = "SELECT * FROM instructors WHERE instructorid = :id LIMIT 1";

     // A PDO::Statement is prepared from the query.
     $statement = $db->prepare($query);

     $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

     // Execution on the DB server is delayed until we execute().
      $statement->bindValue('id', $id, PDO::PARAM_INT);
      $statement->execute(); 

     // Fetch the row selected by primary key id.
     $row = $statement->fetch();

        // file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

    if ($image_upload_detected) { 
        $image_filename        = $_FILES['image']['name'];
        $temporary_image_path  = $_FILES['image']['tmp_name'];
        $new_image_path        = file_upload_path($image_filename);
        if (file_is_an_image($temporary_image_path, $new_image_path)) {
            move_uploaded_file($temporary_image_path, $new_image_path);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Instructor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?= $statement->rowCount() ?>
    <div id="wrapper">
        <div id="header">
            <h1>Edit Instructor</h1>
        </div> 
    <h7>EDIT PICTURE BELOW:</h7>
    <br>
    <br>
    <form method='post' enctype='multipart/form-data'>
         <label for='image'>Image Filename:</label>
         <input type='file' name='image' id='image'>
         <input type='submit' name='submit' value='Upload Image'>
     </form>
<ul id="menu">
    <li><a href="instructors.php" >Back</a></li>
</ul> 
<div id="all_blogs">
  <form action="insert.php" method="post">
    <fieldset>
      <legend>Edit Instructor</legend>      
     
    <?php if ($upload_error_detected): ?>

        <p>Error Number: <?= $_FILES['image']['error'] ?></p>

    <?php elseif ($image_upload_detected): ?>

        <label for="image">Picture Uploaded</label>
        <input name="image" id="image" type="text" value="<?= $_FILES['image']['name'] ?>"/>

    <?php endif ?>
      <p>
        <label for="currentimage">Current Picture</label>
        <input name="currentimage" id="currentimage" type="text" value="<?= $row['picture'] ?>"/>
      </p>
      <p>
        <label for="fullname">Full Name</label>
        <input name="fullname" id="fullname" type="text" required="text" value="<?= $row['fullname'] ?>"/>
      </p>
      <p>
        <label for="rank">Rank</label>
        <input name="rank" id="rank" type="text" required="text" value="<?= $row['rank'] ?>"/>
      </p>
      <p>
        <label for="mentor">Mentor</label>
        <input name="mentor" id="mentor" type="text" required="text" value="<?= $row['mentor'] ?>"/>
      </p>
      <p>
        <label for="karateexperience">Karate Experience</label>
        <input name="karateexperience" id="karateexperience" type="text" required="text" value="<?= $row['karateexperience'] ?>"/>
      </p>
      <p>
        <input type="hidden" name="id" value="<?= $row['instructorid'] ?>" />
        <input type="submit" name="command" value='Edit'/>
        <input type="submit" name="command" value='Delete Instructor' onclick="return confirm('Are you sure you wish to delete this instructor?')"/>
      </p>
    </fieldset>
  </form>
</div>
        <footer>
          <br>
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