<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>
<body>
    
        <div class="container">
  <h1>Welcome to Dashboard</h1>
  <form action="process.php" method="POST">
    <div class="form-group">
      <label for="messageBox">Write something:</label>
      <textarea class="form-control" id="messageBox" name="message" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</br>
  <a href="logout.php" class="btn btn-warning">Logout</a>
</div>
</br>
  


    </div>
</body>
</html>