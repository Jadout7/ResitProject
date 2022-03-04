<?php
mysql_connect($dbHost, $dbUser, $dbPass, $dbName);
mysql_select_db("webshop") or die("could not find db");

if(!$conn){
  die("Database connection failed! Error: " . mysqli_connect_errno());

$output ='';
//collect
  if(isset($_POST['search']))  {
  	$searchq = $_POST ['search'];
  	$searchq = preg_replace ("#[^0-9a-z]#i",,"", $searchq);

  	$query = mysql_query ("From item where title like%?% ") or die ("could not search!");
  	$count = mysql_num_rows($query)
  	if($count == 0) {
  		$output = 'There was no search results!';
  	}else{
        while($row = mysql_fetch_array($query)) {

        }
  	}


  }
}

?>



