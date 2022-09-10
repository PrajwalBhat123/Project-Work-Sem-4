<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

</head>
<body>
<?php
    //error_reporting(0);
    include ('index.php');
    require_once('authentication.php');
    if(!$_SESSION['username'])
    {
        header('location:login.php');
    }
    $username = $_SESSION['username'];
    if(isset($_POST['buyCoach'])){
       // echo $_POST['buyCoach'];
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
    ?>
    <?php
    // if(isset($_POST['upload'])){
    //     $image = $_FILES['image']['name'];
    //     $path = 'images/'.$image;

    //     move_uploaded_file($_FILES['image']['tmp_name'],$path);
    // }
    $sql = "select * from coach";
	$result = mysqli_query($con,$sql);
    
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <div id="demo" class="carousel slide" data-ride="carousel">

<!-- Indicators -->
                    <ul class="carousel-indicators">
                        <?php
                            $i=0;
                            //echo $i;
                            foreach($result as $row){
                                $actives = '';
                                //echo $i;
                                if($i == 0){
                                    $actives = 'active';
                                }
                                //echo $actives;
                        ?>
                        <li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php echo $actives;?>"></li>
                        <?php $i++; }?>    
                    </ul>

<!-- The slideshow -->
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
                            <!-- <img src="la.jpg" alt="Los Angeles"> -->
                            <div class="card p-3 py-4">
				                <div class="text-center"> 
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

<!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon">Prev</span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
