<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class "container">
        <?php
        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password=$_POST["password"];
            $confirmpassword=$_POST["confirmpassword"];
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(empty($username) OR empty($email) OR empty($password) OR empty($confirmpassword)) {
                array_push($errors,"All fields are required");
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if(strlen($password)<8) {
                array_push($errors,"Password must be atleast 8 characters long");
            }
            if ($password!==$confirmpassword) {
                array_push($errors,"Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email ='$email'";
            $result = mysqli_query($conn , $sql);
            $rowcount = mysqli_num_rows($result);
            if ($rowcount>0) {
                array_push($errors,"Email already exists");
            }
            if (count($errors)>0) {
             foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
             require_once "database.php";
             $sql = "INSERT INTO users (Username, Email, Password) VALUES ( ?, ?, ? )";
             $stmt = mysqli_stmt_init($conn);
             $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
             if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sss",$username, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                }else{
                    die("Something went Wrong");
                } 
            }
        }
        ?>

        <form action="registration.php" method="post">
            <div class ="form group">
                <input type="text" class="form control" name="username" placeholder="Username:">
            </div>
</br>
            <div class ="form group">
                <input type="email" class ="form control" name="email" placeholder="Email:">
            </div>
</br>
            <div class ="form group">
                <input type="password" class ="form control" name="password" placeholder="Password:">
            </div>
</br>
            <div class ="form group">
                <input type="confirmpassword" class="form control" name="confirmpassword" placeholder="ConfirmPassword:">
            </div>
</br>
            <div class="form btn">
                <input type="submit" class = "btn btn-primary" value="Register" name="submit">
            </div>
        </form>
    
        <div><p>Already Registered <a href ="login.php">Login Here</a></p></div>
    
    </div>
</body>
</html>