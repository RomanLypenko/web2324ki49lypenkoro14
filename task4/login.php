<?php
session_start();
if (isset($_POST["login"])) 
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) 
        {
            if ($password==$user["password"]) 
            {
                $_SESSION["user"] = $user;
                header("Location: index.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://accounts.google.com/gsi/client" async></script>
</head>

<body>
    <div class="container">
        <?php

if (isset($_POST["login"])) {
           
            if ($user) {
                if ($password==$user["password"]) {
                    
                    
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
?>
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
      
      <div id="g_id_onload"
    data-client_id="630283766407-6mb9js3hots1su8f83huf6h0d71pl1nl.apps.googleusercontent.com"
    data-context="signin"
    data-ux_mode="popup"
    data-callback="handleCredentialResponse"
    data-auto_prompt="false">
</div>

<div class="g_id_signin"
    data-type="standard"
    data-shape="rectangular"
    data-theme="outline"
    data-text="signin_with"
    data-size="large"
    data-logo_alignment="left">
</div>
      
     <div><p>Not registered yet <a href="registration.php">Register Here</a></p></div>
    </div>
</body>
<script>
// Credential response handler function
async function handleCredentialResponse(response){
      const response123= JSON.parse(atob(response.credential.split('.')[1]))           
    console.log(response123)
    var formData = new FormData();
    formData.append("email",response123.email)
            var xhr = new XMLHttpRequest();
            xhr.open('Post', 'googleauth.php', true);
 xhr.onload = function() {
              window.location.href="index.php"
            };
            xhr.send(formData);

}
</script>
</html>