<?php

    session_start();

    include 'php-image-resize-master/lib/ImageResize.php';
    use \Gumlet\ImageResize;

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
          $resizedImage = new ImageResize($new_image_path);
          $image->scale(30);
          $image->save('image2.jpg');
            move_uploaded_file($temporary_image_path, $new_image_path);
        }
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Add Instructor</title>
    <link rel = "stylesheet" type = "text/css" href = "shotokanstyles.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Add Instructor</a></h1>
        </div> 

    <h7>ADD A PICTURE BELOW:</h7>
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
      <legend>Create New Instructor</legend>
     
    <?php if ($upload_error_detected): ?>

        <p>Error Number: <?= $_FILES['image']['error'] ?></p>

    <?php elseif ($image_upload_detected): ?>

        <label for="image">Picture Uploaded</label>
        <input name="image" id="image" type="text" value="<?= $_FILES['image']['name'] ?>"/>

    <?php endif ?>
      <p>
        <label for="fullname">Full Name</label>
        <input name="fullname" id="fullname" type="text"  />
      </p>
      <p>
        <label for="rank">Rank</label>
        <input name="rank" id="rank" type="text" />
      </p>
      <p>
        <label for="mentor">Mentor</label>
        <input name="mentor" id="mentor" type="text"  />
      </p>
      <p>
        <label for="karateexperience">Karate Experience</label>
        <input name="karateexperience" id="karateexperience" type="text" />
      </p>
      <p>
        <input type="submit" name="command" value='Add' />
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