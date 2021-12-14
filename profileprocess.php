<?php
session_start();
$db = new SQLite3 ('./db/sqlite.db');

if(isset($_POST["profilesubmit"])) 
{

    $passw = SQLite3::EscapeString($_POST["newPassword"]); //Prevents sql injections
    $salt = uniqid(mt_rand(), true); //creates random salt
    $saltedpw = $passw . $salt;
    $hashedpw = hash('md5', $saltedpw);

    $profileimage = $_FILES['profileimage']['name']; //get image from profileform
    $target = "images/".basename($profileimage);

    $db->exec("CREATE TABLE IF NOT EXISTS User(UID INTEGER PRIMARY KEY AUTOINCREMENT, email TEXT UNIQUE, password BLOB, salt BLOB, image varchar(100))");
    $sql = "INSERT OR IGNORE INTO 'User' ('email', 'password', 'salt', 'image') VALUES (:email, :password, :salt, '$profileimage')";
    $stmt = $db->prepare($sql); //Prepare statements prevent sql injections
    $stmt->bindParam(':email', $_POST["newEmail"], SQLITE3_TEXT);
    $stmt->bindParam(':password', $hashedpw, SQLITE3_BLOB);
    $stmt->bindParam(':salt', $salt, SQLITE3_BLOB);
    $formValid = true;

    $email = SQLite3::escapeString($_POST["newEmail"]);
    $pw = SQLite3::escapeString($_POST["newPassword"]);

    $checkEmail = $db->query("SELECT COUNT(*) as count FROM User WHERE email='$email'");
    $count = $checkEmail->fetchArray();
    $numrows = $count['count'];

if(($numrows) == 0 || $email == $_SESSION['email']) //Checks if new email does not exist in databaseS
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
        $deleteemail = $_SESSION['email'];
        $db->exec("DELETE FROM User WHERE email='$deleteemail'");//deletes row where email is current session email

        move_uploaded_file($_FILES['profileimage']['tmp_name'], $target); //Moves image to folder where profile pictures are stored
        $stmt->execute();
        unset($_SESSION['email']);
        $_SESSION['email'] = $email;
        unset ($_SESSION['commentPost']);
        $_SESSION['profileSuccess'] = "Profilechange was a success, you are now logged in!";
        header('location: index.php');
    }
}

else //if email already exists
{
    $_SESSION['emailTaken'] = "That email is taken, use a different one";
}
}


?>