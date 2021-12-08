<?php


        if ($_POST['command'] == 'Submit')
        {
            validate();
        }
        elseif ($_POST['command'] == 'Create User') 
        {
            createUser();
        }
        elseif ($_POST['command'] == 'Create') 
        {
            create();
        }
        elseif ($_POST['command'] == 'Comment') 
        {
            comment();
        }
        elseif ($_POST['command'] == 'Add') 
        {
            addInstructor();
        }
        elseif ($_POST['command'] == 'Create Category') 
        {
            addCategory();
        }
        elseif ($_POST['command'] == 'Update') 
        {
            update();
        }        
        elseif ($_POST['command'] == 'Update User') 
        {
            updateUser();
        }
        elseif ($_POST['command'] == 'Update Category') 
        {
            updateCategory();
        }
        elseif ($_POST['command'] == 'Edit') 
        {
            editInstructor();
        }
        elseif ($_POST['command'] == 'Delete') 
        {
            delete();
        }
        elseif ($_POST['command'] == 'Delete Comment') 
        {
            deleteComment();
        }
        elseif ($_POST['command'] == 'Delete User') 
        {
            deleteUser();
        }
        elseif ($_POST['command'] == 'Delete Category') 
        {
            deleteCategory();
        }
        elseif ($_POST['command'] == 'Delete Instructor') 
        {
            deleteInstructor();
        }
        elseif ($_POST['command'] == 'Login') 
        {
            login();
        }

    function validate(){

    require('connect.php');
    
    if ($_POST && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword'])) {        
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $repassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);         
        $id = filter_input(INPUT_GET, 'userid', FILTER_SANITIZE_NUMBER_INT);
        $userlevel = 1;
        $msg = "You have successfully registered for Shotokan Karate Website!";

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $hash_repassword = password_hash($repassword, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password, userlevel, email) VALUES (:username, :password, :userlevel, :email)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hash_password);
        $statement->bindValue(':userlevel', $userlevel);
        $statement->bindValue(':email', $email);   

        if($username == "" || $password == "" || $repassword == "" || $email == "") 
        {
            if ($password != $repassword) 
            {
                return false;
            }
            
        }

        elseif($statement->execute())
        {            

            mail($email,'Welcome!',$msg);
            header('Location: back.html');         
            exit();
        }    
     }  
    } 

    function createUser(){

    require('connect.php');
    
    if ($_POST && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {        
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $repassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);         
        $id = filter_input(INPUT_GET, 'userid', FILTER_SANITIZE_NUMBER_INT);
        $userlevel = 1;

        $query = "INSERT INTO users (username, password, userlevel, email) VALUES (:username, :password, :userlevel, :email)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':userlevel', $userlevel);
        $statement->bindValue(':email', $email);   

        if($username == "" || $password == "" || $repassword == "" || $email == "") 
        {
            if ($password != $repassword) 
            {
                header('Location: createuserserror.php');            
                exit();
            }
            
        }

        elseif($statement->execute())
        {

            header('Location: admin.php');            
            exit();
        }    
     }  
    }

    function addInstructor(){

    require('connect.php');
    
    if ($_POST && isset($_POST['fullname']) && isset($_POST['rank']) && isset($_POST['mentor']) && isset($_POST['karateexperience'])) {  
        $picture = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $rank = filter_input(INPUT_POST, 'rank', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mentor = filter_input(INPUT_POST, 'mentor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $karateexperience = filter_input(INPUT_POST, 'karateexperience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);         
        $id = filter_input(INPUT_GET, 'instructorid', FILTER_SANITIZE_NUMBER_INT);

        $query = "INSERT INTO instructors (picture, fullname, rank, mentor, karateexperience) VALUES (:picture, :fullname, :rank, :mentor, :karateexperience)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':picture', $picture);
        $statement->bindValue(':fullname', $fullname);
        $statement->bindValue(':rank', $rank);
        $statement->bindValue(':mentor', $mentor);
        $statement->bindValue(':karateexperience', $karateexperience);   

        if($fullname == "" || $rank == "" || $mentor == "" || $karateexperience == "") 
        {      
            
            header('Location: createuserserror.php');            
            exit();            
            
        }

        elseif($statement->execute())
        {

            header('Location: instructors.php');            
            exit();
        }    
     }  
    }

    function addCategory(){

    require('connect.php');
    
    if ($_POST && isset($_POST['categoryname'])) {        
        $name = filter_input(INPUT_POST, 'categoryname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "INSERT INTO categories (categoryname) VALUES (:categoryname)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':categoryname', $name);

        if($name == "") 
        {
            header('Location: posterror.php');            
            exit();
        }

        elseif($statement->execute())
        {            
            header('Location: news.php?categoryid=4');            
            exit();
        }    
     }  
    }

    function create(){

    require('connect.php');
    
    if ($_POST && isset($_POST['Title']) && isset($_POST['Content'])) {        
        $title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $content = filter_input(INPUT_POST, 'Content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);        
        $id = filter_input(INPUT_GET, 'postid', FILTER_SANITIZE_NUMBER_INT);
        $categoryid = filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_NUMBER_INT);

        $query = "INSERT INTO blog (Title, Content, categoryid) VALUES (:Title, :Content, :categoryid)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':Title', $title);
        $statement->bindValue(':Content', $content);
        $statement->bindValue(':categoryid', $categoryid); 

        if($title == "" || $content == "") 
        {
            header('Location: posterror.php');            
            exit();
        }

        elseif($statement->execute())
        {            
            header('Location: news.php?categoryid=4');            
            exit();
        }    
     }  
    }

    function comment(){

    require('connect.php');

    session_start();
    
    if ($_POST && isset($_POST['comment'])){
         
        $comment = filter_input(INPUT_POST, 'comment');   
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_NUMBER_INT);
        $postid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $user_captcha = filter_input(INPUT_POST, 'captcha_challenge');
        $captcha = $_SESSION['captcha_text'];

        $query = "INSERT INTO comments (userid, comment, postid, username) VALUES (:userid, :comment, :postid, :username)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':userid', $userid);
        $statement->bindValue(':postid', $postid);
        $statement->bindValue(':comment', $comment);
        $statement->bindValue(':username', $username);


        if($comment == "" || $user_captcha == "" || $user_captcha != $captcha) 
        {            
            header('Location: insert.php');            
            exit();            
        }

        elseif($statement->execute())
        {          
            header('Location: news.php?categoryid=4');            
            exit();
        }    
     }
        }
    

    function update()
    {
        require('connect.php');

        $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $query     = "UPDATE blog SET Title = :Title, Content = :Content WHERE postid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':Title', $title);        
        $statement->bindValue(':Content', $content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
       if($title == "" || $content == "") 
        {
            header('Location: posterror.php');            
            exit();
        }

        elseif($statement->execute())
        {            
            header('Location: news.php?categoryid=4');            
            exit();
        }    
    }

    function updateUser()
    {
        require('connect.php');

        $username  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userlevel = filter_input(INPUT_POST, 'userlevel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $query     = "UPDATE users SET username = :Username, password = :Password, email = :Email, userlevel = :Userlevel WHERE userid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':Username', $username);        
        $statement->bindValue(':Password', $hash_password);
        $statement->bindValue(':Email', $email);
        $statement->bindValue(':Userlevel', $userlevel, PDO::PARAM_INT);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
       if($username == "" || $password == "" || $email == "" || $userlevel == "") 
        {
            header('Location: edituserserror.php');            
            exit();
        }

        elseif($statement->execute())
        {            
            header('Location: admin.php');            
            exit();
        }    
    }

    function updateCategory()
    {
        require('connect.php');

        $categoryname  = filter_input(INPUT_POST, 'categoryname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $query     = "UPDATE categories SET categoryname = :categoryname WHERE categoryid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryname', $categoryname);        
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
       if($categoryname == "") 
        {
            header('Location: edituserserror.php');            
            exit();
        }

        elseif($statement->execute())
        {            
            header('Location: news.php?categoryid=4');            
            exit();
        }    
    }

    function editInstructor()
    {
        require('connect.php');

        if ($_POST['image'] == "") 
        {
            $picture = filter_input(INPUT_POST, 'currentimage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filename = "";
        }
        else
        {
            $picture = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filename = filter_input(INPUT_POST, 'currentimage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }         
        
        $fullname  = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $rank = filter_input(INPUT_POST, 'rank', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mentor = filter_input(INPUT_POST, 'mentor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $karateexperience = filter_input(INPUT_POST, 'karateexperience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $query     = "UPDATE instructors SET fullname = :Fullname, rank = :Rank, mentor = :Mentor, karateexperience = :Karateexperience, picture = :Picture WHERE instructorid = :id";

        $statement = $db->prepare($query);         
        $statement->bindValue(':Fullname', $fullname);        
        $statement->bindValue(':Rank', $rank);
        $statement->bindValue(':Mentor', $mentor);
        $statement->bindValue(':Karateexperience', $karateexperience);
        $statement->bindValue(':Picture', $picture);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

       if($fullname == "" || $rank == "" || $mentor == "" || $karateexperience == "")
        {
            header('Location: edituserserror.php');            
            exit();
        }

        elseif($statement->execute())
        {   
            unlink('C:' . DIRECTORY_SEPARATOR . 'xampp\htdocs\wd2\Project\uploads' . DIRECTORY_SEPARATOR . $filename);  
            header('Location: instructors.php');            
            exit();
        }    
    }

    function delete()
    {
        require('connect.php');  
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM blog WHERE postid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        header('Location: news.php?categoryid=4');            
        exit();
    }

    function deleteUser()
    {
        require('connect.php');  
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM users WHERE userid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        header('Location: admin.php');            
        exit();
    }  

    function deleteCategory()
    {
        require('connect.php');  
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM categories WHERE categoryid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        header('Location: news.php?categoryid=4');            
        exit();
    }  

    function deleteComment()
    {
        require('connect.php');  
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM comments WHERE postid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        header('Location: news.php?categoryid=4');            
        exit();
    } 


    function deleteInstructor()
    {
        require('connect.php');  
        
        $filename =  filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM instructors WHERE instructorid = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
        unlink('C:' . DIRECTORY_SEPARATOR . 'xampp\htdocs\wd2\Project\uploads' . DIRECTORY_SEPARATOR . $filename);

        $statement->execute();

        header('Location: instructors.php');          
        exit();
    }    

    function login()
    {
        require('connect.php');

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);

        $statement->execute();

        $row = $statement->fetch();

        $hash = $row['password'];

        $verify = password_verify($password, $hash); 

        if ($username != "" && $_POST['password'] != "" && $verify) 
        {
            session_start();
            $_SESSION['login'] = $row['username'];
            $_SESSION['userlevel'] = $row['userlevel'];
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['verify'] = $verify;
            header('Location: index.php');            
            exit();
        }
        else
        {
            header('Location: loginerror.php');            
            exit();
        } 
           
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDO Error</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

            <pre><?=print_r($_POST)?></pre>
            <pre><?=print_r($_SESSION)?></pre>

      

</body>
</html>
