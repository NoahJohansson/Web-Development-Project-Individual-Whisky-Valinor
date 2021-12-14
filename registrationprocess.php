<?php
session_start();
$db = new SQLite3 ('./db/sqlite.db');

if(isset($_POST["registersubmit"])) 
{
    $passw = SQLite3::EscapeString($_POST["regPassword"]); //Prevents sql injections
    $salt = uniqid(mt_rand(), true); //creates random salt
    $saltedpw = $passw . $salt;
    $hashedpw = hash('md5', $saltedpw);

    //Implementing profile pictures https://codewithawa.com/posts/image-upload-using-php-and-mysql-database
    $image = $_FILES['image']['name']; //get image from form
    $target = "images/".basename($image);//folder images is where profile pictures will be saved

    $db->exec("CREATE TABLE IF NOT EXISTS User(UID INTEGER PRIMARY KEY AUTOINCREMENT, email TEXT UNIQUE, password BLOB, salt BLOB, image varchar(100))");
    $sql = "INSERT OR IGNORE INTO 'User' ('email', 'password', 'salt', 'image') VALUES (:email, :password, :salt, '$image')";
    $stmt = $db->prepare($sql); //Prepare statements prevent sql injections
    $stmt->bindParam(':email', $_POST["regEmail"], SQLITE3_TEXT);
    $stmt->bindParam(':password', $hashedpw, SQLITE3_BLOB);
    $stmt->bindParam(':salt', $salt, SQLITE3_BLOB);
    $formValid = true;

    $email = SQLite3::escapeString($_POST["regEmail"]);
    $pw = SQLite3::escapeString($_POST["regPassword"]);

    $checkEmail = $db->query("SELECT COUNT(*) as count FROM User WHERE email='$email'");
    $count = $checkEmail->fetchArray();
    $numrows = $count['count'];

if(($numrows) == 0) //Checks if email does not exist in databaseS
{

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))//See if email is valid
    {
        $formValid = false;
    }

    if(strlen($pw) < 6) //see if length of input pw is greater than 5 char
    {
        $formValid = false;
    }

    if($formValid)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $target); //Moves image to folder where profile pictures are stored
        unset($_SESSION['email']);
        $_SESSION['email'] = $email;
        $stmt->execute();
        $_SESSION['regSuccess'] = "Registration was a success, you are now logged in!";
        header('location: index.php'); //Send to index
    }
}

else //if email already exists
{
    $_SESSION['emailTaken'] = "That email is taken, use a different one";
}
}


?>