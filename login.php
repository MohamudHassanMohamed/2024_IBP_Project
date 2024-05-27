<?php
session_start();
if(isset($_SESSION["user"])){
    header(("Location: home.html"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN FORM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css" />
    <script
      src="https://kit.fontawesome.com/a4c1873e8e.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
     <div class="container"> 
        <?php
          
          if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user =  mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user){
                if (password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: home.html");
                    die();
                }
                else{
                      echo "<div class='alert alert-danger'>password is not correct</div>";
                }
             }  else{
                    echo "<div class='alert alert-danger'>Email is not correct</div>";
                }
            }
          

        ?>

         <div class="form-box">
            <h1 id="title">LOGIN</h1>
     <form action="login.php" method="post">
      <div class="input-field">
              <i class="fa-solid fa-square-envelope"></i>
              <input type="email" class="input-control" name="email" placeholder="Email" />
            </div>

            <div class="input-field">
              <i class="fa-solid fa-lock"></i>
              <input type="password" class="input-control" name="password" placeholder="Password" />
            </div>

          <div class="input-btn">
            <button type="submit" id="submit" class="input-primary" name="login">login</button>
           
        </div>

        </form>
        <div> 
            <p>Not registered yet<a href="signUp.php">Click here To regestered</a></p>
     
         </div>
        </div>
     </div>
</body>
</html>