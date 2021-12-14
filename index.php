<?php
include ('Post.php'); //Include Post.php
$commentError = "";

if (!isset($_SESSION['email'])) //Checks if user is logged in
{
  header('location: login.php');
}

if (isset($_GET['logout'])) //if logout button is pressed, destroy session and go back to login page
{
	session_destroy();
	unset($_SESSION['loginSuccess']);
	header("location: login.php");
}
?>
<script> //Script used to prevent form from being submitted each time page is refreshed.
         //https://www.webtrickshome.com/faq/how-to-stop-form-resubmission-on-page-refresh
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/styling.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script defer src="/javascript/JavascriptFunctions.js"> type="text/javascript" </script>
</head>
<body>
<div id="title">
<h1>
  Whisky Valinor
</h1>
</div>

<div class = "success" id = "successs">
<?php //Display appropriate message for user when log in, registered, or commented
if(isset($_SESSION['regSuccess']))
  {
    echo $_SESSION['regSuccess'];
    unset($_SESSION['regSuccess']);
  }
if(isset($_SESSION['loginSuccess']))
  {
    echo $_SESSION['loginSuccess'];
    unset($_SESSION['loginSuccess']);
  }

  if(isset($_SESSION['commentPost']))
  {
    echo ($_SESSION['commentPost']);
    unset ($_SESSION['commentPost']);
  }
  if(isset($_SESSION['profileSuccess']))
  {
    echo ($_SESSION['profileSuccess']);
    unset($_SESSION['profileSuccess']);
  }
?>
</div>

<div>
<a id="logout"href="index.php?logout='1'">Log Out</a>
</div>

<div>
<a id="profile" href="profile.php">My Profile</a>
</div>

<div id="wrap">
<form id="form" method="post" onsubmit="return Post();">

    <span class="error" id="error-comment"></span><br> Post anything related to whisky below
    <textarea name="comment" id="comment" rows="10" cols="60"></textarea>
    <br><br>

    <button type="submit" class="postbutton" name="submitbutton"> Submit</button>
</form>
</div>

<form id="searchform" method="post" onsubmit="return SearchPosts();">
<label for="searchbar"> Search posts here:</label><br>
<input id="searchbar"><br>
<button type="submit" class="loginsubmit" id="searchbutton">Search</button>
</form>

</body>
<div class = "comments" id="commentsection">
<?php 

include ('GetPosts.php'); //Include posts

?>
</div>

<div id="commentTitle">
Posts
</div>
</html>