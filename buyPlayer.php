<?php
    include 'index.php';
	require_once('authentication.php');
	$username = $_SESSION['username'];
    $sql = "select * from shooter";
    $result = mysqli_query($con,$sql);
    //echo mysqli_num_fields($result);
	$idarray = array();
	while ($row = mysqli_fetch_assoc($result)) 
	{
		array_push($idarray,$row['playerId']);
		echo "<div>
			<span> Name : '.$row[playername]'</span><br>
			<span> Rating : '$row[playerrating]'</span><br>
			<span> Score : '$row[playerscore]'</span><br>
			<span> Cost : '$row[playercost]'</span>
		</div>";
	}
	for ($i=0;$i < count($idarray);$i++){ 
		echo $idarray[$i];
	};
	mysqli_free_result($result);
	//$i = "select userid from user where username = '$username'";
	//$result = mysqli_query($con,$i);
	//$sql = "insert into userPlayer values($result,$playerid)";

		// echo $row['playername'];
		// echo $row['playerrating'];
		// echo $row['playerscore'];
		// echo $row['playercost'];
	
