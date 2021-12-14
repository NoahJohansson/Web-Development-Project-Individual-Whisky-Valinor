<?php 
    session_start();
    $db = new SQLITE3 ('./db/sqlite.db');
    $email = $_SESSION['email'];

    $db->exec("CREATE TABLE IF NOT EXISTS Posts(ID INTEGER PRIMARY KEY AUTOINCREMENT, email TEXT, comment TEXT)");
    $sql = "INSERT INTO 'Posts' ('email', 'comment') VALUES (:email, :comment)";
    $stmt = $db->prepare($sql); //Prepare statements help prevent sql injections
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':comment', $_POST["comment"], SQLITE3_TEXT);

    $comment = SQLite3::escapeString($_POST["comment"]);

    $formValid = true;

    validateInput($comment);

    if(empty($comment))
    {
        $commentError = "* Post can't be empty";
        $formValid = false;
    }

    if($formValid)
    {
        $_SESSION['commentPost'] = "Your post was submitted"; //Set variable so that appropriate message will appear when post is submitted
        $stmt->execute();
    }
    
    $res = $db->query("SELECT * FROM Posts WHERE comment='$comment'"); //Select all values from db Posts
    if($row = $res->fetchArray()) 
    {
        $temp = $row['email'];
        $res2 = $db->query("SELECT * FROM User WHERE email = '" . SQLite3::escapeString($temp) . "'");
        echo $row["email"];
        echo "<br>";
        if($row2 = $res2->fetchArray())
        {
            echo "<img src='images/".$row2['image']."' width=60 height=60>";
        }
        echo "<br>";
        echo "---";
        echo "<br>";
        echo $row["comment"];
        echo "<br>";
        echo "-------------------------------------------------------------------";
        echo "<br>";
    }


function validateInput($input) //https://www.w3schools.com/php/php_form_url_email.asp
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>