<?php
include ("profileprocess.php")
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
Profile
</div> 
<br>
<div class="registerForm">
<form id="profileForm" method="post" enctype="multipart/form-data" onsubmit="return validateProfileForm()">
    <br>
    <div id="regTitleInForm">
    Change email or password (or both)
    </div>
    <br><br>
    <label for="newEmail"> New email: </label><br>
    <input type="text" class="enterEmail" id="newEmail" name="newEmail"><span class="error" id="error-newEmail"></span>
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
    <label for="newPassword"> New password: </label><br>
    <input type="password" class="enterPassword" id="newPassword" name="newPassword"><span class="error" id="error-newPassword"></span>
    <br>
    <label for="file">Profile picture:</label>
    <input type="file" id="profileimage" name="profileimage"></input><br><span class="error" id="error-profileuploadImage"></span><br>
    <button type="submit" name="profilesubmit" class="registerbutton" onclick="return validateProfileForm()"> Change! </button>

    <p>Don't want to change email or password?<a href="index.php">Go back to posts</a></p>
</form>
</div>
</body>

</html>