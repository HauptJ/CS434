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

echo "Report Number: "; 
$ReportNumber = $_POST["ReportNumber"];
echo $ReportNumber;
echo "<br>";
echo "Revision Number: ";
$RevisionNumber = $_POST["RevisionNumber"];
echo $RevisionNumber;
echo "<br>";

//echo "</body>";
//echo "</html>";

//-----DELETE-----// WORKS

//Implement with prepared statements
//http://www.w3schools.com/php/php_mysql_prepared_statements.asp
$UpdateQuery = $connection->prepare("UPDATE StatusUpdate SET RevisionNumber = :RevisionNumberS WHERE Stat_ReportNumber = :ReportNumberS");

try {

	$UpdateQuery->execute(array(
	"ReportNumberS" =>  $ReportNumber,
	"RevisionNumberS" => $RevisionNumber
	));
} catch (PDOException $e) {
	if ($e->errorInfo[1] == 1062) {
      // duplicate entry, print error to user
		echo "<p>Entry already exists in database</p>";
	} else {
      // an error other than duplicate entry occurred
		echo "<p>Something was wrong with the update query. Please try again</p>";
	}
}
 
 
//Execute the query

//echo $InsertQuery;
 
//$InsertQuery->execute();
 
 
 
//Create a results array and then extract + format the returned data from the execute() statement
 
//$InsertResults = $InsertQuery->setFetchMode(PDO::FETCH_ASSOC);


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

$TestUpdateQuery = $connection->prepare("SELECT Stat_ReportNumber, RevisionNumber FROM StatusUpdate WHERE Stat_ReportNumber = :ReportNumberS");

$TestUpdateQuery->execute(array(
"ReportNumberS" =>  $ReportNumber,
));

$results = $TestUpdateQuery->setFetchMode(PDO::FETCH_ASSOC);

//First, start off the HTTP that creates a table of returned results

echo "<table style='border: solid 1px black'>";

echo "<p>Your entered data as seen in the database</p>";
echo "<br>";


echo "<tr><th>Report Number</th><th>Revision Number</th></tr>";


//Extract the results using the TableRows class

foreach(new TupleResult(new RecursiveArrayIterator($TestUpdateQuery->fetchAll())) as $key=>$value)

{

    echo $value;

}

//END Table
echo "</table>";

echo "<br></br>";

//Close DB connection
$connection = null;

echo "</body>";
echo "</html>";

?>




