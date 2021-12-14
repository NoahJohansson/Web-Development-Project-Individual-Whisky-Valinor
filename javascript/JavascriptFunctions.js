$.PostAjax = function() //Ajax function for submitting posts without refreshing page
{
    var email = 'email';
    var comment = document.getElementById("comment").value;
    
    {
    $.ajax({
        type: "POST", 
        url: "Post.php", 
        data: {"email":email, "comment":comment}, 
        success: function(response)
        {
            document.getElementById("commentsection").innerHTML = response + document.getElementById("commentsection").innerHTML; 
            document.getElementById("comment").value = "";
            document.getElementById("successs").innerHTML = "Your post was submitted";
        }
    })
    }
}
function Post()
{
    document.getElementById('error-comment').innerHTML = "";

    if (validateIndexForm()) 
    {
        $.PostAjax();
        return false;
    }
    else 
    {
        document.getElementById('error-comment').innerHTML = " Post cannot be empty*"
        document.getElementById("successs").innerHTML = "";
        return false;
    }
}

$.SearchAjax = function() //ajax function used for searching datanase without refreshing page
{
    var search = document.getElementById("searchbar").value;

    $.ajax({
        type: "POST", 
        url: "search.php", 
        data: {"search": search},
        success: function(response) 
        {
            document.getElementById("commentsection").innerHTML = response;
        }
    })
}

function SearchPosts()
{
    $.SearchAjax();
    return false;
}


//https://www.webtrickshome.com/faq/how-to-display-error-message-in-html-form-with-javascript-form-validation-without-using-alert
function validateIndexForm() //returns true or false depending on if input is valid
{
    var comment = document.getElementById("comment").value;
    
    if(isEmpty(comment))
    {
        return false;
    }
    else {
        return true;
    }
}

function validateRegistrationForm()//returns true or false depending on if input is valid
{
    var regEmail = document.getElementById("regEmail").value;
    var regPassword = document.getElementById("regPassword").value;

    document.getElementById('error-regEmail').innerHTML = "";
    document.getElementById('error-regPassword').innerHTML = "";
    document.getElementById('error-uploadImage').innerHTML = "";


    if (!(/\S+@\S+\.\S+/.test(regEmail))) //See if input is valid email. https://stackoverflow.com/a/46181
    {
        document.getElementById('error-regEmail').innerHTML = " Invalid email*"
    }

    if(regPassword.length < 6)
    {
        document.getElementById('error-regPassword').innerHTML = " Password must be greater than 6 characters*"
    }

    if(document.getElementById("image").files.length == 0)
    {
        document.getElementById('error-uploadImage').innerHTML = "Profile picture is required*";
        return false;
    }

    if(!(/\S+@\S+\.\S+/.test(regEmail)) || length(regPassword) < 6 || document.getElementById("image").files.length == 0)
    {
        return false;
    }
}

function validateLoginForm()//returns true or false depending on if input is valid
{
    var loginEmail = document.getElementById("loginEmail").value;
    var loginPassword = document.getElementById("loginPassword").value;

    document.getElementById('error-loginEmail').innerHTML = "";
    document.getElementById('error-loginPassword').innerHTML = "";

    if (!(/\S+@\S+\.\S+/.test(loginEmail))) //See if input is valid email. https://stackoverflow.com/a/46181
    {
        document.getElementById('error-loginEmail').innerHTML = " Invalid email*"
    }

    if(loginPassword.length < 6)
    {
        document.getElementById('error-loginPassword').innerHTML = " Password must be greater than 5 characters*"
    }

    if(!(/\S+@\S+\.\S+/.test(loginEmail)) || length(loginPassword) < 6)
    {
        return false;
    }
}

function validateProfileForm()//returns true or false depending on if input is valid
{
    var regEmail = document.getElementById("newEmail").value;
    var regPassword = document.getElementById("newPassword").value;

    document.getElementById('error-newEmail').innerHTML = "";
    document.getElementById('error-newPassword').innerHTML = "";
    document.getElementById('error-profileuploadImage').innerHTML = "";

    if (!(/\S+@\S+\.\S+/.test(regEmail))) //See if input is valid email. https://stackoverflow.com/a/46181
    {
        document.getElementById('error-newEmail').innerHTML = " Invalid email*"
    }

    if(regPassword.length < 6)
    {
        document.getElementById('error-newPassword').innerHTML = " Password must be greater than 6 characters*"
    }

    if(document.getElementById("image").files.length == 0)
    {
        document.getElementById('error-profileuploadImage').innerHTML = "Profile picture is required*";
        return false;
    }

    if(!(/\S+@\S+\.\S+/.test(regEmail)) || length(regPassword) < 6 || document.getElementById("image").files.length == 0)
    {
        return false;
    }
}


function isEmpty(input) //see if input is empty
{
    return (!input || /^\s*$/.test(input));
}