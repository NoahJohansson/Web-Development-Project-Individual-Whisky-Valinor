<?php
session_start();
$db = new SQLite3 ('./db/sqlite.db');


if(isset($_POST['loginsubmit']))
{
    $email = SQLite3::escapeString($_POST['loginEmail']); //prevents sql injections
    $passw = SQLite3::escapeString($_POST['loginPassword']);

    $ret = $db->query("SELECT * FROM User WHERE email='$email'"); //Get data from database User
    while($row = $ret->fetchArray(SQLITE3_ASSOC)) //Give values to variables from that row in db
    {
            $dbemail = $row['email'];
            $dbpassword = $row['password'];
            $dbsalt = $row['salt'];            
    }

    $checkEmail = $db->query("SELECT COUNT(*) as count FROM User WHERE email='$email'"); //See if email exists
    $count = $checkEmail->fetchArray();
    $numrows = $count['count'];
    if(($numrows) == 0) //If it doesn't, give 'noEmailExits' a value
    {
        
        $_SESSION['noEmailExists']="No record of that email, try again or register new user*";
        echo "no email exist";
        unset($_SESSION['loginEmail']);
        header("location: login.php");
    }

    else
    {
        $saltedpw = $passw . $dbsalt;
        $hashedpw = hash('md5', $saltedpw); //Apply salt and hash to password
        $_SESSION['loginEmail'] = $_POST['loginEmail'];

        if($hashedpw != $dbpassword) //See if password input is the same as password in database
        {
            $_SESSION['pswError'] = "Password was incorrect*";
            echo "wrong password";
            header("location: login.php");
        }

        else
        {
            unset($_SESSION['email']);
            $_SESSION['email'] = $email;
            $_SESSION['loginSuccess'] = "Success, you are now logged in";
            header("location: index.php"); //Proceed to index
        }
    }
}

?>