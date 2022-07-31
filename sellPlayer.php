<?php
    //error_reporting(0);
    include 'index.php';
    require_once('authentication.php');
    $username = $_SESSION['username'];
    $sql = "select * from userPlayers where userId = (select userId from user where username = '$username')";
    $result = mysqli_query($con,$sql);
    $idArray = array();
    while ($row = mysqli_fetch_assoc($result)){
        array_push($idArray,$row['playerId']);
        if($row['type'] == "shooter"){
            $sql = "select * from shooter where playerId = '$row[playerId]'";
            $result = mysqli_query($con,$sql);
            $display = mysqli_fetch_assoc($result);
            
            echo 
                "<div>
			        <span> Name : '.$display[playername]'</span><br>
    			    <span> Rating : '$display[playerrating]'</span><br>
	    		    <span> Score : '$display[playerscore]'</span><br>
	            	<span> Cost : '$display[playercost]'</span>
		        </div>";    
        }else{
            $sql = "select * from goalie where playerId = '$row[playerId]'";
            $result = mysqli_query($con,$sql);
            $display = mysqli_fetch_assoc($result);
            
            echo 
                "<div>
			        <span> Name : '.$display[playername]'</span><br>
    			    <span> Rating : '$display[playerrating]'</span><br>
	    		    <span> Score : '$display[playerscore]'</span><br>
	            	<span> Cost : '$display[playercost]'</span>
		        </div>";        
        }
    }

    function sellPlayer(){
        $sql = "delete from userPlayers where playerId = '$playerId'";
        $result = mysqli_query($con,$sql);
        $sql = "delete from userTeams where playerId exists in ('$playerId')";
        $result = mysqli_query($con,$sql);   
    }