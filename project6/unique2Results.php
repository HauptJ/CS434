<?php

include_once 'nav.php';	

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

echo "Precinct Number: "; 
$PrecinctNumber = $_POST["PrecinctNumber"];
echo $PrecinctNumber;
echo "<br>";

//Check if precinct number is a valid integer between 1 and 21
if ((ctype_digit((string)$PrecinctNumber)) == False) {
	echo "<p>Precinct number is not an integer</p>";
	echo "<br>";
	echo "<p>Aborting execution</p>";
	echo "<br>";
	exit();
}
if (intval($PrecinctNumber) < 1 or intval($PrecinctNumber) > 21) {
	echo "<p>Precinct number is not between 1 and 21</p>";
	echo "<br>";
	echo "<p>Aborting execution</p>";
	echo "<br>";
	exit();
}





//This essentially iterates through a tuple's fields and puts them in a single table row

class TupleResult extends RecursiveIteratorIterator { 

    function __construct($it) { 

        parent::__construct($it, self::LEAVES_ONLY); 

    }



    function current() {

        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";

    }



    function beginChildren() { 

        echo "<tr>"; 

    } 



    function endChildren() { 

        echo "</tr>" . "\n";

    } 

} 






//Variables for executing custom queries later (needs to be rearranged with the creation of table headers)




//Now, attempt to run the test queries (this will be replaced with custom query code later)



//First, use the Prepare() function to store the SELECT query for use with our database

$UniqueQuery2 = $connection->prepare("SELECT COUNT(DateGraduated), DateGraduated FROM PoliceOfficer NATURAL JOIN PoliceDepartment WHERE PrecinctNumber = :PrecinctNumberS GROUP BY BadgeNumber");

$UniqueQuery2->execute(array(
"PrecinctNumberS" =>  $PrecinctNumber

));


//Execute the queries

$UniqueQuery2->execute();

//Create a results array and then extract + format the returned data from the execute() statement

$results = $UniqueQuery2->setFetchMode(PDO::FETCH_ASSOC);

//Table 2

//First, start off the HTTP that creates a table of returned results

echo "<table style='border: solid 1px black'>";

echo "<p>Number of Reports filed by an Officer</p>";
echo "<br>";
echo "<p>SELECT COUNT(DateGraduated), DateGraduated FROM PoliceOfficer NATURAL JOIN PoliceDepartment WHERE PrecinctNumber = ", $PrecinctNumber, " GROUP BY BadgeNumber;</p>";

echo "<tr><th>Number of Number of Officers</th><th>Date Graduated</th></tr>";

//For unique query 2
//Extract the results using the TableRows class

foreach(new TupleResult(new RecursiveArrayIterator($UniqueQuery2->fetchAll())) as $key=>$value)

{

    echo $value;

}

//END Table
echo "</table>";

echo "<br></br>";

//Close connection and wrap up the returned table of results

$connection = null;

?>
