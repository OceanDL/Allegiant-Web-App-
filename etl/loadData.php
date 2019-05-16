<?php
//DB connection setup (for local machine, your info will differ)
$servername = "localhost";
$username = "root";
$password = "''";
$database = "AllegiantWebApp";
$dbport = 3306;

session_start();

//DB Connection & queries
$db = new mysqli($servername, $username, $password, $database, $dbport);
$data1Query = addData('data1.csv', 'map1.csv');
$db->query($data1Query);
$data2Query = addData('data2.csv', 'map2.csv');
$db->query($data2Query);



//Function to call to take our .CSV files and add to customers table
function addData($fileName, $mapName){
    $map = file($mapName);

    $query = <<<eof
    LOAD DATA LOCAL INFILE '$fileName'
    INTO TABLE customers
    FIELDS TERMINATED BY ',' 
    LINES TERMINATED BY '\n'
    IGNORE 1 LINES
   ($map[0])
eof;

return $query;
}

?>