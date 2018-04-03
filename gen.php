<?php

// NOTE: code_txt should be varchar and should be unique
/*

CREATE TABLE `codes_2` (
  `code_txt` varchar(10) NOT NULL,
  `code_date_used` datetime NOT NULL,
  `code_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


*/ 

set_time_limit(0);
$myarr = array();
for ($i=1; $i<=5000; $i++){
    // all the codes starts with 2
    $startstring = 2;
    $mydate = date('l jS \of F Y h:i:s:u A');
    $mystr = 'Sufia'.$mydate.rand(10000,1000000).'Usman';
    $md5 = md5($mystr);
    $int = filter_var($md5, FILTER_SANITIZE_NUMBER_INT);
    if (strlen($int)>12){
        $myarr[] = $startstring.substr($int, 0,9);
    }
}    

$servername = "SERVER";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DBNAME";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$values = "";
for ($j=0; $j<sizeof($myarr); $j++){
    $values .= "('".$myarr[$j]."'),";
}
$values = rtrim($values,',');

$sql = "INSERT IGNORE INTO codes_2 (code_txt) VALUES ".$values.";";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>
