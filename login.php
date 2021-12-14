<?php
session_start();
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
Login below
</div> 
<div class="registerForm">
<form id="loginForm" method="post" onsubmit="return validateLoginForm()" action="/loginprocess.php">
    <br>
    <div id="regTitleInForm">
    Log in
    </div>
    <br><br>

    <label for="regEmail"> Email: </label><br>
    <input type="text" class="enterEmail" id="loginEmail" name="loginEmail" value="<?php echo @$_SESSION['loginEmail']; ?>"/><span class="error" id="error-loginEmail"></span>
    
    <div class="error">
    <?php
    if(isset($_SESSION['noEmailExists'])) //Check if 'noEmailExists' is set, if so display message
        {
        echo $_SESSION['noEmailExists'];
        unset($_SESSION['noEmailExists']);
        }
    ?>
    </div>
<br>

    <label for="regPassword"> Password: </label><br>
    <input type="password" class="enterPassword" id="loginPassword" name="loginPassword"><span class="error" id="error-loginPassword"></span>
    
    <div class="error">
    <?php
    if(isset($_SESSION['pswError'])) //Check if 'pswError' is set, if so display message
    {
    echo $_SESSION['pswError'];
    unset($_SESSION['pswError']);
    }	
    ?>
    </div> 
<br>
    <button type="submit" name="loginsubmit" class="registerbutton" onclick="return validateloginForm()"> Login! </button>

    <p>Don't have an account? <a href="registration.php">Register</a></p>
</form>
</div>
</body>

</html>