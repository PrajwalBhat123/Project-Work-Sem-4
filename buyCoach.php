<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="buy_card.css" rel="stylesheet" type="text/css"/>
	<link href="buy.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<?php
    error_reporting(0);
    include ('index.php');
    require_once('authentication.php');
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
    $username = $_SESSION['username'];
    if(isset($_POST['buyCoach'])){
        $cid = $_POST['buyCoach'];
        $sql = "select * from coach where coachId = '$cid'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
           $cost = $row['playercost'];
        }
        $sql = "select userId,wallet from user where username = '$username'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
           $wallet = $row['wallet'];
           $userId = $row['userId'];
        }
        if($wallet >= $cost){
            $idarray = array();
            $sql = "select * from userteams where userId = $userId";
            $presult = mysqli_query($con,$sql);
            while($player = mysqli_fetch_assoc($presult)){
                $coachId = $player['coach'];
            }
            if(!is_null($coachId)){
                echo "<script>alert('Already have coach !!');</script>";
            }
            if(!is_null($coachId)){
                header('location:homeindex.php');
            }

            $sql = "insert into userteams (coach) values('$cid')";
            $playerresult = mysqli_query($con,$sql);
            if(($playerresult)){
                $newwallet = $wallet - $cost;
                $sql  = "update user set wallet = '$newwallet' where username = '$username'";
                $result = mysqli_query($con,$sql);
                $sql = "insert into userPlayers values($userId,$cid,3)";
                $iresult = mysqli_query($con,$sql);
            }
        }
    }
    $sql = "select * from coach";
	$result = mysqli_query($con,$sql);
    
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <ul class="carousel-indicators">
                        <?php
                            $i=0;
                            foreach($result as $row){
                                $actives = '';
                                if($i == 0){
                                    $actives = 'active';
                                }
                        ?>
                        <li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php echo $actives;?>"></li>
                        <?php $i++; }?>    
                    </ul>

                    <div class="carousel-inner">
                    <?php
                            $i=0;
                            foreach($result as $row){
                                $actives = '';
                                if($i == 0){
                                    $actives = 'active';
                                }
                            
                        ?>
                        <div class="carousel-item <?php echo $actives ?>">
                            <div class="card p-3 py-4">
				                <div class="text-center"> 
                                    <img src="images/Coaches/"<?php echo $row['coachimage'];?>/>
					                <h3 class="mt-2"><?php echo $row['coachname'] ?></h3>
					                <?php 
            							$sql = "select countryname from country where countryId = '$row[coachcountry]'";
			            				$countryresult = mysqli_query($con,$sql);
						            	while($country = mysqli_fetch_assoc($countryresult)){
								            $countryname = $country['countryname'];
							            }  
					                ?>
					                <span class="mt-1 clearfix">Coach</span>

            					    <span class="mt-1 clearfix"><?php echo $countryname?></span>
					                <div class="row mt-3 mb-3">
						                <div class="col-md-4">
							                <h5>Cost</h5>
							                <span class="num"><?php echo $row['coachcost']?></span>
						                </div>
						                <div class="col-md-4">
							                <h5>Rating</h5>
							                <span class="num"><?php echo $row['coachrating']?></span> 
						                </div>
						                <div class="col-md-4">
							                <h5>Score</h5>
							                <span class="num"><?php echo $row['coachscore']?></span> 
						                </div>
					                </div>                   
						            <hr class="line">
					                <div class="profile mt-5">
						                <form action="test.php" method="post">
                                            <button class="profile_button px-5" id = "<?echo $row['$coachId']?>">Select Coach</button>
                                            <input type='hidden' name='buyCoach' value="<?php echo $row['coachId'];?>">
                                        </form>
                                    </div>   
				                </div>
			                </div>
			            </div>
                        <?php $i++; }?>
                    </div>

                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon">
                            <button> < </button>
                        </span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon">
                            <button> > </button>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
