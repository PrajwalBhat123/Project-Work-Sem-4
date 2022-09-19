<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="homestyle.css">
    <script src = "script.js\"></script>
    <title> Cty: Home Page </title>
    <style>         
      body {
        background-image: url("images/backimage.jpg");
        background-size: cover;
      }
    </style>
</head>
<body>
<?php 
  include 'index.php';
  include 'authentication.php';
  if(!$_SESSION['username'])
    {
      header('location:login.php');
    }
    $username = $_SESSION['username'];
    $sql = "select * from user where username = '$username'";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_assoc($result)){
      $wallet = $row['wallet'];
      $userid = $row['userId'];
    }
    $sql = "select * from userteams where userId = '$userid'";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_assoc($result)){
      $team = $row['teamname'];
    }  
?>
  <div class = "topnav">

    <a class="active" href="">
      <div class = "child"><?php echo $username; ?></div>
    </a>
  
    <a href="">
      <div class = "child"><?php echo $team; ?></div>
    </a>
  
    <a href="">
      <div class = "child"><?php echo $wallet; ?></div>
    </a>

    <a href="viewPlayers.php">
        <div class = "child">View Players</div>
    </a>
    
    <a href="buyCoach.php">
        <div class = "child">Buy Coach</div>
    </a>

    <a href="form.php">
        <div class = "child">Create Player</div>
    </a>

    <a href="login.php">
      <button>Logout</button>
    </a>
  
  </div>
  
    <div class="flex-container">
        <a href = "teamselection.php">
        <div class="flex-child magenta">
          <h1>Play Game</h1>
        </div>
       </a>
       <a href = "test.php">
        <div class="flex-child green">
          <h1>Buy Player</h1>
        </div>
      </a>
      <a href = "pw.php">
        <div class="flex-child yellow">
            <h1>Sell Player</h1>
        </div>
      </a>
      <a href = "displayPlayer.php">
        <div class="flex-child blue">
          <h1>Select Team Players</h1>
        </div>
      </a>
    </div>
  </body>
</html>
