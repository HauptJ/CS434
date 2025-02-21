<?php



//=====Functions for Data Validation=====



//This just makes sure text-values taken from the user don't have any malicious injections

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



//=====Variables from the HTML Form=====



//These are all arrays created from POST data taken from the HTML input form

//Array of Checkboxes
$chkTables = array(isset($_POST["chkCrimeReport"]), isset($_POST["chkCriminalIncident"]), isset($_POST["chkDefinedBy"]),
                   isset($_POST["chkFiledBy"]), isset($_POST["chkMemberOf"]), isset($_POST["chkPoliceDepartment"]),
                   isset($_POST["chkPoliceOfficer"]), isset($_POST["chkReportedThrough"]), isset($_POST["chkStatusUpdate"]),
                   isset($_POST["chkStatute"]));

$chkInts = array(isset($_POST["chkInt1"]), isset($_POST["chkInt2"]), isset($_POST["chkInt3"]));

//Array of Field Select-boxes
$selFields = array(test_input($_POST["selFields1"]), test_input($_POST["selFields2"]), test_input($_POST["selFields3"]),
                   test_input($_POST["selFields4"]), test_input($_POST["selFields5"]), test_input($_POST["selFields6"]));

//Array of Constraint Select-boxes
$selConstraints = array(test_input($_POST["selConstraints1"]), test_input($_POST["selConstraints2"]), test_input($_POST["selConstraints3"]));

//Array of Constraint Text-boxes
$txtConstraints = array(test_input($_POST["txtConstraints1"]), test_input($_POST["txtConstraints2"]), test_input($_POST["txtConstraints3"]));

//This is the array used to add in values to the query
$tables = array("CrimeReport", "CriminalIncident", "DefinedBy", "FiledBy", "MemberOf",
                 "PoliceDepartment", "PoliceOfficer", "ReportedThrough", "StatusUpdate", "Statute");

//The "Go-Back" link
$go_back = htmlspecialchars($_SERVER['HTTP_REFERER']);



//=====Parsing Through the User Input to Build the SQL Query Statement=====



//Variables representing segments of the SQL Query
$stmtQuery = "";
$stmtSelect = "SELECT";
$stmtFrom = "FROM";
$stmtWhere = "WHERE";


//---Building the SELECT segment---


//Variables for properly parsing the SELECT segment
$numSelect = 0;
$counter = 1;

//First, iterate through our list of select fields to see how many there are
for ($x = 0; $x < 6; $x++) {
    if ($selFields[$x] != "") {
        $numSelect = $numSelect + 1;
    }
}

//Then go through again and build the SELECT segment
for ($x = 0; $x < 6; $x++) {

    //If this selFields element has been given a non-empty value
    if ($selFields[$x] != "") {

        //Add its value to the SELECT segment
        $stmtSelect .= " ";
        $stmtSelect .= $selFields[$x];

        //If our counter doesn't indicate that we're at the last value
        if ($counter < $numSelect) {

            //Prepare the statement for another value
            $stmtSelect .= ",";
        }
        //Otherwise, put a space
        else {
            $stmtSelect .= " ";
        }

        //Finally, increment our counter
        $counter = $counter + 1;
    }
}

echo "<br><p>SELECT segment: ";
echo $stmtSelect;
echo " at numSelect of ";
echo $numSelect;
echo "</p><br>";


//---Building the FROM segment---


//Variables for properly parsing the FROM segment
$numFrom = 0;
$counter = 1;
$limit = 0;

//First, iterate through our checkboxes to see how many we've selected
for ($x = 0; $x < 10; $x++) {
    if ($chkTables[$x] == 1) {
        $numFrom = $numFrom + 1;
        echo "<br><p>numFrom + 1</p><br>";
    }
}

//Then go through again and build the FROM segment
for ($x = 0; $x < 10; $x++) {

    //If this checkbox has been checked
    if ($chkTables[$x] == 1){

        //Add its text to the FROM segment and increase the limit
        $stmtFrom .= " ";
        $stmtFrom .= $tables[$x];
        $limit = $limit + 1;

        //If we haven't reached our limit, put a comma
        if ($counter < $numFrom) {
            $stmtFrom .= ",";
        }
        //Otherwise, put a space
        else {
            $stmtFrom .= " ";
        }

        //Finally, increment our counter
        $counter = $counter + 1;
    }
}


echo "<br><p>FROM segment: ";
echo $stmtFrom;
echo " at numFrom of ";
echo $numFrom;
echo "</p><br>";

//If, at this point, we have no SELECT or FROM values
if ( ($numSelect < 1) or ($numFrom < 1) ) {

    //Exit with the appropriate message
    echo "<a href='$go_back'>Go Back</a>";
    exit("How can the database search for data if you don't tell it what you want or where to get it?");
}


//---Building the WHERE segment---

//Variables for properly parsing the WHERE segment
$numWhere = 0;
$counter = 1;
$converter = 999;

//First, iterate through our constraints to see how many are fully filled out
for ($x = 0; $x < 3; $x++) {
    if ( ($selConstraints[$x] != "") and ($txtConstraints[$x] != "") ) {
        $numWhere = $numWhere + 1;

        //If this is supposed to be an integer
        if ($chkInts[$x] == 1) {

            //Convert this into an integer
            $converter = $selConstraints[$x];
            $converter = (int)$converter;
        }

        //Also, if it turns out this constrainted was checked off as an integer but contains non-integer characters,
        if ( ($chkInts[$x] == 1) and (!is_int($converter)) ) {
            //Exit the script
            echo "<a href='$go_back'>Go Back</a>";
            exit("You tried to input a non-integer character in a text-box that you labeled as being an integer!  Shame on you!");
        }
    }
}

//Now go through again and build the WHERE segment
for ($x = 0; $x < 3; $x++) {

    //If both the constraint select-box AND the constraint text-box are filled out
    if ( ($selConstraints[$x] != "") and ($txtConstraints[$x] != "") ) {

        //Add the appropriate text to the WHERE segment
        $stmtWhere .= " ";

        //If this is an int
        if ($chkInts[$x] == 1) {
            $stmtWhere .= "CAST(";
        }

        $stmtWhere .= $selConstraints[$x];

        //If this is an int
        if ($chkInts[$x] == 1) {
            //Omit the quotes
            $stmtWhere .= " AS CHAR)";
        }

        $stmtWhere .= " LIKE \"%";
        $stmtWhere .= $txtConstraints[$x];
        $stmtWhere .= "%\"";

        //If our counter doesn't indicate we're at the last value
        if ($counter < $numWhere) {

            //Prepare the statement for another value
            $stmtWhere .= " AND ";
        }
        //Otherwise, finish the query
        else {
            $stmtWhere .= ";";
        }

        //Finally, increment our counter
        $counter = $counter + 1;
    }
}

echo "<br><p>WHERE segment: ";
echo $stmtWhere;
echo "</p><br>";


//---Put the segments together---


$stmtQuery .= $stmtSelect;
$stmtQuery .= $stmtFrom;
$stmtQuery .= $stmtWhere;

echo "<br><p>Full Query: ";
echo $stmtQuery;
echo "</p><br>";



//-----Displaying the POST Data Values for Testing-----

echo "<br><p>ENTERED DATA</p><br>";

echo "<br><p>For checkboxes:    ";
for ($x = 0; $x < 10; $x++) {

    if ($chkTables[$x] == 1){
        echo "TRUE";
    }
    else {
        echo "FALSE";
    }

    if ($x == 9) {
        echo ".";
    }
    else {
        echo ", ";
    }
}

echo "</p><br>";

echo "<br><p>For Field Select-boxes:    ";
for ($x = 0; $x < 6; $x++) {

    echo $selFields[$x];


    if ($x == 5) {
        echo ".";
    }
    else {
        echo ", ";
    }
}


echo "</p><br>";

echo "<br><p>For Constraint Select-boxes:    ";
for ($x = 0; $x < 3; $x++) {

    echo $selConstraints[$x];

    if ($x == 2) {
        echo ".";
    }
    else {
        echo ", ";
    }
}

echo "</p><br>";

echo "<br><p>For Constraint Text-boxes:    ";
for ($x = 0; $x < 3; $x++) {

    if ($txtConstraints[$x] == "") {
        echo "empty_empty";
    }
    else {
        echo $txtConstraints[$x];
    }

    if ($x == 2) {
        echo ".";
    }
    else {
        echo ", ";
    }
}

echo "</p><br>";



//=====Send the Query to the DB and Store Results=====



//Variables for storing the required credentials
$servername = "localhost";
$username = "root";
$password = "odOrXPVk5xcTdgvP";
$databasename = "LACrimeFixMe";

//Establish PDO connection
try
    {
    //The actual database connection line
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

    //Set the PDO error mode to exception so we can return proper error messages
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<br>Connected successfully<br>"; 
    }

//If the above code fails (i.e. an exception is caught), print the appropriate error message
catch(PDOException $errmessage)
    {
    echo "Connection failed: " . $errmessage->getMessage();
    }

//Issue query and store results
$query = $connection->query($stmtQuery);
$results = $query->setFetchMode(PDO::FETCH_NUM);

//Temporarily vomit the contents of the query
echo "<br>Temporarily vomiting query results:<br>";
echo $results;
echo "<br>The value of numSelect is ";
echo $numSelect;
echo ".<br>";



//=====Building the Results Table=====



//Variables for setting up the results table
$counter = 0;

//Create an array for storing the labels of the fields we're selecting
$labels = array_fill(0, $numSelect, "blank");

//For each Select-box we had on the HTML page
for ($x = 0; $x < 6; $x++) {

    //If the user provided a value for it
    if ($selFields[$x] != "") {

        //Store it in the labels array and increment the counter
        $labels[$counter] = $selFields[$x];
        $counter = $counter + 1;
    }
}

//Now we can initialize the table and its first row
echo "<table id='table1' border='1'>\n";
echo "<tr>";

//For each data item in this first table row
for ($x = 0; $x < $numSelect; $x++) {

    //Build a data item that contains the appropriate label
    echo "<td>";
    echo $labels[$x];
    echo "</td>";
}

//Cap off this first table row
echo "</tr>";

//Now, let's populate the rest of this table for as long as we can pull a row of data from $results
while ($row = $query->fetch()) {

    //Initialize a new row
    echo "<tr>";

    //For each label we've identified in this row of data
    for ($x = 0; $x < $numSelect; $x++) {

        //Build a data item
        echo "<td>";
        echo $row[$x];
        echo "</td>";
    }

    //And cap off this row
    echo "</tr>";
}

//Close of this table
echo "</table><br><br>";

//Finally, close the connection to the database
$connection = null;
$query = null;



//=====A back button=====
echo "<a href='$go_back'>Go Back</a>";

?>