<?php
//check is if the button is set
if(isset($_POST['submitbtn'])){
	$month=$_POST["month"];
	$day=$_POST["day"];
	$year=$_POST["year"];

	if($month == "Month" || $day == "Day" || $year == "Year"){
		//error
		echo "please enter your birthday!";	
	}else{
		$seconds =mktime(0,0,0,$month,$day,$year);
		$diff =time()-$seconds;
		$age = floor($diff/31536000);

		if($age >18){
			echo "verification sucessful";
	    }else{
		echo "access denied";
	    }
    }
	   

    }

?>


