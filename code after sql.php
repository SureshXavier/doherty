<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            $sql = "SELECT * FROM users WHERE email ='$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user) {
                if (password_verify($password, $user["Password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    setcookie("user_email", $email, time() + (86400 * 30), "/");
                    header("Location: index.php");
                    die();
                }else{
                    echo"<div class='alert alert-danger'>Password does not match</div>";
                }
                 
            }else{
                echo"<div class='alert alert-danger'>Email does not match</div>";
            }
        
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                 <input type="email" placeholder="Enter Email:" name="email" class="form-control" value="<?php echo $_COOKIE['user_email']; ?>">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
    </br>
        <div><p>Not registered yet <a href="registration.php">Register Here</a></p></div>
    </div>
</body>
</html>