
<?php
session_start();
if(isset($_SESSION["user"])){
    header(("Location: home.html"));
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>REGISTERED</title>
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
      
      if(isset($_POST["submit"])){
        $fullName = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];
         
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  
        
        $errors =array();
        if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
          array_push($errors,"All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          array_push($errors, "Email is not valid");
        }
        if (strlen($password)<8){
          array_push($errors, "Password  must be at least 8 charactes long");
        }
        if($password!==$passwordRepeat){
          array_push($errors,"Password does not match");
        }
          require_once "database.php";
          $sql = "SELECT * FROM user WHERE email = '$email'";
          $result = mysqli_query($conn, $sql);
          $rowCount = mysqli_num_rows($result);
          if ($rowCount>0){
            array_push($errors, "Email is already exists!");
          }
          /* firo gaar ah*/
        if (count($errors)>0){
          foreach ($errors as $error) {
           echo "<div class='alert alert-danger'>$error</div>";

          }
        }
        
        else{

            /*database connect  */ 
            $sql = "INSERT INTO user (fullname, email, password) VALUES(?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            /*this function return true or false*/
            $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ( $preparestmt){
                mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                
                echo "<div class='alert alert-success'>you are registered successfully.</div>";

            }
            else{
                die("something is wrong");
            }
        }
      }
      ?>
      
      <div class="form-box">
        <h1 id="title">REGISTERED</h1>
        <form action="signUp.php" method="post">
         

            <div class="input-field">
              <i class="fa-solid fa-user"></i>
              <input type="text"  name="fullname" placeholder=" Full_Name" />
            </div>

            <div class="input-field">
              <i class="fa-solid fa-square-envelope"></i>
              <input type="email"  name="email" placeholder="Email" />
            </div>

            <div class="input-field">
              <i class="fa-solid fa-lock"></i>
              <input type="password"  name="password" placeholder="Password" />
            </div>

             <div class="input-field">
              <i class="fa-solid fa-lock"></i>
              <input type="password"  name="repeat_password" placeholder="Repeat_Password" />
            </div>
             
      
        <div class="input-btn">
            <button type="submit" id="submit"  name="submit">Register</button>
           
        </div>
         
        </form>
        <p> Already Registered <a href="login.php">Click here To login</a></p>
      </div>
    </div>

    
  </body>
</html>
