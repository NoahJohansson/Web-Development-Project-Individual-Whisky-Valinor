<?php
include ("registrationprocess.php")
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/styling.css">
<script defer src="/javascript/JavascriptFunctions.js"> type="text/javascript" </script>
</head>

<body>
<div id="title">
<h1>
  Whisky Valinor
</h1>
</div>
<div id="registertext">
Welcome to Whisky Valinor, a website all about whisky! 
<br>
Register below
</div> 
<div class="registerForm">
<form id="regForm" method="post" enctype="multipart/form-data" onsubmit="return validateRegistrationForm()">
    <br>
    <div id="regTitleInForm">
    Create an account
    </div>
    <br><br>
    <label for="regEmail"> Email: </label><br>
    <input type="text" class="enterEmail" id="regEmail" name="regEmail"><span class="error" id="error-regEmail"></span>
<div class="error">
    <?php
    if(isset($_SESSION['emailTaken'])) //Display message if input email already exists
        {
        echo $_SESSION['emailTaken'];
        unset($_SESSION['emailTaken']);
        }
    ?>
</div>
<br>
    <label for="regPassword"> Password: </label><br>
    <input type="password" class="enterPassword" id="regPassword" name="regPassword"><span class="error" id="error-regPassword"></span>
    <br>
    <label for="file">Profile picture:</label>
    <input type="file" id="image" name="image"></input><br><span class="error" id="error-uploadImage"></span><br>

    <button type="submit" name="registersubmit" class="registerbutton" onclick="return validateRegistrationForm()"> Register! </button>

    <p>Already got an account? <a href="login.php">Sign in</a></p>
</form>
</div>
</body>

</html>