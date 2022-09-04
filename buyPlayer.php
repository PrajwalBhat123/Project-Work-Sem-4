<!doctype html>
<html lang="en">
<head>
	<title>Title</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="../buy_card/buy_card.css" rel="stylesheet" type="text/css"/>
	<link href="buy.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	<nav class="navbar navbar-expand-lg navbar-light bg-primary">
		<a class="navbar-brand" href="#">Baloond'Or </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link" href="buyPlayer.php">Buy</a>
				<a class="nav-item nav-link" href="sellPlayer.php">Sell</a>
			</div>
		</div>
	</nav> 
	
	<div class="flex-container">
		<div class="container d-flex justify-content-center">
			<?php
			   include 'index.php';
			   include ('authentication.php');
			   error_reporting(0);
			   if(! ($_SESSION['username'])){
				   header('Location : index.html');
			   }
			   $username = $_SESSION['username'];
			   $sql = "select * from player";
			   $result = mysqli_query($con,$sql);
			   $idarray = array();
			   //$countryname = 'Default';
			   while ($row = mysqli_fetch_assoc($result)){             
			   ?>           
				<form action="pw.php" method="post" class="playerbutton">
			   <div class="card p-3 py-4">
				   <div class="text-center"> 
					   <h3 class="mt-2"><?php echo $row['playername'] ?></h3>
					   <?php 
					 		$sql = "select type from type where typeId = '$row[playertype]'";
							$typeresult = mysqli_query($con,$sql);
							while($id = mysqli_fetch_assoc($typeresult)){
								$typename = $id['type'];
							}
							$sql = "select countryname from country where countryId = '$row[playercountry]'";
							$countryresult = mysqli_query($con,$sql);
							while($country = mysqli_fetch_assoc($countryresult)){
								$countryname = $country['countryname'];
							}  
							$pid= $row['playerId'];
					   ?>
					   <span class="mt-1 clearfix"><?php echo $typename ?></span>

					   <span class="mt-1 clearfix"><?php echo $countryname?></span>
					   <div class="row mt-3 mb-3">
						   <div class="col-md-4">
							   <h5>Cost</h5>
							   <span class="num"><?php echo $row['playercost']?></span>
						   </div>
						   <div class="col-md-4">
							   <h5>Rating</h5>
							   <span class="num"><?php echo $row['playerrating']?></span> 
						   </div>
						   <div class="col-md-4">
							   <h5>Score</h5>
							   <span class="num"><?php echo $row['playerscore']?></span>
						   </div>
					   </div>                   
						   <hr class="line">
					   <div class="profile mt-5">
						
							<button class="profile_button px-5">Select Player</button>
							<input type='hidden' name='buyPlayer' value="<?php echo $pid?>">	
					   </div>   
						</form>
				   </div>
			   </div>
			 <?php }?>
		   </div>   
	   </div>   
		 
   
		 
   </body>
   </html> 
   