<h4>Attempting MySQL connection from php...</h4>
<?php
$host = 'sqlService';
$user = 'haophan';
$pass = '977463';
$db_name = 'Ass2';
echo "Connecting to Database: $host $user $pass $db_name";
echo "<br><br>";

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected to MySQL successfully!";
echo "<br><br>";
$conn->close();
?>
 

