<?php

//First, start off the HTTP that creates a table of returned results

echo "<table style='border: solid 1px black'>";

echo "<p>Number of Reports filed by an Officer</p>";
echo "<br>";

echo "<tr><th>Number of Reports</th><th>Firstname</th><th>Lastname</th></tr>";


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



//Variables for storing the required credentials

$servername = "localhost";

$username = "root";

$password = "odOrXPVk5xcTdgvP";

$databasename = "project5test2";



//Variables for executing custom queries later (needs to be rearranged with the creation of table headers)

$selectField1 = null;

$selectField2 = null;

$selectField3 = null;

$selectField4 = null;

$selectField5 = null;

$selectField6 = null;



$fromField1 = null;

$fromField2 = null;

$fromField3 = null;



$whereField1 = null;

$whereField2 = null;

$whereField3 = null;



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



//Now, attempt to run the test queries (this will be replaced with custom query code later)



//First, use the Prepare() function to store the SELECT query for use with our database

$query = $connection->prepare("SELECT COUNT(File_ReportNumber), FirstName, LastName

FROM PoliceOfficer, FiledBy

WHERE File_DateGraduated = DateGraduated AND File_BadgeNumber = BadgeNumber

GROUP BY FirstName, LastName;");



//Execute the query

$query->execute();



//Create a results array and then extract + format the returned data from the execute() statement

$results = $query->setFetchMode(PDO::FETCH_ASSOC);

//-----INSERT-----// WORKS

$InsertQuery = $connection->prepare("INSERT INTO CriminalIncident (IncidentNumber, TimeOccurred, DateOccurred, Address) VALUES(9997, 2030, 2016-11-02,'Smiley Street');");

//check if value exists before insert

$TestInsert->execute();

if (mysql_num_rows($TestInsert) > 0) {
	echo "<p>Value already exists in database</p>";
}


//Execute the query

$InsertQuery->execute();

if (!$InsertQuery) {
	die('Query Error');
}


//Create a results array and then extract + format the returned data from the execute() statement

$InsertResults = $InsertQuery->setFetchMode(PDO::FETCH_ASSOC);


//-----DELETE-----//

$DeleteQuery = $connection->prepare("DELETE FROM Statute WHERE CodeDesignation = 110;");

//Execute the query

$DeleteQuery->execute();

//Create a results array and then extract + format the returned data from the execute() statement

$DeleteResults = $DeleteQuery->setFetchMode(PDO::FETCH_ASSOC);



//Extract the results using the TableRows class

foreach(new TupleResult(new RecursiveArrayIterator($query->fetchAll())) as $key=>$value)

{

    echo $value;

}



//Close connection and wrap up the returned table of results

$connection = null;

echo "</table>";

?>
