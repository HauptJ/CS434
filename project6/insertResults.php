<?php

//Variables for storing the required credentials

$servername = "localhost";

$username = "root";

$password = "odOrXPVk5xcTdgvP";

$databasename = "LACrimeFixMe";


//Try to connect to our database

try

    {

    //The actual database connection line

    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);



    //Set the PDO error mode to exception so we can return proper error messages

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully"; 

    }
    
//If the above code fails (i.e. an exception is caught), print the appropriate error message

catch(PDOException $errmessage)

    {

    echo "Connection failed: " . $errmessage->getMessage();

    }

echo "<html>";
echo "<body>";
	
echo "<h1>Given Data</h1>";

echo "Incident Number: "; 
$IncidentNumber = $_POST["IncidentNumber"];
echo $IncidentNumber;
echo "<br>";
echo "Time Occurred: ";
$TimeOccurred = $_POST["TimeOccurred"];
echo $TimeOccurred;
echo "<br>";
echo "Date Occurred: ";
echo "<br>";
$DateOccurred = $_POST["DateOccurred"];
echo $DateOccurred;
echo "<br>";
echo "Address: ";
$Address =  $_POST["Address"];
echo $Address;

echo "</body>";
echo "</html>";

//-----INSERT-----// WORKS

//Implement with prepared statements
//http://www.w3schools.com/php/php_mysql_prepared_statements.asp
$InsertQuery = $connection->prepare("INSERT INTO CriminalIncident (IncidentNumber, TimeOccurred, DateOccurred, Address) VALUES("$IncidentNumber, $TimeOccurred, $DateOccurred, $Address");");
 
 
 
//Execute the query
 
$InsertQuery->execute();
 
 
 
//Create a results array and then extract + format the returned data from the execute() statement
 
$InsertResults = $InsertQuery->setFetchMode(PDO::FETCH_ASSOC);

//Close DB connection
$connection = null;

?>
